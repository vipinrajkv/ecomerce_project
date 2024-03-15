<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'category_name' => 'Sedan',
            ],
            [
                'category_name' => 'Suv',
            ],
            [
                'category_name' => 'Hatch Back',
            ],
            [
                'category_name' => 'Premium',
            ],
            [
                'category_name' => '9 Seater',
            ],
            [
                'category_name' => '7 Seater',
            ],
        ];
        Category::insert($data);
    }
}
