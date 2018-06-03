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
	$users = User::all();
    return view('welcome')->withData( $users );
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'UserController@index');
Route::get('/dt', 'UserController@dt');
Route::get('/editItem', function (Request $request) {
	$rules = array (
			'name' => 'required|alpha',		
	);
	$validator = Validator::make(Input::all(), $rules );
	if ($validator->fails ())
		return Response::json ( array (
			'errors' => $validator->getMessageBag()->toArray () 
		) );
	else {
		$user->id = User::find ( $request->id );
		$user->name = ($request->name);
		$user->save ();
		return response ()->json ( $user );
	}
});
Route::get ('/deleteItem', function (Request $request) {
	User::find ( $request->id )->delete ();
	return response ()->json ();
});