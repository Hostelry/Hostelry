<?php

use Illuminate\Support\Facades\Route;
use Hostelry\Account\Http\Controllers\SignInController;

Route::post('/account/sign-in', SignInController::class)->name('api.account.sign-in');
