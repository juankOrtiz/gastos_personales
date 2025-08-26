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
            $table->foreignId('categoria_id')->constrained();
            $table->foreignId('grupo_id')->constrained();
            $table->bigInteger('user_id')->nullable();
            // Si no sigo las convenciones, puedo definir la FK de la siguiente forma:
            // $table->foreign('categoria_id')->references('idcategoria')->on('categorias');
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
