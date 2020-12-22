<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\user\UserController;

#region Admin

#region Login
Route::group(['prefix' => 'admin'], function () {
    Route::get('login', [AdminController::class, 'login'])->name('login');
    Route::post('login', [AdminController::class, 'submit_login']);
    Route::get('logout', [AdminController::class, 'logout'])->name('logout');
});
#endregion

// Dashboard
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

#region Resource Category, Post
Route::group(['middleware' => 'CheckAdminLogin'], function () {
    Route::resource('admin/category', CategoryController::class);
    Route::resource('admin/post', PostController::class);
});

#endregion

//Xem bài đã xóa
Route::get('admin/posts/viewRestore', [
    'middleware' => 'CheckAdminLogin',
    PostController::class, 'viewRestore'
])->name('post.viewRestore');

#region Post Delete - View Restore - Restore - Create Description - Post Review - Update Description
Route::group(['prefix' => 'admin/post', 'middleware' => 'CheckAdminLogin'], function () {

    Route::get('{id}/delete', [PostController::class, 'delete']);
    // Khôi phục bài viết đã xóa lỗi ở cái này

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

#region Member
Route::group(['prefix' => 'admin/member', 'middleware' => 'CheckAdminLogin'], function () {
    Route::get('index', [AdminController::class, 'viewMember'])->name('admin.member.index');
    Route::get('deleteMember/{id}', [AdminController::class, 'deleteMember'])->name('admin.member.deleteMember');
    Route::get('viewDeleteMember', [AdminController::class, 'viewDeleteMember'])->name('admin.member.viewDeleteMember');
    Route::get('restoreMember/{id}', [AdminController::class, 'restoreMember'])->name('admin.member.restoreMember');
});
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

#region Resource User

// User homePage
Route::group(['prefix' => 'user', 'middleware' => 'CheckUserLogin'], function () {
    Route::get('/home', [UserController::class, 'homePage'])->name('user.homePage');
});

Route::get('/', [UserController::class, 'homePageGuest'])->name('user.homePageGuest');
Route::get('user/postWithCategory/{id}', [UserController::class, 'postWithCategory']);
Route::resource('user', UserController::class);
#endregion
