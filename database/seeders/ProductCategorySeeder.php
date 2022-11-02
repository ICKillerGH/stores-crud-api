<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductCategory::create(['name' => 'Arte y artesania', 'description' => '']);

        ProductCategory::create(['name' => 'Automotriz', 'description' => '']);

        ProductCategory::create(['name' => 'Bebé', 'description' => '']);

        ProductCategory::create(['name' => 'Belleza y cuidado personal', 'description' => '']);

        ProductCategory::create(['name' => 'Cine y TV', 'description' => '']);

        ProductCategory::create(['name' => 'Computadoras', 'description' => '']);

        ProductCategory::create(['name' => 'Deportes y actividades al aire libre', 'description' => '']);

        ProductCategory::create(['name' => 'Electrónicos', 'description' => '']);

        ProductCategory::create(['name' => 'Equipaje', 'description' => '']);

        ProductCategory::create(['name' => 'Herramientas y mejoramiento del hogar', 'description' => '']);

        ProductCategory::create(['name' => 'Hogar y cocina', 'description' => '']);

        ProductCategory::create(['name' => 'Industrial y científico', 'description' => '']);

        ProductCategory::create(['name' => 'Insumos para mascotas', 'description' => '']);

        ProductCategory::create(['name' => 'Juguetes y juegos', 'description' => '']);

        ProductCategory::create(['name' => 'Libros', 'description' => '']);

        ProductCategory::create(['name' => 'Moda de niñas', 'description' => '']);

        ProductCategory::create(['name' => 'Moda de niños', 'description' => '']);

        ProductCategory::create(['name' => 'Moda para hombres', 'description' => '']);

        ProductCategory::create(['name' => 'Moda para mujeres', 'description' => '']);

        ProductCategory::create(['name' => 'Videojuegos', 'description' => '']);
    }
}
