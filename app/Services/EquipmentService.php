<?php

namespace App\Services;

use App\Models\Equipment;
use App\Models\Category;
use App\Traits\HandlesEquipmentImage;
use Illuminate\Http\Request;

/**
 * Class EquipmentService
 *
 * This service contains all business logic related to equipment, including 
 * CRUD operations, image handling, category relations, and API data retrieval.
 */
class EquipmentService
{
    use HandlesEquipmentImage;

    /**
     * Retrieve paginated equipment list with images.
     *
     * @return mixed
     */
    public function paginate()
    {
        return Equipment::with('image')->paginate(10);
    }

    /**
     * Retrieve all categories.
     *
     * @return mixed
     */
    public function getCategories()
    {
        return Category::all();
    }

    /**
     * Store a new equipment record.
     *
     * @param Request $request
     * @return Equipment
     */
    public function store(Request $request): Equipment
    {
        $equipment = Equipment::create($request->validated());

        $this->storeImage($request, $equipment);

        if ($request->categories) {
            $equipment->category()->attach($request->categories);
        }

        return $equipment;
    }

    /**
     * Retrieve a single equipment with relations.
     *
     * @param int $id
     * @return Equipment
     */
    public function find(int $id): Equipment
    {
        return Equipment::with('category', 'image')->findOrFail($id);
    }

    /**
     * Update an existing equipment record.
     *
     * @param Request $request
     * @param int $id
     * @return Equipment
     */
    public function update(Request $request, int $id): Equipment
    {
        $equipment = Equipment::findOrFail($id);
        $equipment->update($request->validated());

        $this->updateImage($request, $equipment);

        if ($request->categories) {
            $equipment->category()->sync($request->categories);
        }

        return $equipment;
    }

    /**
     * Delete an equipment record.
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $equipment = Equipment::findOrFail($id);

        $this->deleteImage($equipment);

        $equipment->delete();
    }

    /**
     * Retrieve equipment list for API requests with optional category filtering.
     *
     * @param Request $request
     * @return mixed
     */
    public function getForApi(Request $request)
    {
        return Equipment::with(['category', 'image'])
            ->when($request->filled('category_id'), function ($query) use ($request) {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('categories.id', $request->category_id);
                });
            })
            ->get();
    }
}