<?php

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

Auth::routes(['reset' => false]);
//Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::resource('/books',App\Http\Controllers\BookController::class);
    Route::get('/books/{id}/delete', [App\Http\Controllers\BookController::class, 'destroy']);
    Route::get('/todolists', [App\Http\Controllers\ToDoListController::class, 'index'])->name('todolists');
    Route::get('/gettodolist', [App\Http\Controllers\ToDoListController::class, 'getToDoList'])->name('getToDoList');
});

