<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

// trang chủ ở đây
Route::group(['prefix' => '/'], function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/','index')->name('home');
    });
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login','showLoginForm')->name('login');
        Route::post('/login','login')->name('login');
        Route::get('/logout', 'logout')->name('logout');

        Route::get('/register', 'showRegistrationForm')->name('register');
        Route::post('/register', 'register');
    });
    Route::controller(UserInfoController::class)->group(function () {
        Route::get('/add','create')->name('add');
        Route::post('/add','createPost')->name('addPost');
        
    });
});
Route::group(['prefix' => 'admin', 'middleware'=>['CheckAdmin']], function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/','index')->name('admin');
    });
    Route::group(['prefix' => 'user', 'as' =>'user.'], function () {
        Route::controller(UserController::class)->group(function () {
            // danh sách
            Route::get('/','index')->name('index');
            Route::get('/list/{type}','list')->name('list');
            // thêm
            Route::get('/add', 'create')->name('add');
            Route::post('/add', 'store')->name('addPost');

            //sửa
            Route::get('edit/{id}','edit')->name('edit');
            Route::post('edit/{id}','update')->name('editPost');
            // xóa
            Route::get('/delete/{id}', 'destroy')->name('delete');

            // hiển thị tất cả
            Route::get('/show/{id}', 'show')->name('show');
        });
    });
    Route::group(['prefix' => 'product', 'as' =>'product.'], function () {
        Route::controller(ProductController::class)->group(function () {
            // danh sách
            Route::get('/','index')->name('index');

            // thêm
            Route::get('/add', 'create')->name('add');
            Route::post('/add', 'store')->name('addPost');

            //sửa
            Route::get('edit/{id}','edit')->name('edit');
            Route::post('edit/{id}','update')->name('editPost');
            // xóa
            Route::get('/delete/{id}', 'destroy')->name('delete');

            // hiển thị tất cả
            Route::get('/show/{id}', 'show')->name('show');
            Route::get('/addImage/{id}', 'addImage')->name('addImage');
            Route::post('/addImagePost', 'addImagePost')->name('addImagePost');

        });
    });

    Route::group(['prefix' => 'category', 'as' =>'category.'], function () {
        Route::controller(CategoryController::class)->group(function () {
            // danh sách
            Route::get('/','index')->name('index');

            // thêm
            Route::get('/add', 'create')->name('add');
            Route::post('/add', 'store')->name('addPost');

            //sửa
            Route::get('edit/{id}','edit')->name('edit');
            Route::post('edit/{id}','update')->name('editPost');
            // xóa
            Route::get('/delete/{id}', 'destroy')->name('delete');

            // hiển thị tất cả
            Route::get('/show/{id}', 'show')->name('show');
        });
    });
});

