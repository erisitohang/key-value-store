<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeyValueController;

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

Route::group(['middleware' => ['api']], function () {
    Route::prefix('object')->group(function () {
        Route::get('/get_all_records', [KeyValueController::class, 'index']);
        Route::get('/{key}', [KeyValueController::class, 'show']);
        Route::post('/', [KeyValueController::class, 'store']);
    });
    Route::get('/', function () {
        return response()->json(['status' => 'OK']);
    });
});
