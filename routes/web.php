<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

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


Auth::routes();

Route::middleware('auth')->group(function (){
    Route::post('/tweets','TweetController@store');
    Route::get('/tweets','TweetController@index')->name('home');

    Route::get('/explore', 'ExploreController');

    Route::post('/profiles/{user:username}/follow','FollowController@store');
    Route::get('/profiles/{user:username}/edit','ProfileController@edit')->middleware('can:edit,user');
    Route::patch('/profiles/{user:username}','ProfileController@update')->middleware('can:edit,user');

    Route::post('/tweets/{tweet}/like','TweetLikesController@store');
    Route::delete('/tweets/{tweet}/like','TweetLikesController@destroy');
});

Route::get('/profiles/{user:username}','ProfileController@show')->name('profile');

Route::get('/download-dataset',function (){
    return Excel::download(new \App\Exports\PlantsExport, 'utilities.xlsx');
});
