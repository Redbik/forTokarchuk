<?php



Auth::routes();



Route::get('/', 'IndexController@Show')->name('index');
Route::resource('novosti', 'NewsController');

Route::group(['middleware' => 'auth'], function (){
    Route::group(['middleware' => 'user'], function (){
        Route::resource('usernew', 'NewsController',['only' => [
            'create','store','index','show','edit'
        ]]);
    });

    Route::group(['middleware' => 'role', 'prefix' => 'admin'], function (){
        Route::get('/', 'AdminController@Show')->name('admin');
        Route::resource('category', 'CategoriesController');
        Route::resource('users', 'UserController');
        Route::resource('news', 'NewsController');
    });
});
