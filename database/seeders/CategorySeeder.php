<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            'Switches',
            'Routers',
            'CCTV Cameras',
            'Network Cables',
            'WiFi Extenders',
            'Patch Panels',
            'Security Cameras',
            'Laptops',
            'Desktops',
            'Fiber Optic Cables',
            'Monitors',
            'Access Control Systems',
            'Network Adapters',
            'Security Alarms',
            'Modems',
            'Smart Locks',
            'Racks & Enclosures',
            'Keyboards',
            'External Hard Drives',
            'Headphones & Earbuds',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }
    }
}
