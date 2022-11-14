<?php

use App\Http\Controllers\api\EpisodesController;
use App\Http\Controllers\api\SeasonsController;
use App\Http\Controllers\api\SeriesController;
use App\Models\Episode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', function (Request $request) {
    $creadentials = $request->only('email', 'password');

    if(Auth::attempt($creadentials) === false) {
        return response()->json('Unauthorized', 401);
    }

    /**
     * @var User
     */
    $user = Auth::user();
    $user->tokens()->delete();
    $token = $user->createToken('token');

    return response()->json($token->plainTextToken);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('series', SeriesController::class);
    Route::get('/series/{series}/seasons', [SeasonsController::class, 'index']);
    Route::get('/series/{series}/episodes', [EpisodesController::class, 'getAllEpisodesFromSeries']);
    Route::patch('/episodes/{episode}', [EpisodesController::class, 'updateWatched']);
});
