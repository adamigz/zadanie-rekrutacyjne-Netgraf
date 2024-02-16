<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function() {
    return redirect()->route('getByStatus', ['status' => 'available']);
});
Route::get('/pet/findByStatus', [PetController::class, 'index'])->name('getByStatus');
Route::get('/pet/create', [PetController::class, 'create'])->name('addPet');
Route::post('/pet/create', [PetController::class, 'store'])->name('storePet');
Route::get('/pet', [PetController::class, 'show'])->name('getById');
Route::post('/pet/find', [PetController::class, 'find'])->name('findById');
Route::get('/pet/{id}/update', [PetController::class, 'edit'])->name('updatePet');
Route::post('/pet/{id}/update', [PetController::class, 'update']);
Route::get('/pet/{id}/edit', [PetController::class, 'change'])->name('patchPet');
Route::post('/pet/{id}/edit', [PetController::class, 'patch']);
Route::get('/pet/uploadPhoto', [PetController::class, 'upload'])->name('uploadPhoto');
Route::post('/pet/uploadPhoto', [PetController::class, 'uploadPhoto']);
Route::get('/pet/{id}/delete', [PetController::class, 'destroy'])->name('deletePet');
