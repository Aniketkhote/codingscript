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

Route::group(['namespace' => 'User'], function () {
    Route::get('/', 'Blog\HomeController@index');
    Route::get('blog', 'Blog\PostController@index');
    Route::get('blog/{post}', 'Blog\SinglePostController@post')->name('post');
    Route::get('blog/tag/{tag}', 'Blog\PostController@tag')->name('tag');
    Route::get('blog/category/{category}', 'Blog\PostController@category')->name('category');

    Route::get('course', 'Course\HomeController@index');
    Route::get('course/{course}', 'Course\HomeController@detail');

});


Route::group(['namespace' => 'Admin' , 'middleware' => 'auth:admin'], function(){
    Route::get('admin/dashboard','DashboardController@index');
    
    // Blog Posts Routes
    Route::resource('admin/post', 'Blog\PostController');
    Route::post('admin/post/image_upload', 'Blog\PostController@upload')->name('upload');
    
    // Blog Tag Routes
    Route::resource('admin/tag', 'Blog\TagController');
    
    // Blog Category Routes
    Route::resource('admin/category', 'Blog\CategoryController');

    // Blog Comment Routes
    Route::resource('admin/comment', 'Blog\CommentController');
    Route::get('admin/comment/{id}/{status}', 'Blog\CommentController@status')->name('comment.status');

    // Course Routes
    Route::resource('admin/course', 'course\CourseController');

    // Course Category Routes
    Route::resource('admin/course-category', 'course\CourseCategoryController');

    // User Routes
    Route::resource('admin/user', 'Blog\UserController');

    // Role Routes
    Route::resource('admin/role', 'Blog\RoleController');

    // Permission Routes
    Route::resource('admin/permission', 'Blog\permissionController');

});

 // Admin Auth
 Route::get('admin/login', 'Admin\Auth\LoginController@showAdminLoginForm')->name('admin.login');
 Route::post('admin/login', 'Admin\Auth\LoginController@adminLogin');


Auth::routes();
