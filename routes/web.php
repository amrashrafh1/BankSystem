<?php

use App\Http\Controllers\Admin\PointController as AdminPointController;
use App\Http\Controllers\Admin\PrizeController;
use App\Http\Controllers\Admin\TransactionController;
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

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {

        Route::resource('points', AdminPointController::class)->only(['index', 'store', 'destroy']);

        Route::post('points/search', [AdminPointController::class, 'search'])->name('points.search');

        Route::resource('prizes', PrizeController::class);

        Route::post('prizes/search', [PrizeController::class, 'search'])->name('prizes.search');

        Route::resource('transactions', TransactionController::class)->except(['show']);
        
        Route::post('transactions/search', [TransactionController::class, 'search'])->name('transactions.search');

    });

});

require __DIR__ . '/auth.php';
