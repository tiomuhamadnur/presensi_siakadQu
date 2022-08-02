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
    return redirect()->route('admin.dashboard');
});

//Admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin'], 'namespace' => 'App\Http\Controllers\Admin'], function ($route) {
    $route->get('/', 'DashboardController@index')->name('admin.dashboard');

    //Student
    $route->group(['prefix' => 'student', 'namespace' => 'Student'], function ($route) {
        $route->get('/', 'StudentController@index')->name('admin.student.index');
        $route->post('/', 'StudentController@store')->name('admin.student.store');
        $route->put('/', 'StudentController@update')->name('admin.student.update');
        $route->delete('/', 'StudentController@delete')->name('admin.student.delete');
    });

    //Teacher
    $route->group(['prefix' => 'teacher', 'namespace' => 'Teacher'], function ($route) {
        $route->get('/', 'TeacherController@index')->name('admin.teacher.index');
        $route->post('/', 'TeacherController@store')->name('admin.teacher.store');
        $route->put('/', 'TeacherController@update')->name('admin.teacher.update');
        $route->delete('/', 'TeacherController@delete')->name('admin.teacher.delete');
    });

    //Teacher
    $route->group(['prefix' => 'class', 'namespace' => 'StudentClass'], function ($route) {
        $route->get('/', 'ClassController@index')->name('admin.class.index');
        $route->post('/', 'ClassController@store')->name('admin.class.store');
        $route->put('/', 'ClassController@update')->name('admin.class.update');
        $route->delete('/', 'ClassController@delete')->name('admin.class.delete');
    });

    //Course
    $route->group(['prefix' => 'course', 'namespace' => 'Course'], function ($route) {
        $route->get('/', 'CourseController@index')->name('admin.course.index');
        $route->post('/', 'CourseController@store')->name('admin.course.store');
        $route->put('/', 'CourseController@update')->name('admin.course.update');
        $route->delete('/', 'CourseController@delete')->name('admin.course.delete');

        //Student
        $route->group(['prefix' => 'student', 'namespace' => 'Student'], function ($route) {
            $route->get('/', 'StudentController@index')->name('admin.course.student.index');
            $route->post('/', 'StudentController@store')->name('admin.course.student.store');
            $route->put('/', 'StudentController@update')->name('admin.course.student.update');
            $route->delete('/', 'StudentController@delete')->name('admin.course.student.delete');
            $route->post('sync', 'StudentController@syncStudentClass')->name('admin.course.student.sync');

            //PRESENT
            $route->post('present', 'StudentPresentController@present')->name('admin.course.student.present');
            $route->put('present', 'StudentPresentController@presentUpdate')->name('admin.course.student.present.update');
            // $route->post('unpresent', 'StudentPresentController@unPresent')->name('admin.course.student.unpresent');
            // $route->put('unpresent', 'StudentPresentController@unPresentUpdate')->name('admin.course.student.unpresent.update');
            
        });
    });

    //Present
    $route->group(['prefix' => 'present', 'namespace' => 'Present'], function ($route) {
        $route->get('/', 'PresentController@index')->name('admin.present.index');
        $route->post('/', 'PresentController@store')->name('admin.present.store');
        $route->put('/', 'PresentController@update')->name('admin.present.update');
        $route->delete('/', 'PresentController@delete')->name('admin.present.delete');

        //Student
        $route->group(['prefix' => 'present_by_class', 'namespace' => 'Student'], function ($route) {
            $route->get('/', 'PresentByClassController@index')->name('admin.present.by_class.index');
            $route->post('/', 'PresentByClassController@store')->name('admin.present.by_class.store');
            $route->post('present', 'PresentByClassController@doPresent')->name('admin.present.by_class.do_present');
            $route->put('/', 'PresentByClassController@update')->name('admin.present.by_class.update');
            $route->delete('/', 'PresentByClassController@delete')->name('admin.present.by_class.delete');
            $route->put('present', 'PresentByClassController@updatePresent')->name('admin.present.by_class.update_present');
        });

        //Present History
        $route->group(['prefix' => 'present-history', 'namespace' => 'Student'], function ($route) {
            $route->get('/', 'PresentHistoryController@index')->name('admin.present.history.index');
            $route->post('/', 'PresentHistoryController@store')->name('admin.present.history.store');
            $route->post('present', 'PresentHistoryController@doPresent')->name('admin.present.history.do_present');
            $route->put('/', 'PresentHistoryController@update')->name('admin.present.history.update');
            $route->delete('/', 'PresentHistoryController@delete')->name('admin.present.history.delete');
            $route->put('present', 'PresentHistoryController@updatePresent')->name('admin.present.history.update_present');
        });
    });
});

