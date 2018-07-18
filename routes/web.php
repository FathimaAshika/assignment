<?php
	use App\ParentStudent as Parents;

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
    return view('auth.login');

});

 




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function() {
      Route::resource('cources','CourceController');

    Route::resource('students','StudentController');
    Route::resource('users','UserController');

    Route::resource('parents','ParentsController');
    Route::get('send/student_details/{email}','UserController@sendEmailStudentDetails');

    // create middleware for admin 
    
    // Route::group(['middleware' => 'jwt-auth'], function () {
    //     Route::get('get_user_details/{token}', 'APIController@get_user_details');
    // });

   
});


