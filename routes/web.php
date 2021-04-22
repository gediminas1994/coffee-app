<?php

use App\Http\Controllers\CoffeeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('coffee.index');
});

Route::get('/coffee', [CoffeeController::class, 'index'])->name('coffee.index');
Route::get('/coffee/create', [CoffeeController::class, 'create'])->name('coffee.create');
Route::post('/coffee', [CoffeeController::class, 'store'])->name('coffee.store');
Route::get('/coffee/{coffee}', [CoffeeController::class, 'edit'])->name('coffee.edit');
Route::put('/coffee/{coffee}', [CoffeeController::class, 'update'])->name('coffee.update');
Route::delete('/coffee/{coffee}', [CoffeeController::class, 'destroy'])->name('coffee.delete');
