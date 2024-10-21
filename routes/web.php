<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SitterController;
use Illuminate\Support\Facades\Auth;
use App\Models\Pet;

Auth::routes();

// routes/web.php
Route::get('/profile', [ProfileController::class, 'show'])->middleware('auth')->name('profile');


Route::get('/', function () {

    $pets = Pet::all();
    return view('home', ['pets' => $pets]);
});


Route::get('/add-pet', function () {return view('added-pet');})->name('add-pet');
Route::get('/pets/{id}/edit', [PetController::class, 'edit'])->name('pets.edit');
Route::put('/pets/{id}', [PetController::class, 'update'])->name('pets.update');
Route::delete('/pets/{id}', [PetController::class, 'destroy'])->name('pets.destroy');

Route::post('/upload-house-images', [SitterController::class, 'uploadHouseImages'])->middleware('auth')->name('upload.house.images');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/pets/store', [PetController::class, 'store'])->name('pets.store');