<?php

namespace App\Utils;

class Util
{
    public static function stats()
    {
        $stats = [
            'conteo' => 0,
            'total_conteo' => 0,
            'total_pagar' => 0,
        ];

        if (session('carrito')) {
            $stats['conteo'] = count(session('carrito'));

            $total_conteo = 0;
            $total_pagar = 0;

            // foreach (session('carrito') as $item) {
            //     $unidades = $item['cantidad'] ?? 0;
            //     $precio = ($item['precio'] ?? 0);
            //     $precio_oferta = $item['precio_oferta'] ?? 0;

            //     $precio_oferta += $precio_oferta * $unidades;
            //     $total_conteo += $unidades;
            //     $total_pagar += ($precio * $unidades) + $precio_oferta;
            // }
            foreach (session('carrito') as $item) {
                $unidades = $item['cantidad'] ?? 0;

                if($item['precio_oferta'] > 0){
                    $precio = $item['precio_oferta'] ?? 0;
                }else{
                    $precio = ($item['precio'] ?? 0);    
                }
                // $precio = ($item['precio'] ?? 0);
                // $precio_oferta = $item['precio_oferta'] ?? 0;

                //$precio_oferta += $precio_oferta * $unidades;
                $total_conteo += $unidades;
                $total_pagar += $precio * $unidades;
            }

            $stats['total_conteo'] = $total_conteo;
            $stats['total_pagar'] = $total_pagar;

            session(['stats' => $stats]);
        }

        return $stats;
    }

    public static function formatearFecha($fecha)
    {
        return \Carbon\Carbon::parse($fecha)->format('d-M-Y \a \l\a\s H:i');
    }
}
