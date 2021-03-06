<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/chat', function () {
    return Inertia::render('Chat/container');
})->name('chat');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/chat/rooms', [ChatController::class, 'rooms'])->name('rooms');
    Route::get('/chat/rooms/{roomId}/messages', [ChatController::class, 'messages']);
    Route::post('/chat/rooms/{roomId}/message', [ChatController::class, 'newMessage']);
    Route::post('/finduser', [UserController::class, 'finduser']);
    Route::post('/createnewroom', [RoomController::class, 'createnewroom']);
    Route::post('/roomdetails', [RoomController::class, 'roomdetails']);
});
