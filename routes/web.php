<?php

use App\Http\Controllers\LeadsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LeadsController::class, 'index'])->name('index');
Route::get('/tambah/leads', [LeadsController::class, 'create'])->name('leads.create');

Route::get('/leads/{lead}/edit', [LeadsController::class, 'edit'])->name('leads.edit');
Route::put('/leads/{lead}', [LeadsController::class, 'update'])->name('leads.update');
Route::post('/leads', [LeadsController::class, 'store'])->name('leads.store');
Route::post('/leads/{lead}/follow-up', [LeadsController::class, 'followUp'])
    ->name('leads.followUp');
Route::post('/leads/{lead}/deal', [LeadsController::class, 'deal'])
    ->name('leads.deal');
    Route::delete('/leads/{lead}', [LeadsController::class, 'destroy'])
    ->name('leads.destroy');

