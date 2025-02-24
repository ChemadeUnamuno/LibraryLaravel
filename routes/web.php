<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::redirect('/', '/loans');

Route::middleware(['auth'])->group(function () {

    Route::prefix('loans')->name('loans.')->group(function () {
        Route::get('/', [PrestamoController::class, 'index'])->name('index');
        Route::get('/download', PdfController::class)->name('download');
        Route::middleware(AdminMiddleware::class)->group(function () {
            Route::get('/new_loan', [PrestamoController::class, 'create'])->name('new_loan');
            Route::post('/store', [PrestamoController::class, 'store'])->name('store');
            Route::get('/{loans}', [PrestamoController::class, 'show'])->name('show');
            Route::get('/edit/{id}', [PrestamoController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [PrestamoController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [PrestamoController::class, 'destroy'])->name('delete');
            Route::get('/confirmDelete/{id}', [PrestamoController::class, 'confirmDelete'])->name('confirmDelete');
        });
    });

    Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
    Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
