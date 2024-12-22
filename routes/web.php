<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentInformationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BorrowerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/CET-dashboard', function () {
    return view('CET.dashboard');
})->middleware(['auth', 'verified'])->name('CET.dashboard');

Route::get('CET/dashboard', [dashboardController::class, 'dashboard'])->name('CET.dashboard');

// Books Routes
Route::get('CET/Inventory/Book-Dashboard', [BookController::class, 'book'])->name('CET.inventory.book.book-dashboard');

// Additional CRUD routes
Route::get('CET/Inventory/Book/Create', [BookController::class, 'create'])->name('CET.inventory.book.create'); // Create form
Route::post('CET/Inventory/Book/Store', [BookController::class, 'store'])->name('CET.inventory.book.store'); // Store new book
Route::get('CET/Inventory/Book/Edit/{id}', [BookController::class, 'edit'])->name('CET.inventory.book.edit'); // Edit form
Route::put('CET/Inventory/Book/Update/{id}', [BookController::class, 'update'])->name('CET.inventory.book.update');
Route::delete('CET/Inventory/Book/Delete/{id}', [BookController::class, 'destroy'])->name('CET.inventory.book.destroy'); // Delete book
Route::post('/books/import', [BookController::class, 'import'])->name('CET.inventory.book.import');


// Routes for Borrowers
Route::get('CET/Inventory/Borrowers', [BorrowerController::class, 'index'])->name('CET.inventory.borrowers.index'); // Borrowers page
Route::post('CET/Inventory/Borrowers/Store', [BorrowerController::class, 'store'])->name('CET.inventory.borrowers.store'); // Borrow book
Route::patch('/borrowers/{id}/return', [BorrowerController::class, 'setReturn'])->name('CET.inventory.borrowers.return');
Route::get('/borrowers/history', [BorrowerController::class, 'history'])->name('CET.inventory.borrowers.history');




Route::get('CET/student-dashboard', [StudentInformationController::class, 'studentInformation'])->name('CET.student_information.student-dashboard');




Route::get('CET/Inventory/Equipment-Dashboard', [EquipmentController::class, 'equipments'])->name('CET.inventory.equipment.equipment-dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