//Teacher
Route::group(['prefix' => 'teacher', 'middleware' => ['auth', 'role:guru'], 'namespace' => 'App\Http\Controllers\Teacher'], function ($route) {
    $route->get('/', 'DashboardController@index')->name('teacher.dashboard');

    //Teacher
    $route->group(['prefix' => 'class', 'namespace' => 'StudentClass'], function ($route) {
        $route->get('/', 'ClassController@index')->name('teacher.class.index');
        $route->post('/', 'ClassController@store')->name('teacher.class.store');
        $route->put('/', 'ClassController@update')->name('teacher.class.update');
        $route->delete('/', 'ClassController@delete')->name('teacher.class.delete');
    });

     //Student
     $route->group(['prefix' => 'student', 'namespace' => 'Student'], function ($route) {
        $route->get('/', 'StudentController@index')->name('teacher.student.index');
        $route->post('/', 'StudentController@store')->name('teacher.student.store');
        $route->put('/', 'StudentController@update')->name('teacher.student.update');
        $route->delete('/', 'StudentController@delete')->name('teacher.student.delete');
    });

    //Course
    $route->group(['prefix' => 'course', 'namespace' => 'Course'], function ($route) {
        $route->get('/', 'CourseController@index')->name('teacher.course.index');
        $route->post('/', 'CourseController@store')->name('teacher.course.store');
        $route->put('/', 'CourseController@update')->name('teacher.course.update');
        $route->delete('/', 'CourseController@delete')->name('teacher.course.delete');

        //Student
        $route->group(['prefix' => 'student', 'namespace' => 'Student'], function ($route) {
            $route->get('/', 'StudentController@index')->name('teacher.course.student.index');
            $route->post('/', 'StudentController@store')->name('teacher.course.student.store');
            $route->put('/', 'StudentController@update')->name('teacher.course.student.update');
            $route->delete('/', 'StudentController@delete')->name('teacher.course.student.delete');

            //PRESENT
            $route->post('present', 'StudentPresentController@present')->name('teacher.course.student.present');
            $route->put('present', 'StudentPresentController@presentUpdate')->name('teacher.course.student.present.update');
            // $route->post('unpresent', 'StudentPresentController@unPresent')->name('teacher.course.student.unpresent');
            // $route->put('unpresent', 'StudentPresentController@unPresentUpdate')->name('teacher.course.student.unpresent.update');
            
        });
    });

    //Present
    $route->group(['prefix' => 'present', 'namespace' => 'Present'], function ($route) {
        $route->get('/', 'PresentController@index')->name('teacher.present.index');
        $route->post('/', 'PresentController@store')->name('teacher.present.store');
        $route->put('/', 'PresentController@update')->name('teacher.present.update');
        $route->delete('/', 'PresentController@delete')->name('teacher.present.delete');

        //Student
        $route->group(['prefix' => 'present_by_class', 'namespace' => 'Student'], function ($route) {
            $route->get('/', 'PresentByClassController@index')->name('teacher.present.by_class.index');
            $route->post('/', 'PresentByClassController@store')->name('teacher.present.by_class.store');
            $route->post('present', 'PresentByClassController@doPresent')->name('teacher.present.by_class.do_present');
            $route->put('/', 'PresentByClassController@update')->name('teacher.present.by_class.update');
            $route->delete('/', 'PresentByClassController@delete')->name('teacher.present.by_class.delete');
            $route->put('present', 'PresentByClassController@updatePresent')->name('teacher.present.by_class.update_present');
        });

        //Present History
        $route->group(['prefix' => 'present-history', 'namespace' => 'Student'], function ($route) {
            $route->get('/', 'PresentHistoryController@index')->name('teacher.present.history.index');
            $route->post('/', 'PresentHistoryController@store')->name('teacher.present.history.store');
            $route->post('present', 'PresentHistoryController@doPresent')->name('teacher.present.history.do_present');
            $route->put('/', 'PresentHistoryController@update')->name('teacher.present.history.update');
            $route->delete('/', 'PresentHistoryController@delete')->name('teacher.present.history.delete');
            $route->put('present', 'PresentHistoryController@updatePresent')->name('teacher.present.history.update_present');
        });
    });
});


Route::group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers\Auth'], function ($route) {
    $route->get('login', 'AuthController@login')->name('login');
    $route->post('login', 'AuthController@doLogin')->name('auth.do_login');
    $route->post('logout', 'AuthController@logout')->name('logout');

    $route->get('register', 'AuthController@register')->name('register');
    $route->post('register', 'AuthController@doRegister')->name('auth.do_register');
});

// Route::group(['prefix' => '/', 'namespace' => 'App\Http\Controllers\Users'], function ($route) {

//     $route->group(['prefix' => 'users'], function ($route) {
//         $route->get('/', 'UserController@login')->name('user');
//     });
// });


/**
 * CKEDITOR
 */
Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');

Route::any('/ckfinder/examples/{example?}', '\CKSource\CKFinderBridge\Controller\CKFinderController@examplesAction')
    ->name('ckfinder_examples');
