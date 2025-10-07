<?php

use App\Models\User;
 
// Primera prueba de humo
/*test('se puede visitar la pagina de login', function () {
    $this->get('/login')
        ->assertOk();
});*/

// Prueba de humo para la zona publica
test('se pueden visitar las paginas de la zona publica', function ($url) {
    $this->get($url)
        ->assertOk();
})->with(['/login', '/forgot-password']);

test('no se puede visitar la zona privada sin usuario', function ($url) {
    $this->get($url)
        ->assertStatus(302);
})->with(['/transacciones', '/dashboard', '/transacciones/create']);

test('el dashboard redirecciona a usuarios no logueados', function () {
    $this->get('/dashboard')
        ->assertStatus(302);
});

test('los usuarios logueados pueden visitar el dashboard', function () {
    $usuario = User::first();
    $this->actingAs($usuario)
        ->get('/dashboard')
        ->assertOk();
});