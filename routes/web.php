<?php

use App\Http\Controllers\Admin\PointController as AdminPointController;
use App\Http\Controllers\PointController;
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
});
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::resource('admin/points', AdminPointController::class)->only(['index', 'store', 'destroy']);

    Route::post('admin/points/search', [AdminPointController::class, 'search'])->name('points.search');
    
    Route::get('/points/1', [PointController::class, 'index'])->name('points');
    
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    
});

require __DIR__.'/auth.php';
