<?php

use App\Http\Controllers\DeliveryController;
use Illuminate\Support\Facades\Route;

Route::get('get-all-provinces', [DeliveryController::class, 'getAllProvinces']);
Route::get('get-all-delivery-category', [DeliveryController::class, 'getAllDeliveryCategory']);
