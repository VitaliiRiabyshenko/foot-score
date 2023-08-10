<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
	public function index()
	{
		$users = User::all();
		return view('admin.users.index', compact('users'));
	}

	public function destroy($id)
	{
		$user = User::find($id);
		$user->delete();
		return redirect()->route('admin.users.index')->with('message', 'User deleted successfully');
	}
}
