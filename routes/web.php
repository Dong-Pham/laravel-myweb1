<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\Brandcontroller;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

// Client controllers
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController as ClientProductController;


use App\Http\Controllers\DemoController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// })->name('admin.home');

Route::get('/test1', [ProductController::class, 'test1']);
Route::get('/test2', [ProductController::class, 'test2']);

Route::get('/demo', [DemoController::class, 'index']);
Route::get('/demo2', [DemoController::class, 'index2']);
Route::get('/demo3', [DemoController::class, 'index3']);
Route::get('/demo4/{id}', [DemoController::class, 'index4']);
Route::get('/demo5/{id?}', [DemoController::class, 'index5']);
Route::get('/demo6/{param1}/{param2}', [DemoController::class, 'index6']);

Route::prefix('admin')->name('admin.')->group(function () {
    // Các route cần xác thực (chỉ cho phép người dùng đã đăng nhập truy cập)
    Route::middleware('auth')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');
        // Authentication
        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('logout');
        Route::get('/change-password', [AuthController::class, 'changePassword'])
            ->name('change-password');
        Route::post('/change-password', [AuthController::class, 'postChangePassword'])
            ->name('change-password.post');
        // CRUD - Resource route
        Route::middleware('roles:1')->group(
            function () {
                // Hiển thị danh sách dữ liệu đã xóa mềm Soft Delete (Thùng rác)
                Route::get('trash/categories', [CategoryController::class, 'trash'])
                    ->name('categories.trash');

                // Khôi phục
                Route::patch('categories/{id}/restore', [CategoryController::class, 'restore'])
                    ->name('categories.restore');
                // Khôi phục tất cả
                Route::patch('categories/restoreall/all', [CategoryController::class, 'restoreAll'])
                    ->name('categories.restoreAll');
                // Xóa vĩnh viễn
                Route::delete('categories/{id}/forcedelete', [CategoryController::class, 'forceDelete'])
                    ->name('categories.forceDelete');
                // Xóa vĩnh viễn tất cả
                Route::delete('categories/forcedeleteall/all', [CategoryController::class, 'forceDeleteAll'])
                    ->name('categories.forceDeleteAll');

                // Hiển thị danh sách dữ liệu đã xóa mềm Soft Delete (Thùng rác)
                Route::get('trash/brands', [BrandController::class, 'trash'])
                    ->name('brands.trash');

                // Khôi phục
                Route::patch('brands/{id}/restore', [BrandController::class, 'restore'])
                    ->name('brands.restore');
                // Khôi phục tất cả
                Route::patch('brands/restoreall/all', [BrandController::class, 'restoreAll'])
                    ->name('brands.restoreAll');
                // Xóa vĩnh viễn
                Route::delete('brands/{id}/forcedelete', [BrandController::class, 'forceDelete'])
                    ->name('brands.forceDelete');
                // Xóa vĩnh viễn tất cả
                Route::delete('brands/forcedeleteall/all', [BrandController::class, 'forceDeleteAll'])
                    ->name('brands.forceDeleteAll');

                // Hiển thị danh sách dữ liệu đã xóa mềm Soft Delete (Thùng rác)
                Route::get('trash/products', [ProductController::class, 'trash'])
                    ->name('products.trash');

                // Khôi phục
                Route::patch('products/{id}/restore', [ProductController::class, 'restore'])
                    ->name('products.restore');
                // Khôi phục tất cả
                Route::patch('products/restoreall/all', [ProductController::class, 'restoreAll'])
                    ->name('products.restoreAll');
                // Xóa vĩnh viễn
                Route::delete('products/{id}/forcedelete', [ProductController::class, 'forceDelete'])
                    ->name('products.forceDelete');
                // Xóa vĩnh viễn tất cả
                Route::delete('products/forcedeleteall/all', [ProductController::class, 'forceDeleteAll'])
                    ->name('products.forceDeleteAll');

                // Hiển thị danh sách dữ liệu đã xóa mềm Soft Delete (Thùng rác)
                Route::get('trash/posts', [PostController::class, 'trash'])
                    ->name('posts.trash');

                // Khôi phục
                Route::patch('posts/{id}/restore', [PostController::class, 'restore'])
                    ->name('posts.restore');
                // Khôi phục tất cả
                Route::patch('posts/restoreall/all', [PostController::class, 'restoreAll'])
                    ->name('posts.restoreAll');
                // Xóa vĩnh viễn
                Route::delete('posts/{id}/forcedelete', [PostController::class, 'forceDelete'])
                    ->name('posts.forceDelete');
                // Xóa vĩnh viễn tất cả
                Route::delete('posts/forcedeleteall/all', [PostController::class, 'forceDeleteAll'])
                    ->name('posts.forceDeleteAll');

                // Hiển thị danh sách dữ liệu đã xóa mềm Soft Delete (Thùng rác)
                Route::get('trash/users', [UserController::class, 'trash'])
                    ->name('users.trash');

                // Khôi phục
                Route::patch('users/{id}/restore', [UserController::class, 'restore'])
                    ->name('users.restore');
                // Khôi phục tất cả
                Route::patch('users/restoreall/all', [UserController::class, 'restoreAll'])
                    ->name('users.restoreAll');
                // Xóa vĩnh viễn
                Route::delete('users/{id}/forcedelete', [UserController::class, 'forceDelete'])
                    ->name('users.forceDelete');
                // Xóa vĩnh viễn tất cả
                Route::delete('users/forcedeleteall/all', [UserController::class, 'forceDeleteAll'])
                    ->name('users.forceDeleteAll');


                Route::resource('categories', CategoryController::class);
                Route::resource('brands', BrandController::class);
                Route::resource('users', UserController::class);
                Route::delete('products/{product}/images/{image}', [ProductController::class, 'deleteImage']);
                Route::resource('products', ProductController::class);
                Route::resource('posts', PostController::class);
            }
        );
        Route::resource('products', ProductController::class)
            ->only(['index'])->middleware('roles:1,2');
    });
    // Authentication
    Route::get('/login', [AuthController::class, 'login'])
        ->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])
        ->name('login.post');
    Route::get('/forgotpass', [AuthController::class, 'forgotPassword'])
        ->name('forgotpass');
    Route::post('/forgotpass', [AuthController::class, 'postforgotPassword'])
        ->name('forgotpass.post');
});


// Client routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{slug}', [ClientProductController::class, 'show'])->name('products.show');
Route::get('/category/{slug}', [ClientProductController::class, 'category'])->name('products.category');
Route::get('/brand/{slug}', [ClientProductController::class, 'brand'])->name('products.brand');
Route::get('/search', [ClientProductController::class, 'search'])->name('products.search');
