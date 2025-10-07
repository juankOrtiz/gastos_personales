<?php

test('comprobar que el formulario de login requiere una contrasenia', function() {
    $this->post('/login', [
        'email' => 'juan@mail,com',
        'password' => ''
    ])->assertInvalid(['password' => 'required']);
});