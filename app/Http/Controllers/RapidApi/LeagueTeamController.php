<?php

namespace App\Http\Controllers\RapidApi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\RapidApi\LeagueTeam;
use App\Services\RapidApi\LeagueTeamService;

class LeagueTeamController extends Controller
{
	public function index(LeagueTeamService $leagueTeam)
	{
		$data = DB::table('league_seasons')
					->select('league_id', 'season_year')
					->orderBy('league_id', 'asc')
					->where('league_id', '>=', 903)
					->get();
		$data = $this->insertData($data, $leagueTeam);
	}

	private function insertData($data, LeagueTeamService $leagueTeam)
	{
		foreach($data as $v) {
			var_dump($v->league_id);
			echo '<br>';
			echo '<br>';
			ini_set('max_execution_time', 0);
			sleep(5);
			$responce = $leagueTeam->getAllTeams($v->league_id, $v->season_year);
			$teams = $responce->json('response');
			foreach($teams as $team){
				LeagueTeam::updateOrCreate([
					'league_id' => $v->league_id,
					'season_year' => $v->season_year,
					'team_id' => $team['team']['id'],
					'name' => $team['team']['name'],
					'code' => $team['team']['code'],
					'country' => $team['team']['country'],
					'founded' => $team['team']['founded'],
					'national' => $team['team']['national'],
					'logo' => $team['team']['logo'],
					'venue_id' => $team['venue']['id'],
					'venue_name' => $team['venue']['name'],
					'address' => $team['venue']['address'],
					'city' => $team['venue']['city'],
					'capacity' => $team['venue']['capacity'],
					'surface' => $team['venue']['surface'],
					'image' => $team['venue']['image']
				]);
			}
		}
	}
}
