<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Student\StudentDashboardController;

use App\Models\MenuItem;

Route::get('/', function () {
    $menuItems = MenuItem::with('category')->take(6)->get();
    return view('welcome', compact('menuItems'));
});

// Role-based Dashboard Redirection
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('student.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuItemController;

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/students', [AdminDashboardController::class, 'students'])->name('students.index');
    
    Route::resource('categories', CategoryController::class);
    Route::resource('menu-items', MenuItemController::class);
    Route::patch('/menu-items/{menuItem}/toggle', [MenuItemController::class, 'toggleAvailability'])->name('menu-items.toggle');
    
    // Order Management
    Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.update-status');
});

use App\Http\Controllers\Student\CartController;
use App\Http\Controllers\Student\OrderController as StudentOrderController;

// Student Routes
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
    Route::get('/menu', [StudentDashboardController::class, 'menu'])->name('menu');
    
    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/add-to-cart/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/update-cart', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/remove-from-cart', [CartController::class, 'remove'])->name('cart.remove');

    // Order Routes
    Route::post('/checkout', [StudentOrderController::class, 'checkout'])->name('checkout');
    Route::get('/orders', [StudentOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [StudentOrderController::class, 'show'])->name('orders.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
