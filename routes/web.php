<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;

Route::get('/upload', function () {
    return view('upload');
});

Route::post('/upload-json', [UploadController::class, 'upload']);
