<?php

namespace App\Http\Controllers\RapidApi;

use App\Models\RapidApi\Season;
use Illuminate\Routing\Controller;
use App\Services\RapidApi\SeasonService;

class SeasonController extends Controller
{

	public function index(SeasonService $seasonService)
	{
		$responce = $seasonService->getAllSeasons();
		$seasons = $responce->json('response');
		foreach ($seasons as $season) {
			Season::updateOrCreate([
				'year' => $season,
			]);
		}
	}

}
