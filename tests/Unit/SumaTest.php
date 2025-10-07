<?php

test('comprobar que 1 + 2 es 3', function () {
    // API de expectativas
    $suma = 1 + 2;
    expect($suma)->toBe(3);
});

test('comprobar que 1 + 2 no es 4', function () {
    // API de expectativas
    $suma = 1 + 2;
    expect($suma)
        ->not
        ->toBe(4);
});