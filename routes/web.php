<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\user\UserController;
use App\Models\Post;

#region Default
Route::get('/', [HomeController::class, 'home']);
#endregion

#region Admin

#region Login
Route::group(['prefix' => 'admin'], function () {
    Route::get('login', [AdminController::class, 'login'])->name('login');
    Route::post('login', [AdminController::class, 'submit_login']);
    Route::get('logout', [AdminController::class, 'logout'])->name('logout');
});
#endregion

Route::group(['prefix' => 'admin', 'middleware' => 'CheckAdminLogin'], function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

#region Category Delete - View Restore - Restore
Route::group(['prefix' => 'admin/category', 'middleware' => 'CheckAdminLogin'], function () {
    Route::get('{id}/delete', [CategoryController::class, 'destroy']);

    Route::get('viewRestore', [
        CategoryController::class,
        'viewRestore'
    ])->name('category.viewRestore');

    Route::get('{id}/restore', [
        CategoryController::class,
        'restore'
    ])->name('category.restore');
});
#endregion

#region Resource Category
// Route::group(['middleware' => 'CheckAdminLogin'], function () {
Route::resource('admin/category', CategoryController::class);
// });

#endregion


#region Post Delete - View Restore - Restore - Create Description - Post Review - Update Description
Route::group(['prefix' => 'admin/post', 'middleware' => 'CheckAdminLogin'], function () {
    // Khôi phục bài viết đã xóa
    Route::get('{id}/delete', [PostController::class, 'delete']);

    Route::get('viewRestore', [
        PostController::class,
        'viewRestore'
    ])->name('post.viewRestore');

    Route::get('{id}/restore', [
        PostController::class,
        'restore'
    ])->name('post.restore');

    // form tạo nội dung bài viết
    Route::get('createPostContent/{id}', [
        PostController::class,
        'createPostContent'
    ])->name('post.createPostContent');
    // Lưu nội dung bài viết
    Route::post('savePostContent', [
        PostController::class,
        'savePostContent'
    ])->name('post.saveContent');
    // review nội dung bài viết
    Route::get('postDescription/{id}', [
        PostController::class,
        'viewPostDescription'
    ])->name('post.viewPostDescription');

    // Sửa nội dung bài viết
    Route::get('editDescription/{id}', [
        PostController::class,
        'editPostDescription'
    ])->name('post.editPostDescription');

    // Update nội dung vào DB
    Route::post('updateDescription', [
        PostController::class,
        'updatePostDescription'
    ])->name('post.updatePostDescription');
});
#endregion

#region Resource Post
Route::resource('admin/post', PostController::class);
#endregion

#endregion

#region Guest
Route::group(['prefix' => 'user'], function () {
    // Đăng nhập user

    Route::get('login', [UserController::class, 'login'])->name('user.getLogin');
    Route::post('login', [UserController::class, 'submitLogin'])->name('user.postLogin');
    // Đăung ký user
    Route::get('signup', [UserController::class, 'signUp'])->name('user.getSignUp');
    Route::post('signup', [UserController::class, 'submitSignUp'])->name('user.postSignUp');

    Route::get('logout', [UserController::class, 'logout'])->name('user.logout');
});

Route::group(['prefix' => 'user', 'middleware' => 'CheckUserLogin'], function () {
    Route::get('/home', [UserController::class, 'homePage'])->name('user.homePage');
});

#endregion

#region User
Route::get('user/postWithCategory/{id}', [UserController::class, 'postWithCategory']);
Route::resource('user', UserController::class);
#endregion

Route::get('/login-facebook', [UserController::class, 'login_facebook']);
Route::get('/admin/callback', [UserController::class, 'callback_facebook']);
