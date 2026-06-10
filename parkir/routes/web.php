<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\TransactionController;

// Main Transactions Page
Route::get('/', [TransactionController::class, 'index'])->name('transactions.index');

// Capacities & Ticket Details API
Route::get('/check-capacity', [TransactionController::class, 'checkCapacity'])->name('transactions.check-capacity');
Route::get('/tickets/{id}/details', [TransactionController::class, 'getTicketDetails'])->name('transactions.ticket-details');

// Enter & Exit Vehicle
Route::post('/transactions/enter', [TransactionController::class, 'storeEntry'])->name('transactions.store-entry');
Route::post('/transactions/exit', [TransactionController::class, 'storeExit'])->name('transactions.store-exit');

// View All Transactions
Route::get('/transactions/all', [TransactionController::class, 'viewAll'])->name('transactions.view-all');

// CRUD Locations
Route::resource('locations', LocationController::class);

// CRUD Vehicle Types
Route::resource('vehicle-types', VehicleTypeController::class);

// Dynamic Ticket PDF Download/Stream Route
Route::get('/tickets/{ticket_number}/pdf', [TransactionController::class, 'downloadTicket'])->name('transactions.download-ticket');
