<?php

use App\Http\Controllers\AdminController;
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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::prefix("settings")->as("settings.")->group(function (){
        Route::get('/general', [AdminController::class, 'generalSettings'])->name('general');
        Route::post('/general', [AdminController::class, 'storeGeneralSettings'])->name('general');

        Route::prefix("home-page")->as("home-")->group(function () {
            Route::get('/', [AdminController::class, 'homePageSettings'])->name('page');
            // slider
            Route::get('/slider', [AdminController::class, 'createSlider'])->name('slider');
            Route::get('/slider/{slider}', [AdminController::class, 'showSlider'])->name('slider-show');
            Route::post('/slider', [AdminController::class, 'storeSlider'])->name('slider');
            Route::post('/slider/{slider}', [AdminController::class, 'updateSlider'])->name('slider-update');
            Route::get('/slider-destroy/{slider}', [AdminController::class, 'destroySlider'])->name('slider-destroy');
            // about
            Route::post('/about', [AdminController::class, 'storeAbout'])->name('about');
            // goal
            Route::post('/goal', [AdminController::class, 'storeGoal'])->name('goal');
            // event
            Route::get('/event', [AdminController::class, 'createEvent'])->name('event');
            Route::get('/event/{event}', [AdminController::class, 'showEvent'])->name('event-show');
            Route::post('/event', [AdminController::class, 'storeEvent'])->name('event');
            Route::post('/event/{event}', [AdminController::class, 'updateEvent'])->name('event-update');
            Route::get('/event-destroy/{event}', [AdminController::class, 'destroyEvent'])->name('event-destroy');
        });

        Route::prefix("about-page")->as("about-")->group(function () {
            Route::get("/", [AdminController::class, "aboutPageSettings"])->name("page");
            Route::post("/", [AdminController::class, "storeAboutPageSettings"])->name("page");
        });
    });

    Route::prefix('contact-message')->as('message.')->group(function () {
        Route::get('/', [AdminController::class, 'contactMessageIndex'])->name('index');
        Route::get('/{message}', [AdminController::class, 'contactMessageShow'])->name('show');
    });

});
