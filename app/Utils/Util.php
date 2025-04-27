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

            foreach (session('carrito') as $item) {
                $unidades = $item['cantidad'] ?? 0;

                if($item['precio_oferta'] > 0){
                    $precio = $item['precio_oferta'] ?? 0;
                }else{
                    $precio = ($item['precio'] ?? 0);    
                }
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
    public static function soloFecha($fecha)
    {
        return \Carbon\Carbon::parse($fecha)->format('d-M-Y');
    }

    public static function statsVentaCaja()
    {
        $stats = [
            'conteo' => 0,
            'total_conteo' => 0,
            'total_pagar' => 0,
        ];

        if (session('ventaCaja')) {
            $stats['conteo'] = count(session('ventaCaja'));

            $total_conteo = 0;
            $total_pagar = 0;

            foreach (session('ventaCaja') as $item) {
                $unidades = $item['cantidad'] ?? 0;

                if($item['precio_oferta'] > 0){
                    $precio = $item['precio_oferta'] ?? 0;
                }else{
                    $precio = ($item['precio'] ?? 0);    
                }
                $total_conteo += $unidades;
                $total_pagar += $precio * $unidades;
            }

            $stats['total_conteo'] = $total_conteo;
            $stats['total_pagar'] = $total_pagar;

            session(['statsVentaCaja' => $stats]);
        }

        return $stats;
    }
}
