<?php

use App\Http\Controllers\activity_controller;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\files_controller;
use App\Http\Controllers\subject_controller;
use App\Http\Controllers\users_controller;
use App\Http\Controllers\webinar_controller;
use App\Http\Controllers\webType_controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [Authentication::class, 'login'])->name('user.login');
Route::post('/signup', [users_controller::class,  'store'])->name('user.store');

Route::get('/user', [users_controller::class, 'index']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [Authentication::class, 'logout']);
    Route::get('/webtype', [webType_controller::class, 'index']);


    Route::controller(users_controller::class)->group(function () {

        // Route::get('/user',                     'index');
        Route::get('/user/{id}',                'show');
        Route::post('/user',                    'store');
        Route::post('/fname-user/{id}',         'fName');
        Route::post('/lname-user/{id}',         'lName');
        Route::post('/email-user/{id}',         'email');
        Route::post('/password-user/{id}',      'password');
        Route::delete('/user/{id}',             'destroy');
    });

    Route::controller(activity_controller::class)->group(function () {
        Route::get('/false-activity/{id}',          'unfilData');
        Route::get('/true-activity/{id}',           'filData');
        Route::get('/latestActivity/{id}',          'latestActivity');


        Route::get('/activity',                     'index');
        Route::get('/cpt-act',                      'activities');
        Route::get('/activity/{id}',                'show');
        Route::post('/activity',                    'store');
        Route::put('/activity/{id}',                'update');
        Route::delete('/activity/{id}',             'destroy');
    });

    Route::controller(files_controller::class)->group(function () {
        Route::get('/latestFile/{id}',           'latestFile');

        Route::get('/file',                     'index');
        Route::get('/userFile/{id}',            'userFiles');
        Route::get('/file/{id}',                'show');
        Route::post('/file',                    'store');
        Route::put('/file/{id}',                'update');
        Route::delete('/file/{id}',             'destroy');
    });

    Route::controller(subject_controller::class)->group(function () {

        Route::get('/subject',                     'index');
        Route::get('/subject/{id}',                'show');
        Route::post('/subject',                    'store');
        Route::put('/subject/{id}',                'update');
        Route::delete('/subject/{id}',             'destroy');
    });

    Route::controller(webinar_controller::class)->group(function () {
        Route::get('/latestWebinar/{id}',          'latestWebinar');
        Route::get('/cpt-web/{id}',                'webinars');


        Route::get('/webinar',                     'index');
        Route::get('/webinar/{id}',                'show');
        Route::post('/webinar',                    'store');
        Route::put('/webinar/{id}',                'update');
        Route::delete('/webinar/{id}',             'destroy');
    });
});
