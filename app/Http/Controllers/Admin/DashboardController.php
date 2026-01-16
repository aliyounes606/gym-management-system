<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\GymSession;
use App\Models\TrainerProfile;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with comprehensive system statistics and charts.
     * This method aggregates key metrics (revenue, members, pending requests) and processes 
     * 30-day historical data to prepare visual charts before rendering the main dashboard view.
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $totalMembers = User::role('member')->count();
        $totalTrainers = TrainerProfile::count();
        $monthlyRevenue = Booking::where('payment_status', 'paid')
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('price');
        $pendingPayments = Booking::where('payment_status', 'unpaid')->sum('price');
        $pendingRequestsCount = Booking::where('status', 'pending')->count();

        $recentPendingBookings = Booking::with(['users', 'gymsessions'])
            ->where(function ($q) {
                $q->where('status', 'pending')->orWhere('payment_status', 'unpaid');
            })->latest()->take(6)->get();

        $todaySessions = GymSession::with('trainer.user')
            ->whereDate('start_time', Carbon::today())->orderBy('start_time')->take(5)->get();


        $endDate = Carbon::now();
        $startDate = Carbon::now()->subDays(29);
        $period = \Carbon\CarbonPeriod::create($startDate, $endDate);

        $rawRevenue = Booking::where('payment_status', 'paid')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(price) as total')
            )
            ->groupBy('date')
            ->pluck('total', 'date');

        $rawMembers = User::role('member')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('date')
            ->pluck('count', 'date');

        $chartLabels = [];
        $dailyRevenueData = [];
        $dailyMembersData = [];

        foreach ($period as $date) {
            $formattedDate = $date->format('Y-m-d');
            $displayDate = $date->format('d M');

            $chartLabels[] = $displayDate;
            $dailyRevenueData[] = $rawRevenue[$formattedDate] ?? 0;
            $dailyMembersData[] = $rawMembers[$formattedDate] ?? 0;
        }

        return view('admin.dashboard', compact(
            'totalMembers',
            'totalTrainers',
            'monthlyRevenue',
            'pendingPayments',
            'pendingRequestsCount',
            'recentPendingBookings',
            'todaySessions',
            'chartLabels',
            'dailyRevenueData',
            'dailyMembersData'
        ));
    }
    public function monthlyReport()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $stats = [
            'totalMembers' => User::role('member')->count(),
            'totalTrainers' => TrainerProfile::count(),
            'monthlyRevenue' => Booking::where('payment_status', 'paid')->whereMonth('created_at', Carbon::now()->month)->sum('price'),
            'pendingPayments' => Booking::where('payment_status', 'unpaid')->sum('price'),
            'pendingRequestsCount' => Booking::where('status', 'pending')->count(),
            'activeSessions' => GymSession::where('status', 'active')->count(),
            'start' => $startOfMonth->toDateString(),
            'end' => $endOfMonth->toDateString(),
            'dateGenerated' => Carbon::now()->toDateString(),
        ];
        $pdf = Pdf::loadView('admin.reports.monthly', $stats)->setPaper('a4', 'portrait');
        return $pdf->download('monthly_report.pdf');
    }

}