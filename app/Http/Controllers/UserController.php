<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\User;

class UserController extends Controller
{

	public function index(){

		$users = \App\User::all();
		return view('home', compact('users'));
	}
	public function dt(){

		$users = \App\User::all();
		return view('dt', compact('users'));
	}
	
}
