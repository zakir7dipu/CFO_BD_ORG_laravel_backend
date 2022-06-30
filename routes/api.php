<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::prefix("app")->group(function (){
    Route::get('/base-info', [ApiController::class, 'baseInfoSection']);
    Route::get('/social-links', [ApiController::class, 'getSocialLinks']);
    Route::get('/slider', [ApiController::class, 'sliderView']);
    Route::get('/about', [ApiController::class, 'aboutSection']);
    Route::get('/goal-section', [ApiController::class, 'goalSection']);
    Route::get('/events', [ApiController::class, 'eventsSection']);
    Route::get('/all-events', [ApiController::class, 'eventsAll']);
    Route::get('/event/{event}', [ApiController::class, 'eventShow']);
    Route::get('/about-page', [ApiController::class, 'aboutPage']);
    Route::post('/contact-message', [ApiController::class, 'contactMessage']);
});

