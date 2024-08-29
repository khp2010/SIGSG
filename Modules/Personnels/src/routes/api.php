<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Dtic\Personnels\app\Http\Controllers\AgentController;
use Dtic\Personnels\app\Http\Controllers\PatientController;
use Dtic\Personnels\app\Http\Controllers\PersonneController;


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

Route::prefix("api/agents")->controller(AgentController::class)->group(function() {
    Route::get("/", "index");
    Route::post("create", "create");
    Route::get("{id}", "show");
    Route::patch("{id}/update", "update");
    Route::delete("{id}/destroy", "destroy");
});

Route::prefix("api/personnes")->controller(PersonneController::class)->group(function() {
    Route::get("/", "index");
    Route::post("create", "create");
    Route::get("{id}", "show");
    Route::patch("{id}/update", "update");
    Route::delete("{id}/destroy", "destroy");
});

Route::prefix("api/patients")->controller(PatientController::class)->group(function() {
    Route::get("/", "index");
    Route::post("create", "create");
    Route::get("{id}", "show");
    Route::patch("{id}/update", "update");
    Route::delete("{id}/destroy", "destroy");
});


