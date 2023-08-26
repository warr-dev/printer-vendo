<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Http\Request;
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

// Route::get('/', [PublicController::class, 'index'])->name('public');
Route::controller(PublicController::class)->group(function ($route) {
    $route->get('/', 'index')->name('public');
    $route->post('/upload/doc', 'uploadDoc')->name('upload.doc');
    $route->get('/modal/print', 'printModal')->name('modal.print');
    $route->get('/summary', 'getSummary')->name('get.summary');
});
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function ($route) {
        $route->resource('/', AdminController::class);
        $route->get('/logs', [AdminController::class, 'logs']);
        // $route->post('/upload/doc','uploadDoc')->name('upload.doc');
    });

// Route::get('/admin', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
