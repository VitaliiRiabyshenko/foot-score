<?php

namespace App\Http\Controllers\RapidApi;


use App\Models\RapidApi\Country;
use App\Models\RapidApi\League;
use App\Models\RapidApi\LeagueSeason;
use App\Models\RapidApi\Season;
use Illuminate\Routing\Controller;
use App\Services\RapidApi\LeagueService;

class LeagueController extends Controller
{
	public function index(LeagueService $leagueService)
	{
		// добавление всех лиг и их атрибутов
		$responce = $leagueService->getLeagues();
		$leagues = $responce->json('response');

		foreach ($leagues as $league) {
			League::updateOrCreate(['id' => $league['league']['id'],],
				[
					'name' => $league['league']['name'],
					'type' => $league['league']['type'],
					'logo' => $league['league']['logo'],
					'country_name' => $league['country']['name'],
				]);

			foreach ($league['seasons'] as $season){
				LeagueSeason::updateOrCreate(['league_id' => $league['league']['id']],
					[
						'season_year' => $season['year'],
						'start' => $season['start'],
						'end' => $season['end'],
						'current' => $season['current'],

						'events' => $season['coverage']['fixtures']['events'],
						'lineups' => $season['coverage']['fixtures']['lineups'],
						'statistics_fixtures' => $season['coverage']['fixtures']['statistics_fixtures'],
						'statistics_players' => $season['coverage']['fixtures']['statistics_players'],

						'standings' => $season['coverage']['standings'],
						'players' => $season['coverage']['players'],
						'top_scorers' => $season['coverage']['top_scorers'],
						'top_assists' => $season['coverage']['top_assists'],
						'top_cards' => $season['coverage']['top_cards'],
						'injuries' => $season['coverage']['injuries'],
						'predictions' => $season['coverage']['predictions'],
						'odds' => $season['coverage']['odds'],
					]);
			}
		}
	}
}
