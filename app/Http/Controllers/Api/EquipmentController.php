<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EquipmentService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * Class EquipmentController
 *
 * Delegates API requests to EquipmentService
 * and wraps with try/catch for extra safety
 */
class EquipmentController extends Controller 
{
    use ApiResponseTrait;

    protected EquipmentService $equipmentService;

    public function __construct(EquipmentService $equipmentService)
    {
        $this->equipmentService = $equipmentService;
    }

    /**
     * Retrieve equipment list for API
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            // Service ترجع JsonResponse مباشرة
            return $this->equipmentService->getForApi($request);

        } catch (\Exception $e) {
            return $this->errorResponse(
                'Something went wrong while retrieving equipment',
                500
            );
        }
    }
}