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

Route::get('/', function () {
    return view('admin.user.add');
});

// Route::get('/login', 'LoginController')->name('login');
// Route::post('/login', 'LoginController')->name('login');
// Route::get('/register', 'LoginController')->name('register');
// Route::post('/register', 'LoginController')->name('register')

// trang chủ ở đây
Route::group(['prefix' => '/',  'middleware' => ''], function () {


});
Route::group(['prefix' => 'admin'], function () {
    // Route::get('/login', 'AdminController')->name('AdminController.login');
    Route::group(['prefix' => 'user', 'as' =>'user.'], function () {
        Route::controller(UserController::class)->group(function () {
            // danh sách
            Route::get('/','index')->name('index');

            // thêm
            Route::get('/add', 'create')->name('add');
            Route::post('/add', 'store')->name('addPost');

            //sửa
            Route::get('edit/{id}','edit')->name('edit');
            Route::post('edit/{id}','update')->name('editPost');
            // xóa
            Route::get('/delete/{id}', 'destroy')->name('Delete');

            // hiển thị tất cả
            Route::get('/show/{id}', 'show')->name('show');
        });
    });
});

