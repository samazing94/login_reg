<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\User;

class UserController extends Controller
{

	public function index(){

		$users = \App\User::all();
		return view('home', compact('users'));
	}
	public function dt_t()
	{
		return DataTables::of(User::query())->make(true);
	}
	public function dt(){

		$users = \App\User::all();
		return view('dt', compact('users'));
	}

	public function editUser(Request $request) {
		$rules = array (
			'name' => 'required|alpha',
		);

		$validator = Validator::make(Input::all(), $rules );

		if ($validator->fails ()) {
			return Response::json ( array (
				'errors' => $validator->getMessageBag()->toArray () 
			));
		}
		else {
			$user->id = User::find ( $request->id );
			$user->name = ($request->name);
			$user->save ();
			return response ()->json ( $user );
		}
	}
	
}
