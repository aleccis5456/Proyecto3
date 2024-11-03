<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Producto;
use Illuminate\Support\Str;

class GenerateProductSlugs extends Command
{
    protected $signature = 'app:generate-product-slugs';
    protected $description = 'Genera slugs únicos para todos los productos existentes';

    public function handle()
    {
        $productos = Producto::all();

        foreach ($productos as $producto) {
            // Genera el slug basado en el nombre del producto
            $producto->slug = Str::slug($producto->nombre);
            $producto->save();
        }

        $this->info('Slugs generados para todos los productos existentes.');
    }
}


