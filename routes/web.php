<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\ComprasController;
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
    return view('home.index');
});

Route::group(['middleware' => ['auth']], function() {
//Admin middleware

Route::get('/admin', [ ComprasController::class, 'getClientesForIndex']);

    Route::get('/create-cliente', [ ClientesController::class, 'create' ]);
    Route::post('/cliente' , [ ClientesController::class, 'store' ]);
    Route::put('/cliente/{id}' , [ ClientesController::class, 'update' ]);
    Route::get('/edit-cliente/{id}' , [ ClientesController::class, 'edit' ]);
    Route::delete('/cliente/{id}' , [ ClientesController::class, 'destroy' ]);
    Route::get('/admin-clientes', [ ClientesController::class, 'index' ]);

    Route::get('/create-produto', [ ProdutosController::class, 'create' ]);
    Route::post('/produto' , [ ProdutosController::class, 'store' ]);
    Route::put('/produto/{id}' , [ ProdutosController::class, 'update' ]);
    Route::get('/edit-produto/{id}' , [ ProdutosController::class, 'edit' ]);
    Route::delete('/produto/{id}' , [ ProdutosController::class, 'destroy' ]);
    Route::get('/admin-produtos', [ ProdutosController::class, 'index' ]);

    Route::get('/create-compra', [ ComprasController::class, 'create' ]);
    Route::post('/compra', [ ComprasController::class, 'store' ]);
    Route::get('/faturamento', [ ComprasController::class, 'faturamento']);
    Route::put('/cadastrarpagamento/{id}', [ ComprasController::class, 'pagou']);
    Route::put('/cadastrarpagamentoatrasado/{id}', [ ComprasController::class, 'pagouAtrasado']);

//End admin middleware
});




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
