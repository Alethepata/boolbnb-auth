<?php

// use App\Http\Controllers\Guest\PageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Pagecontroller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/apartments', [PageController::class, 'apartments']);
Route::get('/apartments/apartment-detail/{slug}', [PageController::class, 'apartmentDetail']);
Route::get('/services', [PageController::class, 'services']);
Route::get('/apartments/search-apartments/{num_rooms}/{num_beds}/{latitude}/{longitude}/{radius}/{services}', [PageController::class, 'searchApartments']);
