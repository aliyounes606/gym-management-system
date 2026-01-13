<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Equipment;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $equipments = [
            ['name' => 'Ab Coaster',
            'status' => 'existing',
            'quantity' => 2,],
         
            ['name' => 'Ab Machine',
            'status' => 'existing', 
            'quantity' => 3,],

             ['name' => 'Abdominal Bench',
            'status' => 'existing', 
            'quantity' => 4,],

             ['name' => 'Air Resistance Exercise Bike',
            'status' => 'existing', 
            'quantity' => 5,],

             ['name' => 'Ankle weights',
            'status' => 'existing', 
            'quantity' => 6,],

             ['name' => 'Battle Ropes',
            'status' => 'existing', 
            'quantity' => 7,],

             ['name' => 'Dumbbells',
            'status' => 'existing', 
            'quantity' => 8,],

             ['name' => 'Elliptical Trainer',
            'status' => 'existing', 
            'quantity' => 9,],

             ['name' => 'Hack Squat Machine',
            'status' => 'existing', 
            'quantity' => 10,],

             ['name' => 'Hammer Strength Machine',
            'status' => 'existing', 
            'quantity' => 11,],

             ['name' => 'Inclined Bench Press',
            'status' => 'existing', 
            'quantity' => 12,],

             ['name' => 'Inversion Table',
            'status' => 'existing', 
            'quantity' => 13,],

             ['name' => 'Lat Pulldown Machine',
            'status' => 'existing', 
            'quantity' => 14,],

             ['name' => 'Multi-Gym Equipment',
            'status' => 'existing', 
            'quantity' => 15,],

             ['name' => 'Pec Deck Machine',
            'status' => 'existing', 
            'quantity' => 16,],

             ['name' => 'Preacher Bench',
            'status' => 'existing', 
            'quantity' => 17,],

             ['name' => 'Recumbent Bike',
            'status' => 'existing', 
            'quantity' => 18,],

             ['name' => 'Rowing Machine',
            'status' => 'existing', 
            'quantity' => 19,],

             ['name' => 'Spin Bike',
            'status' => 'existing', 
            'quantity' => 20,],

             ['name' => 'Squat Station',
            'status' => 'existing', 
            'quantity' => 21,],

             ['name' => 'stair stepper',
            'status' => 'existing', 
            'quantity' => 22,],

             ['name' => 'Stationary Bike',
            'status' => 'existing', 
            'quantity' => 23,],

             ['name' => 'Stationary Bike',
            'status' => 'existing', 
            'quantity' => 24,],

             ['name' => 'Stretching Machine',
            'status' => 'existing', 
            'quantity' => 25,],

             ['name' => 'Suspension Trainer',
            'status' => 'existing', 
            'quantity' => 26,],

             ['name' => 'Treadmill',
            'status' => 'existing', 
            'quantity' => 27,],

             ['name' => 'Tricep bars',
            'status' => 'existing', 
            'quantity' => 28,],

             ['name' => 'Vibration Plate',
            'status' => 'existing', 
            'quantity' => 29,],
         ];

        // foreach ($equipments as $item) {
        // $equipment = Equipment::create($item);

        // $equipment->image()->create([
        //     'path' => 'equipment_images/default.png',
        //      ]);
        // }
         $images = Storage::disk('public')->files('equipment_images');

    foreach ($equipments as $item) {

        $equipment = Equipment::create($item);

        // اختيار صورة عشوائية
        $imagePath = collect($images)->random();

        $equipment->image()->create([
            'path' => $imagePath, // مسار ديناميكي
        ]);
    }
}
    }

   