<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Models\Cliente;
use App\Models\Estados;

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
Route::middleware(['web'])->group(function () {
    // your routes here
});


Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');

Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');

Route::get('/clientes/{id}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::put('/clientes/{id}', [ClienteController::class, 'update'])->name('clientes.update');
Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
Route::get('/clientes/search', [ClienteController::class, 'search'])->name('clientes.search');


Route::get('/', function () {
    $clientes = Cliente::paginate(4);
    $estados = Estados::all();
    return view('clientes.index', compact('clientes', 'estados'));
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
