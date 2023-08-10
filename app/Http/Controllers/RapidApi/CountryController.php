<?php

namespace App\Http\Controllers\RapidApi;

use App\Models\RapidApi\Country;
use Illuminate\Routing\Controller;
use App\Services\RapidApi\CountryService;


class CountryController extends Controller
{

	public function index(CountryService $countryService)
	{
		
		$responce = $countryService->getAllCounries();
		$countries = $responce->json('response');
		foreach ($countries as $country) {
			Country::updateOrCreate([
				'name' => $country['name'],
				'code' => $country['code'],
				'flag' => $country['flag'],
			]);
		}

	}
}
