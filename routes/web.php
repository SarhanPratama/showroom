<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.frontend');
});

Route::get('admin/dashboard', function () {
    return view('backend.dashboard.index');
});


Route::get('/detail', function () {
    return view('frontend.detail');
});
