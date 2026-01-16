<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Header --}}
           {{-- Header --}}
<div class="flex items-center justify-between">
    <div>
        <h2 class="text-3xl font-bold text-gray-100">لوحة التحكم</h2>
        <p class="text-gray-400 mt-1">أهلاً بك، إليك ملخص لما يحدث في الجيم اليوم.</p>
    </div>

    <div class="text-right">
        <span class="text-sm text-gray-400 block">
            {{ \Carbon\Carbon::now()->format('l, d F Y') }}
        </span>

        <div class="mt-4">
            <a href="{{ route('monthly.report') }}" 
               class="inline-block px-6 py-2 bg-gray-800 text-white font-semibold rounded-lg shadow-md hover:bg-gray-600 transition">
                📄 pdf التقرير الشهري
            </a>
        </div>
        
    </div>
</div>  
{{-- رسائل النجاح أو الخطأ --}}
            @if(session('success'))
                <div class="bg-green-400 text-white px-4 py-2 rounded-lg shadow-md">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-600 text-white px-4 py-2 rounded-lg shadow-md">
                    {{ session('error') }}
                </div>
            @endif


            {{-- 1. بطاقات الإحصائيات --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <div
                    class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-lg flex items-center justify-between relative overflow-hidden group">
                    <div
                        class="absolute right-0 top-0 w-24 h-24 bg-green-500/10 rounded-bl-full -mr-4 -mt-4 transition group-hover:bg-green-500/20">
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm font-medium">إيرادات الشهر</p>
                        <h3 class="text-2xl font-bold text-green-400 mt-2">${{ number_format($monthlyRevenue, 2) }}</h3>
                    </div>
                    <div class="p-3 bg-gray-800 rounded-xl text-green-500 border border-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <div
                    class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-lg flex items-center justify-between relative overflow-hidden group">
                    <div
                        class="absolute right-0 top-0 w-24 h-24 bg-amber-500/10 rounded-bl-full -mr-4 -mt-4 transition group-hover:bg-amber-500/20">
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm font-medium">مبالغ قيد التحصيل</p>
                        <h3 class="text-2xl font-bold text-amber-400 mt-2">${{ number_format($pendingPayments, 2) }}
                        </h3>
                    </div>
                    <div class="p-3 bg-gray-800 rounded-xl text-amber-500 border border-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <div
                    class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-lg flex items-center justify-between relative overflow-hidden group">
                    <div
                        class="absolute right-0 top-0 w-24 h-24 bg-indigo-500/10 rounded-bl-full -mr-4 -mt-4 transition group-hover:bg-indigo-500/20">
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm font-medium">طلبات جديدة</p>
                        <h3 class="text-2xl font-bold text-white mt-2">{{ $pendingRequestsCount }}</h3>
                    </div>
                    <div class="p-3 bg-gray-800 rounded-xl text-indigo-500 border border-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>
                </div>

                <div
                    class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-lg flex items-center justify-between relative overflow-hidden group">
                    <div
                        class="absolute right-0 top-0 w-24 h-24 bg-blue-500/10 rounded-bl-full -mr-4 -mt-4 transition group-hover:bg-blue-500/20">
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm font-medium">الأعضاء النشطين</p>
                        <h3 class="text-2xl font-bold text-blue-400 mt-2">{{ $totalMembers }}</h3>
                    </div>
                    <div class="p-3 bg-gray-800 rounded-xl text-blue-500 border border-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- 2. القسم الرئيسي (جدول + قائمة جانبية) --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- جدول الطلبات المعلقة --}}
                <div class="lg:col-span-2 bg-gray-900 border border-gray-800 rounded-2xl shadow-xl overflow-hidden">
                    <div class="p-6 border-b border-gray-800 flex justify-between items-center bg-gray-800/30">
                        <h3 class="text-lg font-bold text-white flex items-center gap-2">
                            <span class="w-2 h-6 bg-amber-500 rounded-full"></span>
                            طلبات تحتاج مراجعة
                        </h3>
                        <a href="{{ route('admin.payments.index') }}"
                            class="text-xs text-indigo-400 hover:text-indigo-300 font-bold bg-gray-800 px-3 py-1.5 rounded-lg border border-gray-700 hover:border-indigo-500 transition">عرض
                            الكل</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-right">
                            <thead class="bg-gray-800 text-gray-400 text-xs uppercase font-bold tracking-wider">
                                <tr>
                                    <th class="p-4">العضو</th>
                                    <th class="p-4">تفاصيل الحجز</th>
                                    <th class="p-4">المبلغ</th>
                                    <th class="p-4">الحالة</th>
                                    <th class="p-4 text-center"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-800 text-sm">
                                @forelse ($recentPendingBookings as $booking)
                                    <tr class="hover:bg-gray-800/50 transition duration-150">
                                        <td class="p-4 font-bold text-white">
                                            {{ $booking->users->name ?? 'مستخدم محذوف' }}</td>
                                        <td class="p-4">
                                            <div class="text-gray-300 font-medium">
                                                {{ $booking->gymsessions->title ?? 'جلسة غير متوفرة' }}</div>
                                            <div class="text-xs text-gray-500">
                                                {{ $booking->gymsessions ? \Carbon\Carbon::parse($booking->gymsessions->start_time)->format('Y-m-d h:i A') : '-' }}
                                            </div>
                                        </td>
                                        <td class="p-4 font-mono text-green-400 font-bold">${{ $booking->price }}</td>
                                        <td class="p-4">
                                            @if ($booking->payment_status == 'unpaid')
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-900/50 text-red-300 border border-red-800">غير
                                                    مدفوع</span>
                                            @elseif($booking->status == 'pending')
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-amber-900/50 text-amber-300 border border-amber-800">معلق</span>
                                            @endif
                                        </td>
                                        <td class="p-4 text-center">
                                            <a href="{{ route('admin.payments.index') }}"
                                                class="text-gray-400 hover:text-indigo-400 transition">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            class="p-8 text-center text-gray-500 flex flex-col items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 opacity-50"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1.5"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>لا توجد طلبات معلقة حالياً.</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- القائمة الجانبية: جلسات اليوم + إجراءات سريعة --}}
                <div class="lg:col-span-1 space-y-6">

                    {{-- جلسات اليوم --}}
                    <div class="bg-gray-900 border border-gray-800 rounded-2xl shadow-xl p-6">
                        <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                            <span class="w-2 h-6 bg-indigo-500 rounded-full"></span>
                            جلسات اليوم
                        </h3>

                        <div class="space-y-4">
                            @forelse($todaySessions as $session)
                                <div
                                    class="flex items-start gap-4 p-3 rounded-xl bg-gray-800/50 border border-gray-800 hover:border-gray-700 transition">
                                    <div
                                        class="bg-indigo-900/50 text-indigo-300 p-2 rounded-lg text-center min-w-[3.5rem]">
                                        <span
                                            class="block text-xs font-bold">{{ \Carbon\Carbon::parse($session->start_time)->format('h:i') }}</span>
                                        <span
                                            class="block text-[10px] uppercase">{{ \Carbon\Carbon::parse($session->start_time)->format('A') }}</span>
                                    </div>
                                    <div>
                                        <h4 class="text-white font-bold text-sm">{{ $session->title }}</h4>
                                        <p class="text-gray-400 text-xs mt-1">ك:
                                            {{ $session->trainer->user->name ?? 'غير محدد' }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-6 text-gray-500 text-sm">
                                    لا توجد جلسات مجدولة لهذا اليوم.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- الإجراءات السريعة --}}
                    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-xl">
                        <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">إجراءات سريعة</h3>
                        <div class="space-y-3">
                            <a href="{{ route('admin.trainers.create') }}"
                                class="block w-full bg-gray-800 hover:bg-gray-750 text-gray-200 p-3 rounded-xl transition flex items-center gap-3 border border-gray-700 hover:border-gray-600">
                                <span class="bg-blue-500/10 text-blue-400 p-1.5 rounded-lg">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                    </svg>
                                </span>
                                إضافة مدرب جديد
                            </a>
                            <a href="{{ route('admin.payments.index') }}"
                                class="block w-full bg-gray-800 hover:bg-gray-750 text-gray-200 p-3 rounded-xl transition flex items-center gap-3 border border-gray-700 hover:border-gray-600">
                                <span class="bg-green-500/10 text-green-400 p-1.5 rounded-lg">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a1 1 0 11-2 0 1 1 0 012 0z" />
                                    </svg>
                                </span>
                                المدفوعات
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            {{-- قسم الرسوم البيانية --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
                <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-xl">
                    <h3 class="text-lg font-bold text-gray-100 mb-4 flex items-center gap-2">
                        <span class="w-2 h-6 bg-green-500 rounded-full"></span>
                        الإيرادات اليومية (آخر 30 يوم)
                    </h3>
                    <div class="relative h-72 w-full">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-xl">
                    <h3 class="text-lg font-bold text-gray-100 mb-4 flex items-center gap-2">
                        <span class="w-2 h-6 bg-blue-500 rounded-full"></span>
                        تسجيلات الأعضاء الجدد
                    </h3>
                    <div class="relative h-72 w-full">
                        <canvas id="membersChart"></canvas>
                    </div>
                </div>
            </div>
  

            {{-- سكريبت Chart.js --}}
            @push('scripts')
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    Chart.defaults.color = '#9ca3af';
                    Chart.defaults.borderColor = '#374151';

                    // 1. مخطط الإيرادات
                    const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
                    new Chart(ctxRevenue, {
                        type: 'line',
                        data: {
                            labels: @json($chartLabels),
                            datasets: [{
                                label: 'الإيرادات ($)',
                                data: @json($dailyRevenueData),
                                borderColor: '#10b981',
                                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                                borderWidth: 2,
                                fill: true,
                                tension: 0.4,
                                pointRadius: 3
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    mode: 'index',
                                    intersect: false,
                                    backgroundColor: 'rgba(17, 24, 39, 0.9)',
                                    titleColor: '#fff',
                                    bodyColor: '#10b981',
                                    borderColor: '#374151',
                                    borderWidth: 1
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: 'rgba(55, 65, 81, 0.5)'
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    }
                                }
                            }
                        }
                    });

                    // 2. مخطط الأعضاء
                    const ctxMembers = document.getElementById('membersChart').getContext('2d');
                    new Chart(ctxMembers, {
                        type: 'bar',
                        data: {
                            labels: @json($chartLabels),
                            datasets: [{
                                label: 'أعضاء جدد',
                                data: @json($dailyMembersData),
                                backgroundColor: '#3b82f6',
                                borderRadius: 4,
                                hoverBackgroundColor: '#60a5fa'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(17, 24, 39, 0.9)',
                                    titleColor: '#fff',
                                    bodyColor: '#3b82f6'
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1
                                    },
                                    grid: {
                                        color: 'rgba(55, 65, 81, 0.5)'
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    }
                                }
                            }
                        }
                    });
                </script>
            @endpush

        </div>
    </div>
</x-app-layout>
