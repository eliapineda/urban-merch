<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'CD First Album',
                'price' => 20.00,
                'images' => [
                    ['path' => 'uploads/products/1/cd_first_album.jpg', 'main' => 1]
                ],
                'desc' => 'Primer album de estudio de un artista emergente. Cuenta con 15 pistas. Formato MD de Sony.'
            ],
            [
                'name' => 'Gorra',
                'price' => 15.00,
                'images' => [
                    ['path' => 'uploads/products/2/gorra_ldr_1.jpg', 'main' => 1],
                    ['path' => 'uploads/products/2/gorra_ldr_2.jpg', 'main' => 0],
                    ['path' => 'uploads/products/2/gorra_ldr_3.jpg', 'main' => 0],
                    ['path' => 'uploads/products/2/gorra_ldr_4.jpg', 'main' => 0]
                ],
                'desc' => 'Gorra de la cantante americana Lana del Rey. De algodon, color negro.'
            ],
            [
                'name' => 'Sudadera',
                'price' => 35.00,
                'images' => [
                    ['path' => 'uploads/products/3/sudadera_2.jpg', 'main' => 1],
                    ['path' => 'uploads/products/3/sudadera_1.jpg', 'main' => 0]
                ],
                'desc' => 'Sudadera negra con capucha de The Cranberries. Album: no need to argue'
            ],
            // --- CATEGORÍA: SUDADERAS & CHAQUETAS ---
            [
                'name' => 'Sudadera Urban Hoodie Pro',
                'price' => 49.99,
                'images' => [
                    ['path' => 'uploads/products/4/1.jpg', 'main' => 1],
                    ['path' => 'uploads/products/4/2.jpg', 'main' => 0],
                    ['path' => 'uploads/products/4/3.jpg', 'main' => 0]
                ],
                'desc' => 'Sudadera premium con capucha de 300g. 80% algodón y 20% poliéster para mayor durabilidad. Color negro grafito, ideal para invierno. Incluye bolsillo frontal reforzado.'
            ],
            [
                'name' => 'Chaqueta Bomber "Night"',
                'price' => 75.00,
                'images' => [
                    ['path' => 'uploads/products/5/1.jpg', 'main' => 1],
                    ['path' => 'uploads/products/5/2.jpg', 'main' => 0],
                    ['path' => 'uploads/products/5/3.jpg', 'main' => 0]
                ],
                'desc' => 'Chaqueta estilo bomber. Exterior de nylon resistente al viento y lluvia ligera. Puños elásticos y bolsillo táctico en la manga.'
            ],
            [
                'name' => 'Hoodie RED London',
                'price' => 55.00,
                'images' => [
                    ['path' => 'uploads/products/6/1.jpg', 'main' => 1],
                    ['path' => 'uploads/products/6/2.jpg', 'main' => 0],
                    ['path' => 'uploads/products/6/3.jpg', 'main' => 0]
                ],
                'desc' => 'Sudadera de cuello subido con cremallera y manga larga. Detalle de bordado en delantero. Acabados en rib.'
            ],
            [
                'name' => 'Cortavientos Trailblazer',
                'price' => 42.00,
                'images' => [
                    ['path' => 'uploads/products/7/1.jpg', 'main' => 1],
                    ['path' => 'uploads/products/7/2.jpg', 'main' => 0],
                    ['path' => 'uploads/products/7/3.jpg', 'main' => 0]
                ],
                'desc' => 'Chaqueta ligera cortavientos. Material ultra-fino comprimible para llevar en mochila. Capucha ajustable y repelente al agua.'
            ],

            // --- CATEGORÍA: CAMISETAS ---
            [
                'name' => 'Camiseta Oversize Essential',
                'price' => 24.50,
                'images' => [
                    ['path' => 'uploads/products/8/1.jpg', 'main' => 1],
                    ['path' => 'uploads/products/8/2.jpg', 'main' => 0],
                    ['path' => 'uploads/products/8/3.jpg', 'main' => 0]
                ],
                'desc' => 'Camiseta de corte ancho (oversize). 100% algodón orgánico. Tacto suave y cuello redondo cerrado. Disponible en blanco y crudo.'
            ],
            [
                'name' => 'Camiseta Graphic Michael Scott "The Office"',
                'price' => 28.00,
                'images' => [
                    ['path' => 'uploads/products/9/1.jpg', 'main' => 1],
                    ['path' => 'uploads/products/9/2.jpg', 'main' => 0],
                    ['path' => 'uploads/products/9/3.jpg', 'main' => 0]
                ],
                'desc' => 'Camiseta blanca con estampado serigrafiado de alta calidad. Estilo artístico urbano. No pierde color tras los lavados.'
            ],
            [
                'name' => 'Tank Top Athletic',
                'price' => 18.00,
                'images' => [
                    ['path' => 'uploads/products/10/1.jpg', 'main' => 1],
                    ['path' => 'uploads/products/10/2.jpg', 'main' => 0],
                    ['path' => 'uploads/products/10/3.jpg', 'main' => 0]
                ],
                'desc' => 'Camiseta sin mangas para entrenamiento. Tejido microperforado que expulsa el sudor. Corte atlético que permite total movilidad.'
            ],
            [
                'name' => 'Polo Classic Urban',
                'price' => 32.00,
                'images' => [
                    ['path' => 'uploads/products/11/1.jpg', 'main' => 1],
                    ['path' => 'uploads/products/11/2.jpg', 'main' => 0],
                    ['path' => 'uploads/products/11/3.jpg', 'main' => 0]
                ],
                'desc' => 'Polo de algodón piqué con dos botones. Estilo semi-formal pero cómodo.'
            ],

            // --- CATEGORÍA: PANTALONES ---
            [
                'name' => 'Pantalón Jogger Tech',
                'price' => 35.00,
                'images' => [
                    ['path' => 'uploads/products/12/1.jpg', 'main' => 1],
                    ['path' => 'uploads/products/12/2.jpg', 'main' => 0],
                    ['path' => 'uploads/products/12/3.jpg', 'main' => 0]
                ],
                'desc' => 'Jogger gris oscuro con bolsillos con cremallera. Cintura elástica y puños ajustados. Tejido técnico elástico para máxima comodidad.'
            ],
            [
                'name' => 'Cargo Pants "Combat"',
                'price' => 48.00,
                'images' => [
                    ['path' => 'uploads/products/13/1.jpg', 'main' => 1],
                    ['path' => 'uploads/products/13/2.jpg', 'main' => 0],
                    ['path' => 'uploads/products/13/3.jpg', 'main' => 0]
                ],
                'desc' => 'Pantalones tipo cargo con 6 bolsillos. Material de sarga resistente. Estilo militar moderno, ideal para el día a día.'
            ],
            [
                'name' => 'Shorts de Verano Breeze',
                'price' => 22.00,
                'images' => [
                    ['path' => 'uploads/products/14/1.jpg', 'main' => 1],
                    ['path' => 'uploads/products/14/2.jpg', 'main' => 0],
                    ['path' => 'uploads/products/14/3.jpg', 'main' => 0]
                ],
                'desc' => 'Pantalones cortos de lino y algodón. Muy frescos y ligeros para climas calurosos. Cordón de ajuste en cintura.'
            ],

            // --- CATEGORÍA: ACCESORIOS ---
            [
                'name' => 'Gorra Snapback Street',
                'price' => 19.90,
                'images' => [
                    ['path' => 'uploads/products/15/1.jpg', 'main' => 1],
                    ['path' => 'uploads/products/15/2.jpg', 'main' => 0],
                    ['path' => 'uploads/products/15/3.jpg', 'main' => 0]
                ],
                'desc' => 'Gorra ajustable con visera plana. Color negro. Estructura de 6 paneles rígidos. Cierre de plástico clásico.'
            ],
            [
                'name' => 'Mochila Roll-top Urban',
                'price' => 55.00,
                'images' => [
                    ['path' => 'uploads/products/16/1.jpg', 'main' => 1],
                    ['path' => 'uploads/products/16/2.jpg', 'main' => 0],
                    ['path' => 'uploads/products/16/3.jpg', 'main' => 0]
                ],
                'desc' => 'Mochila impermeable con cierre enrollable. Compartimento acolchado para portátil de 15 pulgadas. Capacidad 20L.'
            ],
            [
                'name' => 'Gorro Beanie Winter',
                'price' => 15.00,
                'images' => [
                    ['path' => 'uploads/products/17/1.jpg', 'main' => 1],
                    ['path' => 'uploads/products/17/2.jpg', 'main' => 0],
                    ['path' => 'uploads/products/17/3.jpg', 'main' => 0]
                ],
                'desc' => 'Gorro de lana suave acrílica. Muy cálido para invierno. Color gris melange, talla única elástica.'
            ],
            [
                'name' => 'Cinturón Táctico Nylon',
                'price' => 12.00,
                'images' => [
                    ['path' => 'uploads/products/18/1.jpg', 'main' => 1],
                    ['path' => 'uploads/products/18/2.jpg', 'main' => 0],
                    ['path' => 'uploads/products/18/3.jpg', 'main' => 0]
                ],
                'desc' => 'Cinturón de nylon militar con hebilla de liberación rápida. Muy resistente y ajustable a cualquier medida.'
            ],
            [
                'name' => 'Calcetines Crew Pack x3',
                'price' => 14.00,
                'images' => [
                    ['path' => 'uploads/products/19/1.jpg', 'main' => 1],
                    ['path' => 'uploads/products/19/2.jpg', 'main' => 0]
                ],
                'desc' => 'Pack de 3 pares de calcetines altos. Algodón con refuerzo en talón y puntera. Colores tierra: blanco crudo, crema y marrón.'
            ],

            // --- CATEGORÍA: CALZADO ---
            [
                'name' => 'Zapatillas Calcetín con Plataforma',
                'price' => 89.00,
                'images' => [
                    ['path' => 'uploads/products/20/1.jpg', 'main' => 1],
                    ['path' => 'uploads/products/20/2.jpg', 'main' => 0],
                    ['path' => 'uploads/products/20/3.jpg', 'main' => 0]
                ],
                'desc' => 'Calzado deportivo con suela de espuma ultra-ligera. Exterior de malla transpirable. Amortiguación superior para correr o caminar.'
            ],
            [
                'name' => 'Botas Explorer Leather',
                'price' => 110.00,
                'images' => [
                    ['path' => 'uploads/products/21/1.jpg', 'main' => 1],
                    ['path' => 'uploads/products/21/2.jpg', 'main' => 0],
                    ['path' => 'uploads/products/21/3.jpg', 'main' => 0]
                ],
                'desc' => 'Botas de cuero auténtico tratadas para ser repelentes al agua. Suela dentada antideslizante. Plataforma del tacón de 9cm.'
            ],
            [
                'name' => 'Sneakers Canvas Basic',
                'price' => 38.00,
                'images' => [
                    ['path' => 'uploads/products/22/1.jpg', 'main' => 1],
                    ['path' => 'uploads/products/22/2.jpg', 'main' => 0],
                    ['path' => 'uploads/products/22/3.jpg', 'main' => 0]
                ],
                'desc' => 'Zapatillas de lona clásicas. Suela de goma vulcanizada blanca. Estilo atemporal que combina con todo.'
            ],
        ];

        foreach ($products as $p) {
            $product = Product::create([
                'product_name' => $p['name'],
                'description' => $p['desc'],
                'price' => $p['price'],
            ]);

            foreach ($p['images'] as $img) {
                $product->images()->create([
                    'image_path' => $img['path'],
                    'is_main' => $img['main'],
                ]);
            }
        }
    }
}
