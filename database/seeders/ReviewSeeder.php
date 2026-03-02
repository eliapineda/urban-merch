<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Product;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Obtenemos IDs reales (limitamos a 5 como en tu código original)
        $userIds = User::limit(5)->pluck('id')->toArray();
        $productIds = Product::limit(5)->pluck('id')->toArray();

        // Verificamos que existan datos para evitar errores
        if (empty($userIds) || empty($productIds)) {
            $this->command->warn("No hay usuarios o productos para crear reseñas. Ejecuta UserSeeder y ProductSeeder primero.");
            return;
        }

        // 2. Definimos las reseñas usando los IDs obtenidos
        $reviews = [
            ['user_id' => $userIds[0], 'product_id' => $productIds[0], 'rating' => 5, 'content' => '¡Increíble! El sonido es puro y la edición limitada es preciosa.'],
            ['user_id' => $userIds[1], 'product_id' => $productIds[0], 'rating' => 4, 'content' => 'Muy buen disco, aunque el envío tardó un poco más de lo esperado.'],
            ['user_id' => $userIds[2], 'product_id' => $productIds[1], 'rating' => 5, 'content' => 'Una joya imprescindible para cualquier coleccionista de vinilos.'],
            ['user_id' => $userIds[3], 'product_id' => $productIds[1], 'rating' => 5, 'content' => 'Calidad de 10. Se nota que cuidan el embalaje para que no sufra daños.'],
            ['user_id' => $userIds[4], 'product_id' => $productIds[2], 'rating' => 3, 'content' => 'El producto es bueno, pero la descripción era un poco confusa.'],
            ['user_id' => $userIds[0], 'product_id' => $productIds[3], 'rating' => 5, 'content' => 'Sonido impecable, sin nada de ruido de fondo. Perfecto.'],
            ['user_id' => $userIds[1], 'product_id' => $productIds[4], 'rating' => 4, 'content' => 'Gran compra, el diseño de la portada es arte puro.'],
        ];

        // 3. Insertamos usando el modelo Review
        foreach ($reviews as $review) {
            Review::create($review);
        }
    }
}
