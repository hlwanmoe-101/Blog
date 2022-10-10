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

//Route::view('/','BlogController@index')->name('index');

Auth::routes();
Route::get('/', 'BlogController@index')->name('index');
Route::get('/detail/{id}','BlogController@detail')->name('blog.detail');
Route::get('/categozry/{id}','BlogController@baseOnCategory')->name('blog.category');
Route::get('/user/{id}','BlogController@baseOnUser')->name('blog.user');
Route::get('/date/{date}','BlogController@baseOnDate')->name('blog.date');


Route::view('/about',"blog.about")->name("about");

Route::prefix('dashboard')->middleware(['auth','isBaned'])->group(function(){
    Route::resource('category','CategoryController');
    Route::resource('article','ArticleController');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::middleware('adminOnly')->group(function (){
        Route::get('/user-manager','UserManagerController@index')->name('user-manager.index');
        Route::post('/make-admin','UserManagerController@makeAdmin')->name('user-manager.makeAdmin');
        Route::post('/baned','UserManagerController@baned')->name('user-manager.baned');
    });

    Route::prefix('profile')->group(function(){
        // Main Frame Route
        Route::get('/','ProfileController@profile')->name('profile');
        Route::get('/edit-photo','ProfileController@editPhoto')->name('profile.edit.photo');
        Route::get('/edit-password','ProfileController@editPassword')->name('profile.edit.password');
        Route::get('/edit-name-and-email','ProfileController@editNameEmail')->name('profile.edit.name.email');
        Route::post('/change-password','ProfileController@changePassword')->name('profile.changePassword');
        Route::post('/change-name','ProfileController@changeName')->name('profile.changeName');
        Route::post('/change-email','ProfileController@changeEmail')->name('profile.changeEmail');
        Route::post('/change-photo','ProfileController@changePhoto')->name('profile.changePhoto');
        Route::post("/update-user-info","ProfileController@updateInfo")->name("profile.update.info");
    });
});




