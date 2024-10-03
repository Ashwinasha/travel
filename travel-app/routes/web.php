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


Route::get('/Slider-management', [adminSliderManagementController::class, 'slider_management'])->name('slider_management');
Route::get('/Add-slider', [adminSliderManagementController::class, 'add_slider'])->name('add_slider');
Route::get('/Edit-slider', [adminSliderManagementController::class, 'edit_slider'])->name('edit_slider');

// Slider Management post routes
Route::post('/store-slider', [adminSliderManagementController::class, 'store'])->name('store_slider');

// web.php
Route::get('/slider/edit/{id}', [AdminSliderManagementController::class, 'edit'])->name('slider.edit');

// web.php
Route::put('admin/slider/update/{id}', [AdminSliderManagementController::class, 'update'])->name('slider.update');


Route::delete('/slider/delete/{id}', [AdminSliderManagementController::class, 'destroy'])->name('delete_slider');

Route::delete('/slider/delete/{id}', [AdminSliderManagementController::class, 'destroy'])->name('delete_slider');

