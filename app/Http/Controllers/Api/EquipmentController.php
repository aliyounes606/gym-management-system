<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipment;
use Illuminate\Http\JsonResponse;

class EquipmentController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            // تحميل العلاقات مع المعدات
            $query = Equipment::with(['category']);

            // فلترة حسب category (عن طريق العلاقة)
            if ($request->filled('category_id')) {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('id', $request->category_id);
                });
            }

            $equipment = $query->get();

            return response()->json([
                'status'  => true,
                'message' => 'Equipment retrieved successfully',
                'count'   => $equipment->count(),
                'data'    => $equipment
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong while retrieving equipment',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
