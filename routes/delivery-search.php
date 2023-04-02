<?php

use App\Http\Controllers\DeliveryController;
use Illuminate\Support\Facades\Route;

Route::get('delivery-search', [DeliveryController::class, 'deliverySearch'])->name('deliverySearch');
Route::get('search-delivery', [DeliveryController::class, 'searchDelivery']);
Route::get('export-delivery-excel', [DeliveryController::class, 'exportDeliveryExcel']);
