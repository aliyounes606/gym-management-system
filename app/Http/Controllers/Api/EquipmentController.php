<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EquipmentService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse; 

/**
 * Handles equipment-related API requests and returns standardized JSON responses.
 */
class EquipmentController extends Controller 
{
    protected EquipmentService $equipmentService;

    public function __construct(EquipmentService $equipmentService)
    {
        $this->equipmentService = $equipmentService;
    }

    /**
     * Retrieve equipment list for API.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $equipment = $this->equipmentService->getForApi($request);

            if ($request->filled('category_id') && $equipment->isEmpty()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'No equipment found for this category'
                ], 404);
            }

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