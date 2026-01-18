<?php

namespace App\Services;

use App\Models\Equipment;
use App\Models\Category;
use App\Traits\HandlesEquipmentImage;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class EquipmentService
 *
 * Contains all business logic related to Equipment:
 * CRUD operations, image handling, category relations,
 * and API data retrieval with standardized responses.
 */
class EquipmentService
{
    use HandlesEquipmentImage, ApiResponseTrait;

    /**
     * Retrieve paginated equipment list with images.
     *
     * @return mixed
     */
    public function paginate()
    {
        try {
            $equipment = Equipment::with('image')->paginate(10);

            return $this->successResponse(
                $equipment,
                'Equipment retrieved successfully',
                200
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                'Error while retrieving equipment list',
                500
            );
        }
    }

    /**
     * Retrieve all categories.
     *
     * @return mixed
     */
    public function getCategories()
    {
        try {
            $categories = Category::all();

            return $this->successResponse(
                $categories,
                'Categories retrieved successfully',
                200
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                'Error while retrieving categories',
                500
            );
        }
    }

    /**
     * Store a new equipment record.
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        try {
            $equipment = Equipment::create($request->validated());

            $this->storeImage($request, $equipment);

            if ($request->categories) {
                $equipment->category()->attach($request->categories);
            }

            return $this->successResponse(
                $equipment,
                'Equipment created successfully',
                201
            );

        } catch (\Exception $e) {
            return $this->errorResponse(
                'Error while creating equipment',
                500
            );
        }
    }

    /**
     * Retrieve a single equipment with relations.
     *
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        try {
            $equipment = Equipment::with('category', 'image')->findOrFail($id);

            return $this->successResponse(
                $equipment,
                'Equipment retrieved successfully',
                200
            );

        } catch (ModelNotFoundException $e) {
            return $this->errorResponse(
                'Equipment not found',
                404
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                'Error while retrieving equipment',
                500
            );
        }
    }

    /**
     * Update an existing equipment record.
     *
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    public function update(Request $request, int $id)
    {
        try {
            $equipment = Equipment::findOrFail($id);
            $equipment->update($request->validated());

            $this->updateImage($request, $equipment);

            if ($request->categories) {
                $equipment->category()->sync($request->categories);
            }

            return $this->successResponse(
                $equipment,
                'Equipment updated successfully',
                200
            );

        } catch (ModelNotFoundException $e) {
            return $this->errorResponse(
                'Equipment not found',
                404
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                'Error while updating equipment',
                500
            );
        }
    }

/**
     * Delete an equipment record.
     *
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        try {
            $equipment = Equipment::findOrFail($id);

            $this->deleteImage($equipment);

            $equipment->delete();

            return $this->successResponse(
                null,
                'Equipment deleted successfully',
                200
            );

        } catch (ModelNotFoundException $e) {
            return $this->errorResponse(
                'Equipment not found',
                404
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                'Error while deleting equipment',
                500
            );
        }
    }

    /**
     * Retrieve equipment list for API requests
     * with optional category filtering.
     *
     * @param Request $request
     * @return mixed
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