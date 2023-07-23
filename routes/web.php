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
    Route::controller(MessagesController::class)->group(function () {
        Route::post('/sendMessage','index');
        Route::get('/listChat','getChat');
        Route::get('/listChatAdmin/{id}','getChatAdmin');
        Route::post('/sendMessageAdmin','sendMessageAdmin');
    });
    Route::controller(HomeController::class)->group(function () {
        Route::get('/','index')->name('home');
        Route::get('/chatbox','chatbox');
    });
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login','showLoginForm')->name('login');
        Route::post('/login','login')->name('login');
        Route::get('/logout', 'logout')->name('logout');

        Route::get('/register', 'showRegistrationForm')->name('register');
        Route::post('/register', 'register');
    });
    Route::controller(UserInfoController::class)->group(function () {
        Route::get('/thong-tin-ca-nhan','create')->name('updateInfo');
        Route::post('/thong-tin-ca-nhan','createPost')->name('updateInfoPost');

    });

    Route::controller(PageController::class)->group(function () {
        Route::get('/thong-tin-box','boxInfo')->name('boxInfo');
        Route::get('/danh-sach-box','boxList')->name('boxList');
        Route::get('/thong-tin-du-lieu-box','treeData')->name('treeData');
        Route::get('/gio-hang','cart')->name('cart');
        Route::get('/thanh-toan','chekout')->name('chekout');
        Route::get('/purchase-order','purchaseOrder')->name('purchaseOrder');
        Route::get('/market','market')->name('market');
        Route::get('/resell','resell')->name('resell');
        Route::get('/nap-tien-vao-vi','infoCardPay')->name('infoCardPay');
        Route::get('/vi-cua-ban','walet')->name('walet');
        Route::get('/them-tai-khoan-ngan-hang','createCard')->name('createCard');
        Route::get('/yeu-cau-rut-tien','cashOut')->name('cashOut');
        Route::get('/lich-su-giao-dich','historyTransaction')->name('historyTransaction');
        Route::get('/chi-tiet-san-pham','productDetails')->name('productDetails');
        Route::get('/trang-thai-don-hang','statusOrder')->name('statusOrder');
    });

});
Route::group(['prefix' => 'admin', 'middleware'=>['CheckAdmin']], function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/','index')->name('admin');
    });
    Route::group(['prefix' => 'chat', 'as' =>'chat.'], function () {
        Route::controller(MessagesController::class)->group(function () {
            Route::get('/','indexAdmin')->name('index');
            Route::get('/getUser','getUser');
            Route::put('/updateRead','updateReadMessage');
            Route::get('/getUserSearch','searchUser');
        });
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
    Route::group(['prefix' => 'box', 'as' =>'box.'], function () {
        Route::controller(BoxController::class)->group(function () {
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

            // hiển thị thông tin của box và số sản phẩm mà đã thêm vào box
            Route::get('/show/{id}', 'show')->name('show');
        });
        Route::group(['prefix' => 'box_product', 'as' =>'box_product.'], function () {
            Route::controller(BoxProductController::class)->group(function () {
                // thêm
                Route::get('/add/{id_box}', 'create')->name('add');
                Route::post('/add/{id_box}', 'store')->name('addPost');

                //sửa
                Route::get('edit/{id}','edit')->name('edit');
                Route::post('edit/{id}','update')->name('editPost');

                // đổi trạng thái
                Route::get('change_status/{id}','changeStatus')->name('changeStatus');

                // xóa
                Route::get('/delete/{id}', 'destroy')->name('delete');

                // hiển thị tất cả
                // Route::get('/show/{id}', 'show')->name('show');
            });
        });
        Route::group(['prefix' => 'box_event', 'as' =>'box_event.'], function () {
            Route::controller(BoxEventController::class)->group(function () {
                // danh sách
                Route::get('/','list')->name('index');

                //update status
                Route::post('change_status/{id}','changeStatus')->name('changeStatus');

                // thêm
                Route::get('/add', 'create')->name('add');
                Route::post('/add', 'createPost')->name('addPost');


                // chức năng tạo mới 1 event từ event đã được tạo trước đó trong form chỉ cần thây đổi thời gian bắt đầu và kết thúc
                // nhớ clone mới tất cả box_items của nó lun nha.
                // chức năng này để qua ngày 23 rồi hẳn làm nha.
                Route::get('/add-new-event-by-event/{id}', 'newEventByEvent')->name('newEventByEvent');
                Route::post('/add-new-event-by-event/{id}', 'newEventByEventPost')->name('newEventByEvent');

                //sửa
                Route::get('edit/{id}','edit')->name('edit');
                Route::post('edit/{id}','update')->name('editPost');
                // xóa
                Route::get('/delete/{id}', 'destroy')->name('delete');

                // hiển thị tất cả hiển thị thông tin và danh sách các box được thêm vào event này. Chức năng này đợi cho box và box_products xong thì làm hoặc tạ trước data để code nha
                Route::get('/show/{id}', 'show')->name('show');
            });
            Route::group(['prefix' => 'box_item', 'as' =>'box_item.'], function () {
                Route::controller(BoxItemController::class)->group(function () {

                    // thêm
                    // id_box thì làm select option search nha
                    Route::get('/add/{id_box_event}', 'create')->name('add');
                    Route::post('/add/{id_box_event}', 'createPost')->name('addPost');

                    //sửa
                    Route::get('edit/{id}','edit')->name('edit');
                    Route::post('edit/{id}','update')->name('editPost');
                    // xóa
                    Route::get('/delete/{id}', 'destroy')->name('delete');

                    // hiển thị tất cả
                    Route::get('/show/{id}', 'show')->name('show');

                    Route::post('change_status/{id}','changeStatus')->name('changeStatus');
                });
            });

        });
    });

    Route::group(['prefix' => 'card', 'as' =>'card.'], function () {
        Route::controller(CardController::class)->group(function () {
            // danh sách
            Route::get('/','index')->name('index');
            Route::get('/admin','indexAdmin')->name('indexAdmin');

            // thêm
            Route::get('/add', 'create')->name('add');
            Route::post('/add', 'store')->name('addPost');
            Route::get('/addAdmin', 'createAdmin')->name('addAdmin');
            Route::post('/addAdmin', 'storeAdmin')->name('addPostAdmin');

            //sửa
            Route::get('edit/{id}','edit')->name('edit');
            Route::post('edit/{id}','update')->name('editPost');
            Route::get('editAdmin/{id}','editAdmin')->name('editAdmin');
            Route::post('editAdmin/{id}','updateAdmin')->name('editPostAdmin');
            // xóa
            Route::get('/delete/{id}', 'destroy')->name('delete');
            Route::get('/deleteAdmin/{id}', 'destroyAdmin')->name('deleteAdmin');

            // hiển thị tất cả
            Route::get('/show/{id}', 'show')->name('show');
        });
    });
});

