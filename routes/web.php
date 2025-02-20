<?php

use Illuminate\Support\Facades\Route;

// Uses the Vue Router for any route not defined before this
Route::get('/{vue_capture?}', function() {
    return view('welcome');
})->where('vue_capture', '[\/\w\.-]*');
