<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\API\PodcastController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\WebhookController as APIWebhookController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Cashier\Http\Controllers\WebhookController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/signup', [UserController::class, 'signupUser']);
Route::post('/login', [UserController::class, 'loginUser']);
Route::post('/checkout/{planId}', [CheckoutController::class, 'checkout']);
// Route::get('/podcasts', [PodcastController::class, 'index']);
Route::post('/podcasts/search', [PodcastController::class, 'podcastSearch']);

Route::get('/podcasts', [PodcastController::class, 'index']);
Route::post('/podcasts', [PodcastController::class, 'store']);
Route::get('/podcasts/{id}', [PodcastController::class, 'show']);
Route::put('/podcasts/{id}', [PodcastController::class, 'update']);
Route::delete('/podcasts/{id}', [PodcastController::class, 'destroy']);
Route::post('/podcasts/search', [PodcastController::class, 'podcastSearch']);

Route::middleware(['auth:api', 'admin'])->group(function () {
    Route::get('users', [AdminController::class, 'getAllUsers']);
    Route::post('editUser/{id}', [AdminController::class, 'editUser']);
    Route::post('updateUser/{id}', [AdminController::class, 'updateUser']);
    Route::post('deleteUser/{id}', [AdminController::class, 'deleteUser']);
});


Route::middleware('auth:api')->group(function () {
    Route::post('userDetails', [UserController::class, 'getUserDetails']);
    // Route::get('usersData', [UserController::class, 'getUserData']);
    Route::get('logout', [UserController::class, 'userLogout']);
});
