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

Route::get('/', function(){
    return redirect()->route('admin.dashboard');
});

//Admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin'], 'namespace' => 'App\Http\Controllers\Admin'], function ($route) {
    $route->get('/', 'DashboardController@index')->name('admin.dashboard');

    //Student
    $route->group(['prefix' => 'student', 'namespace' => 'Student'], function($route){
        $route->get('/','StudentController@index')->name('admin.student.index');
        $route->post('/','StudentController@store')->name('admin.student.store');
        $route->put('/','StudentController@update')->name('admin.student.update');
        $route->delete('/','StudentController@delete')->name('admin.student.delete');
    });

    //Teacher
    $route->group(['prefix' => 'teacher', 'namespace' => 'Teacher'], function($route){
        $route->get('/','TeacherController@index')->name('admin.teacher.index');
        $route->post('/','TeacherController@store')->name('admin.teacher.store');
        $route->put('/','TeacherController@update')->name('admin.teacher.update');
        $route->delete('/','TeacherController@delete')->name('admin.teacher.delete');
    });

    //Teacher
    $route->group(['prefix' => 'class', 'namespace' => 'StudentClass'], function($route){
        $route->get('/','ClassController@index')->name('admin.class.index');
        $route->post('/','ClassController@store')->name('admin.class.store');
        $route->put('/','ClassController@update')->name('admin.class.update');
        $route->delete('/','ClassController@delete')->name('admin.class.delete');
    });

    //Course
    $route->group(['prefix' => 'course', 'namespace' => 'Course'], function($route){
        $route->get('/','CourseController@index')->name('admin.course.index');
        $route->post('/','CourseController@store')->name('admin.course.store');
        $route->put('/','CourseController@update')->name('admin.course.update');
        $route->delete('/','CourseController@delete')->name('admin.course.delete');
        //Student
        $route->group(['prefix' => 'student', 'namespace' => 'Student'], function($route){
            $route->get('/','StudentController@index')->name('admin.course.student.index');
            $route->post('/','StudentController@store')->name('admin.course.student.store');
            $route->put('/','StudentController@update')->name('admin.course.student.update');
            $route->delete('/','StudentController@delete')->name('admin.course.student.delete');
        });
    });
});

//Teacher
Route::group(['prefix' => 'teacher', 'middleware' => ['auth', 'role:teacher'], 'namespace' => 'App\Http\Controllers\Teacher'], function ($route) {
    $route->get('/', 'DashboardController@index')->name('teacher.dashboard');

    //Student
    $route->group(['prefix' => 'student', 'namespace' => 'Student'], function($route){
        $route->get('/','StudentController@index')->name('teacher.student.index');
        $route->post('/','StudentController@store')->name('teacher.student.store');
        $route->put('/','StudentController@update')->name('teacher.student.update');
        $route->delete('/','StudentController@delete')->name('teacher.student.delete');
    });

    //Class
    $route->group(['prefix' => 'class', 'namespace' => 'StudentClass'], function($route){
        $route->get('/','ClassController@index')->name('teacher.class.index');
        $route->post('/','ClassController@store')->name('teacher.class.store');
        $route->put('/','ClassController@update')->name('teacher.class.update');
        $route->delete('/','ClassController@delete')->name('teacher.class.delete');
    });
});

Route::group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers\Auth'], function ($route) {
    $route->get('login', 'AuthController@login')->name('login');
    $route->post('login', 'AuthController@doLogin')->name('auth.do_login');
    $route->post('logout', 'AuthController@logout')->name('logout');

    $route->get('register', 'AuthController@register')->name('register');
    $route->post('register', 'AuthController@doRegister')->name('auth.do_register');
});

Route::group(['prefix' => '/', 'namespace' => 'App\Http\Controllers\Users'], function ($route) {

    $route->group(['prefix' => 'users'], function ($route) {
        $route->get('/', 'UserController@login')->name('user');
    });
});


/**
 * CKEDITOR
 */
Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');

Route::any('/ckfinder/examples/{example?}', '\CKSource\CKFinderBridge\Controller\CKFinderController@examplesAction')
    ->name('ckfinder_examples');
