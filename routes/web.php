<?php

use Illuminate\Support\Facades\Route;
use PtpnId\IonAuth\Controllers\InitController;

Route::get('/auth/init', [InitController::class, 'handle']);
