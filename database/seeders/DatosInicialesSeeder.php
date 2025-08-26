<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatosInicialesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cargar contenido del archivo database/sql/datos.sql
        $sql = file_get_contents(database_path('sql/datos.sql'));
        // Ejecutar el contenido del archivo en nuestra BD
        DB::unprepared($sql);
    }
}
