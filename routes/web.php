<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\AllocationController;
use App\Http\Controllers\TechnicianController;
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

// Route::get('/', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');;

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');;
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('complaints', [ComplaintController::class, 'index'])->name('complaints');
    // Route::get('complaints/{id}', [ComplaintController::class, 'details'])->name('complaints.view');

    Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints');
    Route::get('/complaints/create', [ComplaintController::class, 'create'])->name('complaints.create');
    Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');
    Route::get('/complaints/{complaint}', [ComplaintController::class, 'show'])->name('complaints.view');
    Route::post('/complaints/{complaint}/assign-technician', [ComplaintController::class, 'assignTechnician'])->name('complaints.assignTechnician');

    Route::get('products', [ProductController::class, 'index'])->name('products');

    Route::get('inventories', [InventoryController::class, 'index'])->name('inventories');
    Route::post('inventories/upload', [InventoryController::class, 'uploadCsv'])->name('inventories.upload');

    Route::get('inventories/allocations', [AllocationController::class, 'index'])->name('inventories.allocations');

    Route::get('technicians', [TechnicianController::class, 'index'])->name('technicians');
});

require __DIR__.'/auth.php';
