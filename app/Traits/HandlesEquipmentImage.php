<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

/**
 * Trait HandlesEquipmentImage
 *
 * This trait handles all image-related operations for equipment such as  storing, updating and deleting equipment images.
 */
trait HandlesEquipmentImage
{
    /**
     * Store a new image for equipment.
     *
     * @param mixed $request
     * @param mixed $equipment
     * @return void
     */
    protected function storeImage($request, $equipment): void
    {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('equipment_images', 'public');

            $equipment->image()->create([
                'path' => $imagePath
            ]);
        }
    }

    /**
     * Update equipment image by deleting the old one and storing the new image.
     *
     * @param mixed $request
     * @param mixed $equipment
     * @return void
     */
    protected function updateImage($request, $equipment): void
    {
        if ($request->hasFile('image')) {

            if ($equipment->image) {
                Storage::disk('public')->delete($equipment->image->path);
                $equipment->image()->delete();
            }

            $this->storeImage($request, $equipment);
        }
    }

    /**
     * Delete equipment image from storage and database.
     *
     * @param mixed $equipment
     * @return void
     */
    protected function deleteImage($equipment): void
    {
        if ($equipment->image) {
            Storage::disk('public')->delete($equipment->image->path);
            $equipment->image()->delete();
        }
    }
}