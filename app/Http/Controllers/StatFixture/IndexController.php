<?php

namespace App\Http\Controllers\StatFixture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
	public function index($id) {
		$fixture_id = $id;
		return view('stat-match.main', compact('fixture_id'));
	}
}
