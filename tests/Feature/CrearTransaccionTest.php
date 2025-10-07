<?php

use App\Models\User;
use App\Models\Categoria;
use App\Models\Grupo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TransaccionCreada;

// uses(RefreshDatabase::class);

test('un usuario logueado puede crear una transaccion', function () {
    // Evitar notificaciones reales
    Notification::fake();

    // Crear usuario, categoria y grupo
    $user = User::factory()->create();
    $categoria = Categoria::factory()->create();
    $grupo = Grupo::factory()->create();

    // Datos válidos para la transacción
    $data = [
        'descripcion' => 'Compra de prueba',
        'monto' => 100.50,
        'fecha_transaccion' => now()->toDateString(),
        'categoria' => $categoria->id,
        'grupo' => $grupo->id,
    ];

    // Autenticar usuario y enviar petición
    $response = $this->actingAs($user)
        ->post(route('transacciones.store'), $data);

    // Verificar redirección y mensaje de éxito
    $response->assertRedirect(route('transacciones.index'));
    $response->assertSessionHas('exito', 'Transaccion creada exitosamente.');

    // Verificar que la transacción fue creada
    $this->assertDatabaseHas('transacciones', [
        'descripcion' => 'Compra de prueba',
        'monto' => 100.50,
        'user_id' => $user->id,
        'categoria_id' => $categoria->id,
        'grupo_id' => $grupo->id,
    ]);

    // Verificar que se envió la notificación
    Notification::assertSentTo($user, TransaccionCreada::class);
});