<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [ChatController::class, 'index'])->name('user.login');
Route::post('/broadcast', [ChatController::class, 'broadcastChat'])->name('broadcast.chat');
Route::get('/chat', [ChatController::class, 'NotFound'])->name('no.chat');
Route::post('/chat', [ChatController::class, 'chat'])->name('Chat');
Route::get('/group', [ChatController::class, 'groupPage'])->name('group.page');
Route::post('/group/create', [ChatController::class, 'createGroup'])->name('group.create');
Route::get('/chat', [ChatController::class, 'groupPage'])->name('group.page');
Route::post('/group/create', [ChatController::class, 'createGroup'])->name('group.create');
