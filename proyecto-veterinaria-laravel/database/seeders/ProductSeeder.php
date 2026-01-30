<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Comida Premium para Perros',
                'description' => 'Alimento balanceado con ingredientes naturales para perros adultos de todas las razas.',
                'price' => 45.99,
                'image' => 'https://images.unsplash.com/photo-1589924691195-41432c84c161?q=80&w=2070&auto=format&fit=crop',
                'stock' => 50,
            ],
            [
                'name' => 'Juguete Interactivo para Gatos',
                'description' => 'Ratón electrónico recargable que estimula el instinto cazador de tu gato.',
                'price' => 12.50,
                'image' => 'https://images.unsplash.com/photo-1615809762174-8dbd157a582b?q=80&w=2070&auto=format&fit=crop',
                'stock' => 30,
            ],
            [
                'name' => 'Collar de Cuero Ajustable',
                'description' => 'Collar resistente y elegante, disponible en varios colores y tamaños.',
                'price' => 18.00,
                'image' => 'https://images.unsplash.com/photo-1605631097452-9caf92ba66c9?q=80&w=2070&auto=format&fit=crop',
                'stock' => 100,
            ],
            [
                'name' => 'Cama Ortopédica para Mascotas',
                'description' => 'Cama suave con espuma viscoelástica ideal para mascotas mayores.',
                'price' => 65.00,
                'image' => 'https://images.unsplash.com/photo-1591946614720-90a587da4a36?q=80&w=1974&auto=format&fit=crop',
                'stock' => 15,
            ],
            [
                'name' => 'Champú Hipoalergénico',
                'description' => 'Fórmula suave para pieles sensibles, libre de sulfatos y parabenos.',
                'price' => 14.99,
                'image' => 'https://images.unsplash.com/photo-1583947581924-860bda6a26df?q=80&w=2069&auto=format&fit=crop',
                'stock' => 80,
            ],
            [
                'name' => 'Jaula Espaciosa para Aves',
                'description' => 'Jaula de metal con múltiples niveles y accesorios incluidos.',
                'price' => 89.99,
                'image' => 'https://plus.unsplash.com/premium_photo-1664302152994-633cb8dfa8df?q=80&w=1974&auto=format&fit=crop',
                'stock' => 10,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
