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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('Dashboard');
    }
    return view('auth/UserLogin');
});
Route::get('/auth/login', 'UserController@showLoginForm')->name('login');
Route::post('/auth/login',  'UserController@doLogin')->name('doLogin');
Auth::routes();





Route::group(['middleware'=>'admin'], function() {

//    Route::get('/auth/login', 'UserController@showLoginForm')->name('login');
//    Route::post('/auth/login',  'UserController@doLogin')->name('doLogin');


    Route::post('/auth/logout',  'UserController@doLogout')->name('logout');

    Route::post('/auth/dashboard',  'EmployeerController@show')->name('showEmployee');
    Route::get('/auth/dashboard/',  'EmployeerController@showEmployee')->name('Dashboard');

//Route::get('/auth/dashboard/{id}',  'EmployeerController@showEmployeeEdu');


    Route::get('/auth/addEmployee',  'EmployeerController@newEmployee')->name('showAddForm');
    Route::post('/auth/addEmployee',  'EmployeerController@addNewEmployee')->name('newEmp');

    Route::get('/auth/addPhone',  'EmployeerController@newPhoneNumber')->name('newPhone');


    route::get('/auth/editEmployee/{id}', 'EmployeerController@editEmployee')->name('editEmp');
    route::post('/auth/saveUpdated/{id}', 'EmployeerController@saveUpdated')->name('saveUpdated');


    route::get('/auth/employeeInfo/{id}', 'EmployeerController@infoEmployee')->name('infoEmp');


    route::get('/auth/deleteEduForEmp/{id}/{k}', 'EmployeerController@deleteEduForEmp')->name('deleteEduEmp');

    route::get('/auth/deleteEduWrite/{id}', 'EmployeerController@deleteEduWrite')->name('deleteEduWrite');

    route::get('/auth/editEmployeeEducation/{id}', 'EmployeerController@editEmployeeEducation')->name('editEmpEdu');


    Route::get('/auth/deleteEmployee/{id}', 'EmployeerController@deleteEmp')->name('deleteEmp');

    Route::post('/auth/deleteCv/{id}', 'EmployeerController@deleteCv')->name('deleteCv');


    Route::post('/auth/educationDashboard',  'EmployeerController@showEducationPage')->name('showEdu');
    Route::get('/auth/educationDashboard',  'EmployeerController@showEducation')->name('EduDashboard');

    Route::get('/auth/addEducation', 'EmployeerController@newEducation')->name('showEducationPage');
    Route::post('/auth/addEducation', 'EmployeerController@AddNewEducation')->name('newEducation');




    Route::get('/auth/addEducationForEmp/{id}',  'EmployeerController@newEmployeeEdu')->name('addEducationFormEmp');


    Route::get('/auth/editEducation/{id}', 'EmployeerController@editEducation')->name('editEdu');
    Route::post('/auth/saveUpdatedEdu/{id}', 'EmployeerController@saveUpdatedEdu')->name('saveUpdatedEdu');

    Route::get('/auth/editUniversity/{id}', 'EmployeerController@editUni')->name('editUni');
    Route::post('/auth/saveUpdatedUni/{id}', 'EmployeerController@saveUpdatedUni')->name('saveUpdatedUni');


    Route::post('/auth/deleteEducation/{id}', 'EmployeerController@deleteEdu')->name('deleteEdu');


});

