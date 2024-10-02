<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('travel');
});

Route::get('/Contact', function () {
    return view('contact');
})->name('contact');


use App\Http\Controllers\admin\adminSliderManagementController;

Route::get('/add_slider', [adminSliderManagementController::class, 'add_slider'])->name('add_slider');

Route::get('/slider_management', [adminSliderManagementController::class, 'slider_management'])->name('slider_management');
Route::get('/edit_slider', [adminSliderManagementController::class, 'edit_slider'])->name('edit_slider');