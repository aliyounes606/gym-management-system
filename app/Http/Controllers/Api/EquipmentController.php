<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipment;
use Illuminate\Http\JsonResponse;

/**
 * handles equipment-related API requests.
 *
 * provides endpoints to retrieve equipment data with related categories and images,
 * supports optional filtering by category, and returns standardized JSON responses.
 */

class EquipmentController extends Controller
{
/**
 * retrieves a list of equipment as a JSON response.
 *
 * loads related categories and images, applies optional filtering by category_id,
 * and returns equipment data with count and status information.
 *
 * @param \Illuminate\Http\Request $request
 * @return \Illuminate\Http\JsonResponse
 */
    
    public function index(Request $request): JsonResponse
{
    try {
        $equipment = Equipment::with(['category', 'image'])
            ->when($request->filled('category_id'), function ($query) use ($request) {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('categories.id', $request->category_id);
                });
            })
            ->get();

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
