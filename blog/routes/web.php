<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\PostController;
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
    Route::get('/rediect', function ($id) {

    });
});
#endregion
