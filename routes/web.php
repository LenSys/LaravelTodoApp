<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoListController;

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

Route::get('/', [TodoListController::class, 'index'])->name('root');

Route::post('/markItemAsComplete/{id}', [TodoListController::class, 'markItemAsComplete'])->where('id', '[0-9]+')->name('markItemAsComplete');

Route::post('/saveItem', [TodoListController::class, 'saveItem'])->name('saveItem');
