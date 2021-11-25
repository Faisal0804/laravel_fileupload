<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('Home');
});
Route::post("/fileUp",[\App\Http\Controllers\fileUpController::class,'fileUp'])->name('filesave');

Route::get('/List', function () {
    return view('FileDownloadList');
});

Route::get("/fileDownload/{FolderPath}/{name}",[\App\Http\Controllers\DownloadController::class,'onDownload']);
Route::get('/fileList',[\App\Http\Controllers\DownloadController::class,'onSelectFileList']);
