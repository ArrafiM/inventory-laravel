<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Item\List\ItemListIndex as ItemList;
use App\Livewire\Pages\Item\Category\CategoryIndex as ItemCategory;
use App\Livewire\Pages\Item\Supplier\SupplierIndex as ItemSupplier;
use App\Livewire\Pages\Item\Transaction\TransactionIndex as ItemTransaction;
use App\Livewire\Pages\Item\Transaction\TransactionCreate as ItemTransactionCreate;
use App\Livewire\Pages\Dashboard;

Route::view('/', 'welcome');


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::prefix('dashboard')->middleware(['auth','verified'])->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/item/list', ItemList::class)->name('dashboard.item.list');
    Route::get('/item/category', ItemCategory::class)->name('dashboard.item.category');
    Route::get('/item/supplier', ItemSupplier::class)->name('dashboard.item.supplier');
    Route::get('/item/transaction', ItemTransaction::class)->name('dashboard.item.transaction');
    Route::get('/item/transaction-create', ItemTransactionCreate::class)->name('dashboard.item.transaction.create');
});

require __DIR__.'/auth.php';
