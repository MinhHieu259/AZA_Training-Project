<?php

use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('delivery-detail', [DeliveryController::class, 'deliveryDetail'])->name('deliveryDetail');
Route::post('validation-insert-delivery', [DeliveryController::class, 'validationInsertDelivery']);
Route::post('insert-delivery', [DeliveryController::class, 'insertDelivery']);
Route::put('update-delivery/{id}', [DeliveryController::class, 'updateDelivery']);
Route::delete('delete-delivery-by-id/{id}', [DeliveryController::class, 'deleteDeliveryById']);
Route::get('get-info-zipcode/{zipcode}', [DeliveryController::class, 'getInfoZipcode']);
Route::get('get-data-delivery-by-id/{id}', [DeliveryController::class, 'getDataDeliveryById']);
Route::get('search-in-delivery', [DeliveryController::class, 'searchInDeliveryDetail']);
