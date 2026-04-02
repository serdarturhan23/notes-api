<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/docs/api-docs.json', function () {
    $path = storage_path('api-docs/api-docs.json');

    abort_unless(file_exists($path), 404, 'Swagger JSON not found.');

    return response()->file($path, [
        'Content-Type' => 'application/json',
        'Cache-Control' => 'no-store, no-cache, must-revalidate',
    ]);
});