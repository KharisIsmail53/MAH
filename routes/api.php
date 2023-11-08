<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZakatController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/stock-beras', [ZakatController::class, 'api_insert'])->name('api_insertstock');
Route::get('/stock', [ZakatController::class, 'api_render'])->name('api_renderstock');
Route::post('/update-stock-beras', [ZakatController::class, 'api_edit'])->name('api_updatestock');




