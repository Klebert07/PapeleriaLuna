<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/api/docs', function () {
    return view('l5-swagger::swagger-ui');
});

require __DIR__.'/auth.php';
