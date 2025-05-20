<?php

namespace App\Helpers;

use Carbon\Carbon;

class Transacciones {
    public static function getDatos(): array {
        $ahora = Carbon::now();

        $transacciones = [
            [
                'user_id' => 1,
                'description' => 'Compra general de supermercado',
                'amount' => 15000.75,
                'transaction_date' => '2025-01-15',
                'created_at' => $ahora,
                'updated_at' => $ahora,
            ],
            [
                'user_id' => 2,
                'description' => 'Pago factura de electricidad',
                'amount' => 200000,
                'transaction_date' => '2025-01-20',
                'created_at' => $ahora,
                'updated_at' => $ahora,
            ],
            [
                'user_id' => 1,
                'description' => 'Cena en un restaurante',
                'amount' => 150000,
                'transaction_date' => '2025-01-25',
                'created_at' => $ahora,
                'updated_at' => $ahora,
            ],
        ];

        return $transacciones;
    }
}