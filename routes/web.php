<?php

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
    return view('welcome');
});

Route::group(['middleware' => 'login'], function () {
    Route::get('/login', 'AuthController@loginForm')->name('login');
    Route::post('/login', 'AuthController@login');
});

Route::get('/logout', 'AuthController@logout');

Route::group(['middleware' => 'super'], function () {
    Route::get("admins/super/{super}/edit", 'EditUserController@super_edit');
    Route::patch("admins/super/{super}", 'EditUserController@super_update');

    Route::resource("admins/super/department", "DepartmentController");
    Route::resource("admins/super/admin", "AdminController");
    Route::resource("admins/super/program", "ProgramController");

    Route::get("admins/super/result", 'ResultController@superCourses');
    Route::get("admins/super/result/filtered", 'ResultController@superFilteredCourses');
    Route::get("admins/super/result/{offered_course}", 'ResultController@superStudents');

    Route::get("admins/super/result/status/{offered_course}", 'OfferedCourseController@changeStatus');
    Route::get("admins/super/result/filtered/status/{offered_course}", 'OfferedCourseController@changeStatus');
});

Route::group(['middleware' => 'admin'], function () {
    Route::get("admins/admin/{admin}/edit", 'EditUserController@admin_edit');
    Route::patch("admins/admin/{admin}", 'EditUserController@admin_update');


    Route::resource("admins/admin/teacher", "TeacherController");
    Route::resource("admins/admin/all-course", "AllCourseController");
    Route::resource("admins/admin/offered-course", "OfferedCourseController");

    Route::resource("admins/admin/student", "StudentController");

    Route::get("admins/admin/result", 'ResultController@adminCourses');
    Route::get("admins/admin/result/filtered", 'ResultController@adminFilteredCourses');
    Route::get("admins/admin/result/{offered_course}", 'ResultController@adminStudents');
});

Route::group(['middleware' => 'teacher'], function () {
    Route::get("admins/teacher/{teacher}/edit", 'EditUserController@teacher_edit');
    Route::patch("admins/teacher/{teacher}", 'EditUserController@teacher_update');

    Route::get("admins/teacher/my-course", 'MyCourseController@index');
    Route::get("admins/teacher/my-course/{offered_course}/edit", 'MyCourseController@edit');
    Route::patch("admins/teacher/my-course/{offered_course}", 'MyCourseController@update');
    Route::get("admins/teacher/my-course-lab/{offered_course}/edit", 'MyCourseController@lab_edit');
    Route::patch("admins/teacher/my-course-lab/{offered_course}", 'MyCourseController@lab_update');

    Route::get("admins/teacher/my-course/{offered_course}/refresh", 'MyCourseController@refresh');
    Route::get("admins/teacher/my-course-lab/{offered_course}/refresh", 'MyCourseController@lab_refresh');

    Route::get("admins/teacher/my-course/course/{offered_course}", 'CourseController@index');

    Route::post("admins/teacher/my-course/course/{offered_course}", 'CourseController@excel_import');

    Route::get("admins/teacher/my-course/course/{offered_course}/create", 'CourseController@create');
    Route::post("admins/teacher/my-course/course", 'CourseController@store');
    Route::get("admins/teacher/my-course/course/{result}/edit", 'CourseController@edit');
    Route::patch("admins/teacher/my-course/course/{result}", 'CourseController@update');
    Route::delete("admins/teacher/my-course/course/{result}", 'CourseController@destroy');

    Route::get("admins/teacher/offered-course/status/{offered_course}", 'OfferedCourseController@finalize');

    Route::get("admins/teacher/my-course/lab_course/{offered_course}", 'LabCourseController@index');

    Route::post("admins/teacher/my-course/lab_course/{offered_course}", 'LabCourseController@excel_import');

    Route::get("admins/teacher/my-course/lab_course/{offered_course}/create", 'LabCourseController@create');
    Route::post("admins/teacher/my-course/lab_course", 'LabCourseController@store');
    Route::get("admins/teacher/my-course/lab_course/{result}/edit", 'LabCourseController@edit');
    Route::patch("admins/teacher/my-course/lab_course/{result}", 'LabCourseController@update');
    Route::delete("admins/teacher/my-course/lab_course/{result}", 'LabCourseController@destroy');


    Route::get("admins/teacher/result", 'ResultController@courses');
    Route::get("admins/teacher/result/{offered_course}", 'ResultController@students');
});


Route::get('/home', 'HomeController@index')->name('home');

