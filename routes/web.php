<?php

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

Route::get('/','BlogController@index')->name('index');
Route::get('/detail/{id}','BlogController@show')->name('detail');
Route::get('/category/{id}','BlogController@baseOnCategory')->name('baseOnCategory');
Route::get('/user/{id}','BlogController@baseOnUser')->name('baseOnUser');
Route::get('/date/{date}','BlogController@baseOnDate')->name('baseOnDate');
Route::view('/about','blog.about')->name('about');

Auth::routes();

Route::prefix("dashboard")->middleware(["auth","IsBanned"])->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::middleware("AdminOnly")->group(function(){
        Route::get('/user-manager', 'UserManagerController@index')->name('user-manager.index');
        Route::post('/user-manager', 'UserManagerController@makeAdmin')->name('user-manager.makeAdmin');
        Route::post('/ban-user', 'UserManagerController@banUser')->name('user-manager.banUser');
        Route::post('/unBan-user', 'UserManagerController@unBanUser')->name('user-manager.unBanUser');
        Route::post('/change-password', 'UserManagerController@changePassword')->name('user-manager.changePassword');
    });

    Route::resource('/category','CategoryController');
    Route::resource('/article','ArticleController');

    Route::prefix('profile')->group(function (){
        Route::get('/', 'ProfileController@index')->name('profile');
        Route::get('/update-photo', 'ProfileController@upload')->name('profile.update-photo');
        Route::post('/update-photo', 'ProfileController@changePhoto')->name('profile.update-edit-photo');
        Route::get('/update-name-email', 'ProfileController@changeNameEmail')->name('profile.update-nameEmail');
        Route::post('/update-email', 'ProfileController@changeEmail')->name('profile.update-email');
        Route::post('/update-name-email', 'ProfileController@changeName')->name('profile.update-name');
        Route::get('/change-password','ProfileController@changePasswordshow')->name('profile.change-password-show');
        Route::post('/change-password','ProfileController@changePassword')->name('profile.change-password');
        Route::post("/update-user-info","ProfileController@updateInfo")->name("profile.update.info");
    });

});
