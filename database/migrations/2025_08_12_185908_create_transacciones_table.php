<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id(); // id BIGINT AUTOINCREMENT PRIMARY KEY
            $table->string('descripcion');    // descripcion VARCHAR
            $table->decimal('monto', 10, 2);   // monto DECIMAL(10, 2)
            $table->date('fecha_transaccion'); // fecha_transaccion DATE
            $table->timestamps(); // created_at y updated_at (TIMESTAMPS)
            $table->softDeletes(); // deleted_at (TIMESTAMP)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacciones');
    }
};
