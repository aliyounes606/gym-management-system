<?php

namespace App\Services;

use App\Models\Equipment; 
use Illuminate\Http\Request; 
use App\Traits\ApiResponseTrait; 
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class EquipmentApiService
 *
 * Handles API logic for Equipment:
 * - List with optional category filter
 */
class EquipmentService
{
    use ApiResponseTrait;

    /**
     * Retrieve equipment list for API requests
     * with optional category filtering.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getForApi(Request $request)
    {
        try {
            $equipment = Equipment::with(['category', 'image'])
                ->when($request->filled('category_id'), function ($query) use ($request) {
                    $query->whereHas('category', function ($q) use ($request) {
                        $q->where('categories.id', $request->category_id);
                    });
                })
                ->get();

            if ($equipment->isEmpty()) {
                return $this->errorResponse(
                    'No equipment found for this category',
                    404
                );
            }

            return $this->successResponse(
                $equipment,
                'Equipment retrieved successfully',
                200
            );

        } catch (\Exception $e) {
            return $this->errorResponse(
                'Error while retrieving equipment',
                500
            );
        }
    }
}