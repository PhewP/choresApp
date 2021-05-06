<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{

    public $categoryNames = [
        'compras',
        'informacion',
        'administrativo',
        'transporte',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach ($this->categoryNames as $name) {
            $category = Category::create(['name' => $name]);
            $category->save();
        }
    }
}
