<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Models\RapidApi\Country;
use App\Http\Controllers\Controller;

class LeagueController extends Controller
{
	public function leagueByCountry($country)
	{
		$country = Country::where('name', $country)->first();
		
		if($country !== null) {
			$country_nm = $country->name;
			$leagues = $country->current_leagues;

			return view('league.index', compact('leagues', 'country_nm'));
		} else {
			return abort(404);
		}
	}
}
