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
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'UserController@index');
Route::get('/dt', 'UserController@dt');
Route::post('/dt/editUser', 'UserController@editUser');
Route::post ('/deleteUser', function (Request $request) {
	User::find ( $request->id )->delete ();
	return response ()->json ();
});

//wait
