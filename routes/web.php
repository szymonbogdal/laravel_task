<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

Route::get('/', function () {
  return redirect()->route('pets.index', ['status' => 'available']);
});

Route::get('/pets', function () {
  return redirect()->route('pets.index', ['status' => 'available']);
});

Route::get('pets/status/{status?}', [PetController::class, 'index'])->name("pets.index");
Route::resource('pets', PetController::class)->except(['index']);
