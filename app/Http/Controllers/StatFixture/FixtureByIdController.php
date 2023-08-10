<?php

namespace App\Http\Controllers\StatFixture;

use App\Http\Controllers\Controller;
use App\Services\RapidApi\StatFixture\FixtureByIdService;
use Illuminate\Http\Request;

class FixtureByIdController extends Controller
{
	public function index(FixtureByIdService $fixtureByIdService, Request $request) {
		/*$fixture =
			array ( 0 => array ( 'fixture' => array ( 'id' => 868152, 'referee' => 'Michael Oliver, England', 'timezone' => 'Europe/London', 'date' => '2023-01-21T12:30:00+00:00', 'timestamp' => 1674304200, 'periods' => array ( 'first' => 1674304200, 'second' => 1674307800, ), 'venue' => array ( 'id' => 550, 'name' => 'Anfield', 'city' => 'Liverpool', ), 'status' => array ( 'long' => '2nd Half', 'short' => '2H', 'elapsed' => 85, ), ), 'league' => array ( 'id' => 39, 'name' => 'Premier League', 'country' => 'England', 'logo' => 'https://media.api-sports.io/football/leagues/39.png', 'flag' => 'https://media.api-sports.io/flags/gb.svg', 'season' => 2022, 'round' => 'Regular Season - 21', ), 'teams' => array ( 'home' => array ( 'id' => 40, 'name' => 'Liverpool', 'logo' => 'https://media.api-sports.io/football/teams/40.png', 'winner' => NULL, ), 'away' => array ( 'id' => 49, 'name' => 'Chelsea', 'logo' => 'https://media-3.api-sports.io/football/teams/49.png', 'winner' => NULL, ), ), 'goals' => array ( 'home' => 0, 'away' => 0, ), 'score' => array ( 'halftime' => array ( 'home' => 0, 'away' => 0, ), 'fulltime' => array ( 'home' => 0, 'away' => 0, ), 'extratime' => array ( 'home' => NULL, 'away' => NULL, ), 'penalty' => array ( 'home' => NULL, 'away' => NULL, ), ), 'lineups' => array ( 0 => array ( 'team' => array ( 'id' => 40, 'name' => 'Liverpool', 'logo' => 'https://media-3.api-sports.io/football/teams/40.png', 'colors' => array ( 'player' => array ( 'primary' => 'e41e2c', 'number' => 'ffffff', 'border' => 'e41e2c', ), 'goalkeeper' => array ( 'primary' => 'ebceed', 'number' => '000000', 'border' => 'ebceed', ), ), ), 'coach' => array ( 'id' => 1, 'name' => 'J. Klopp', 'photo' => 'https://media.api-sports.io/football/coachs/1.png', ), 'formation' => '4-3-3', 'substitutes' => array ( 0 => array ( 'player' => array ( 'id' => 51617, 'name' => 'D. Núñez', 'number' => 27, 'pos' => 'F', 'grid' => NULL, ), ), 1 => array ( 'player' => array ( 'id' => 283, 'name' => 'T. Alexander-Arnold', 'number' => 66, 'pos' => 'D', 'grid' => NULL, ), ), 2 => array ( 'player' => array ( 'id' => 293, 'name' => 'C. Jones', 'number' => 17, 'pos' => 'M', 'grid' => NULL, ), ), 3 => array ( 'player' => array ( 'id' => 299, 'name' => 'Fabinho', 'number' => 3, 'pos' => 'M', 'grid' => NULL, ), ), 4 => array ( 'player' => array ( 'id' => 292, 'name' => 'J. Henderson', 'number' => 14, 'pos' => 'M', 'grid' => NULL, ), ), 5 => array ( 'player' => array ( 'id' => 281, 'name' => 'C. Kelleher', 'number' => 62, 'pos' => 'G', 'grid' => NULL, ), ), 6 => array ( 'player' => array ( 'id' => 286, 'name' => 'J. Matip', 'number' => 32, 'pos' => 'D', 'grid' => NULL, ), ), 7 => array ( 'player' => array ( 'id' => 297, 'name' => 'A. Oxlade-Chamberlain', 'number' => 15, 'pos' => 'M', 'grid' => NULL, ), ), 8 => array ( 'player' => array ( 'id' => 1600, 'name' => 'K. Tsimikas', 'number' => 21, 'pos' => 'D', 'grid' => NULL, ), ), ), 'startXI' => array ( 0 => array ( 0 => array ( 0 => array ( 'player' => array ( 'id' => 280, 'name' => 'Alisson', 'number' => 1, 'pos' => 'G', 'grid' => '1:1', ), ), ), 1 => array ( 0 => array ( 'player' => array ( 'id' => 289, 'name' => 'A. Robertson', 'number' => 26, 'pos' => 'D', 'grid' => '2:4', ), ), 1 => array ( 'player' => array ( 'id' => 284, 'name' => 'J. Gomez', 'number' => 2, 'pos' => 'D', 'grid' => '2:3', ), ), 2 => array ( 'player' => array ( 'id' => 1145, 'name' => 'I. Konaté', 'number' => 5, 'pos' => 'D', 'grid' => '2:2', ), ), 3 => array ( 'player' => array ( 'id' => 310187, 'name' => 'Stefan Bajčetić', 'number' => 43, 'pos' => 'M', 'grid' => '2:1', ), ), ), 2 => array ( 0 => array ( 'player' => array ( 'id' => 296, 'name' => 'J. Milner', 'number' => 7, 'pos' => 'D', 'grid' => '3:3', ), ), 1 => array ( 'player' => array ( 'id' => 507, 'name' => 'Thiago Alcântara', 'number' => 6, 'pos' => 'M', 'grid' => '3:2', ), ), 2 => array ( 'player' => array ( 'id' => 294, 'name' => 'N. Keïta', 'number' => 8, 'pos' => 'M', 'grid' => '3:1', ), ), ), 3 => array ( 0 => array ( 'player' => array ( 'id' => 19035, 'name' => 'H. Elliott', 'number' => 19, 'pos' => 'F', 'grid' => '4:3', ), ), 1 => array ( 'player' => array ( 'id' => 306, 'name' => 'Mohamed Salah', 'number' => 11, 'pos' => 'F', 'grid' => '4:2', ), ), 2 => array ( 'player' => array ( 'id' => 247, 'name' => 'C. Gakpo', 'number' => 18, 'pos' => 'F', 'grid' => '4:1', ), ), ), 4 => array ( ), ), ), ), 1 => array ( 'team' => array ( 'id' => 49, 'name' => 'Chelsea', 'logo' => 'https://media-3.api-sports.io/football/teams/49.png', 'colors' => array ( 'player' => array ( 'primary' => '1532c1', 'number' => 'ffffff', 'border' => '1532c1', ), 'goalkeeper' => array ( 'primary' => 'e3e3e3', 'number' => '000000', 'border' => 'e3e3e3', ), ), ), 'coach' => array ( 'id' => 12, 'name' => 'G. Potter', 'photo' => 'https://media.api-sports.io/football/coachs/12.png', ), 'formation' => '3-4-2-1', 'substitutes' => array ( 0 => array ( 'player' => array ( 'id' => 63577, 'name' => 'M. Mudryk', 'number' => 15, 'pos' => 'M', 'grid' => NULL, ), ), 1 => array ( 'player' => array ( 'id' => 1465, 'name' => 'P. Aubameyang', 'number' => 9, 'pos' => 'F', 'grid' => NULL, ), ), 2 => array ( 'player' => array ( 'id' => 2280, 'name' => 'César Azpilicueta', 'number' => 28, 'pos' => 'D', 'grid' => NULL, ), ), 3 => array ( 'player' => array ( 'id' => 138935, 'name' => 'C. Chukwuemeka', 'number' => 30, 'pos' => 'M', 'grid' => NULL, ), ), 4 => array ( 'player' => array ( 'id' => 291476, 'name' => 'D. Fofana', 'number' => 27, 'pos' => 'F', 'grid' => NULL, ), ), 5 => array ( 'player' => array ( 'id' => 2292, 'name' => 'R. Loftus-Cheek', 'number' => 12, 'pos' => 'M', 'grid' => NULL, ), ), 6 => array ( 'player' => array ( 'id' => 318, 'name' => 'K. Koulibaly', 'number' => 26, 'pos' => 'D', 'grid' => NULL, ), ), 7 => array ( 'player' => array ( 'id' => 19012, 'name' => 'M. Bettinelli', 'number' => 13, 'pos' => 'G', 'grid' => NULL, ), ), 8 => array ( 'player' => array ( 'id' => 181797, 'name' => 'B. Humphreys', 'number' => 42, 'pos' => 'D', 'grid' => NULL, ), ), ), 'startXI' => array ( 0 => array ( 0 => array ( 0 => array ( 'player' => array ( 'id' => 2273, 'name' => 'Kepa', 'number' => 1, 'pos' => 'G', 'grid' => '1:1', ), ), ), 1 => array ( 0 => array ( 'player' => array ( 'id' => 259, 'name' => 'Thiago Silva', 'number' => 6, 'pos' => 'D', 'grid' => '2:3', ), ), 1 => array ( 'player' => array ( 'id' => 47380, 'name' => 'Marc Cucurella', 'number' => 32, 'pos' => 'M', 'grid' => '2:2', ), ), 2 => array ( 'player' => array ( 'id' => 19720, 'name' => 'T. Chalobah', 'number' => 14, 'pos' => 'D', 'grid' => '2:1', ), ), ), 2 => array ( 0 => array ( 'player' => array ( 'id' => 95, 'name' => 'B. Badiashile', 'number' => 4, 'pos' => 'D', 'grid' => '3:4', ), ), 1 => array ( 'player' => array ( 'id' => 2289, 'name' => 'Jorginho', 'number' => 5, 'pos' => 'M', 'grid' => '3:3', ), ), 2 => array ( 'player' => array ( 'id' => 548, 'name' => 'H. Ziyech', 'number' => 22, 'pos' => 'M', 'grid' => '3:2', ), ), 3 => array ( 'player' => array ( 'id' => 19220, 'name' => 'M. Mount', 'number' => 19, 'pos' => 'F', 'grid' => '3:1', ), ), ), 3 => array ( 0 => array ( 'player' => array ( 'id' => 978, 'name' => 'K. Havertz', 'number' => 29, 'pos' => 'F', 'grid' => '4:2', ), ), 1 => array ( 'player' => array ( 'id' => 67972, 'name' => 'C. Gallagher', 'number' => 23, 'pos' => 'F', 'grid' => '4:1', ), ), ), 4 => array ( 0 => array ( 'player' => array ( 'id' => 284492, 'name' => 'L. Hall', 'number' => 67, 'pos' => 'M', 'grid' => '5:1', ), ), ), 5 => array ( ), ), ), ), ), 'events' => array ( 0 => array ( 'before the game' => array ( ), 'FIRST HALF' => array ( 0 => array ( 'time' => array ( 'elapsed' => 4, 'extra' => NULL, ), 'team' => array ( 'id' => 49, 'name' => 'Chelsea', 'logo' => 'https://media-3.api-sports.io/football/teams/49.png', ), 'player' => array ( 'id' => 978, 'name' => 'Kai Havertz', ), 'assist' => array ( 'id' => NULL, 'name' => NULL, ), 'type' => 'Var', 'detail' => 'Goal cancelled', 'comments' => NULL, ), 1 => array ( 'time' => array ( 'elapsed' => 34, 'extra' => NULL, ), 'team' => array ( 'id' => 40, 'name' => 'Liverpool', 'logo' => 'https://media-3.api-sports.io/football/teams/40.png', ), 'player' => array ( 'id' => 310187, 'name' => 'Stefan Bajčetić', ), 'assist' => array ( 'id' => NULL, 'name' => NULL, ), 'type' => 'Card', 'detail' => 'Yellow Card', 'comments' => 'Foul', ), ), 'SECOND HALF' => array ( 0 => array ( 'time' => array ( 'elapsed' => 55, 'extra' => NULL, ), 'team' => array ( 'id' => 49, 'name' => 'Chelsea', 'logo' => 'https://media-3.api-sports.io/football/teams/49.png', ), 'player' => array ( 'id' => 284492, 'name' => 'L. Hall', ), 'assist' => array ( 'id' => 63577, 'name' => 'M. Mudryk', ), 'type' => 'subst', 'detail' => 'Substitution 1', 'comments' => NULL, ), 1 => array ( 'time' => array ( 'elapsed' => 63, 'extra' => NULL, ), 'team' => array ( 'id' => 40, 'name' => 'Liverpool', 'logo' => 'https://media-3.api-sports.io/football/teams/40.png', ), 'player' => array ( 'id' => 294, 'name' => 'N. Keïta', ), 'assist' => array ( 'id' => 51617, 'name' => 'D. Núñez', ), 'type' => 'subst', 'detail' => 'Substitution 1', 'comments' => NULL, ), 2 => array ( 'time' => array ( 'elapsed' => 66, 'extra' => NULL, ), 'team' => array ( 'id' => 40, 'name' => 'Liverpool', 'logo' => 'https://media.api-sports.io/football/teams/40.png', ), 'player' => array ( 'id' => 296, 'name' => 'James Milner', ), 'assist' => array ( 'id' => NULL, 'name' => NULL, ), 'type' => 'Card', 'detail' => 'Yellow Card', 'comments' => 'Foul', ), 3 => array ( 'time' => array ( 'elapsed' => 72, 'extra' => NULL, ), 'team' => array ( 'id' => 40, 'name' => 'Liverpool', 'logo' => 'https://media.api-sports.io/football/teams/40.png', ), 'player' => array ( 'id' => 296, 'name' => 'J. Milner', ), 'assist' => array ( 'id' => 283, 'name' => 'T. Alexander-Arnold', ), 'type' => 'subst', 'detail' => 'Substitution 2', 'comments' => NULL, ), 4 => array ( 'time' => array ( 'elapsed' => 80, 'extra' => NULL, ), 'team' => array ( 'id' => 49, 'name' => 'Chelsea', 'logo' => 'https://media-3.api-sports.io/football/teams/49.png', ), 'player' => array ( 'id' => 19720, 'name' => 'Trevoh Chalobah', ), 'assist' => array ( 'id' => NULL, 'name' => NULL, ), 'type' => 'Card', 'detail' => 'Yellow Card', 'comments' => 'Time wasting', ), 5 => array ( 'time' => array ( 'elapsed' => 81, 'extra' => NULL, ), 'team' => array ( 'id' => 49, 'name' => 'Chelsea', 'logo' => 'https://media-3.api-sports.io/football/teams/49.png', ), 'player' => array ( 'id' => 978, 'name' => 'K. Havertz', ), 'assist' => array ( 'id' => 1465, 'name' => 'P. Aubameyang', ), 'type' => 'subst', 'detail' => 'Substitution 2', 'comments' => NULL, ), 6 => array ( 'time' => array ( 'elapsed' => 81, 'extra' => NULL, ), 'team' => array ( 'id' => 49, 'name' => 'Chelsea', 'logo' => 'https://media.api-sports.io/football/teams/49.png', ), 'player' => array ( 'id' => 19720, 'name' => 'T. Chalobah', ), 'assist' => array ( 'id' => 2280, 'name' => 'César Azpilicueta', ), 'type' => 'subst', 'detail' => 'Substitution 3', 'comments' => NULL, ), 7 => array ( 'time' => array ( 'elapsed' => 82, 'extra' => NULL, ), 'team' => array ( 'id' => 40, 'name' => 'Liverpool', 'logo' => 'https://media.api-sports.io/football/teams/40.png', ), 'player' => array ( 'id' => 19035, 'name' => 'H. Elliott', ), 'assist' => array ( 'id' => 293, 'name' => 'C. Jones', ), 'type' => 'subst', 'detail' => 'Substitution 3', 'comments' => NULL, ), 8 => array ( 'time' => array ( 'elapsed' => 82, 'extra' => NULL, ), 'team' => array ( 'id' => 40, 'name' => 'Liverpool', 'logo' => 'https://media-3.api-sports.io/football/teams/40.png', ), 'player' => array ( 'id' => 310187, 'name' => 'Stefan Bajčetić', ), 'assist' => array ( 'id' => 299, 'name' => 'Fabinho', ), 'type' => 'subst', 'detail' => 'Substitution 4', 'comments' => NULL, ), 9 => array ( 'time' => array ( 'elapsed' => 82, 'extra' => NULL, ), 'team' => array ( 'id' => 40, 'name' => 'Liverpool', 'logo' => 'https://media.api-sports.io/football/teams/40.png', ), 'player' => array ( 'id' => 247, 'name' => 'C. Gakpo', ), 'assist' => array ( 'id' => 292, 'name' => 'J. Henderson', ), 'type' => 'subst', 'detail' => 'Substitution 5', 'comments' => NULL, ), 10 => array ( 'time' => array ( 'elapsed' => 82, 'extra' => NULL, ), 'team' => array ( 'id' => 49, 'name' => 'Chelsea', 'logo' => 'https://media-3.api-sports.io/football/teams/49.png', ), 'player' => array ( 'id' => 19220, 'name' => 'M. Mount', ), 'assist' => array ( 'id' => 138935, 'name' => 'C. Chukwuemeka', ), 'type' => 'subst', 'detail' => 'Substitution 4', 'comments' => NULL, ), 11 => array ( 'time' => array ( 'elapsed' => 90, 'extra' => NULL, ), 'team' => array ( 'id' => 40, 'name' => 'Liverpool', 'logo' => 'https://media-3.api-sports.io/football/teams/40.png', ), 'player' => array ( 'id' => 293, 'name' => 'Curtis Jones', ), 'assist' => array ( 'id' => NULL, 'name' => NULL, ), 'type' => 'Card', 'detail' => 'Yellow Card', 'comments' => 'Argument', ), ), 'EXTRA TIME' => array ( ), 'PENALTY SHOOTOUT' => array ( ), ), ), 'statistics' => array ( 0 => array ( 0 => array ( 'type' => 'Shots on Goal', 0 => 3, 1 => 2, ), 1 => array ( 'type' => 'Shots off Goal', 0 => 6, 1 => 6, ), 2 => array ( 'type' => 'Total Shots', 0 => 15, 1 => 11, ), 3 => array ( 'type' => 'Blocked Shots', 0 => 6, 1 => 3, ), 4 => array ( 'type' => 'Shots insidebox', 0 => 10, 1 => 9, ), 5 => array ( 'type' => 'Shots outsidebox', 0 => 5, 1 => 2, ), 6 => array ( 'type' => 'Fouls', 0 => 12, 1 => 9, ), 7 => array ( 'type' => 'Corner Kicks', 0 => 8, 1 => 5, ), 8 => array ( 'type' => 'Offsides', 0 => 5, 1 => 1, ), 9 => array ( 'type' => 'Ball Possession', 0 => '48%', 1 => '52%', ), 10 => array ( 'type' => 'Yellow Cards', 0 => 3, 1 => 1, ), 11 => array ( 'type' => 'Red Cards', 0 => NULL, 1 => NULL, ), 12 => array ( 'type' => 'Goalkeeper Saves', 0 => 2, 1 => 3, ), 13 => array ( 'type' => 'Total passes', 0 => 477, 1 => 540, ), 14 => array ( 'type' => 'Passes accurate', 0 => 375, 1 => 437, ), 15 => array ( 'type' => 'Passes %', 0 => '79%', 1 => '81%', ), 16 => array ( 'type' => 'expected_goals', 0 => 1, 1 => 1, ), ), ), ), )
		;
		
		return $fixture;*/

		$timezone_offset_minutes = $request->timezone;
		$timezone_name = timezone_name_from_abbr("", $timezone_offset_minutes*60, false);

		$response = $fixtureByIdService->getFixtureById($request->id, $timezone_name);
		$fixture = $response->json('response');

		if(empty($fixture)) {
			return response()->json(['error' => 'The game not found'], 500);
		} else {
			return $this->shortEventsByTime($fixture);
		}
	}

	private function shortEventsByTime($fixture)
	{
		$fixture_event = [
			'before the game' => [],
			'FIRST HALF' => [],
			'SECOND HALF' => [],
			'EXTRA TIME' => [],
			'PENALTY SHOOTOUT' => [],
		];

		$events = $fixture[0]['events'];

		foreach($events as $event) {
			if($event['time']['elapsed'] < 0) {
				array_push($fixture_event['before the game'], $event);
				continue;
			}
			if($event['time']['elapsed'] <= 45) {
				array_push($fixture_event['FIRST HALF'], $event);
				continue;
			}
			if($event['time']['elapsed'] <= 90) {
				array_push($fixture_event['SECOND HALF'], $event);
				continue;
			}
			if($event['time']['elapsed'] <= 120 && $event['comments'] !== "Penalty Shootout") {
				array_push($fixture_event['EXTRA TIME'], $event);
				continue;
			}
			if($event['time']['elapsed'] > 120 || $event['comments'] == "Penalty Shootout") {
				array_push($fixture_event['PENALTY SHOOTOUT'], $event);
				continue;
			}
		}
		unset($fixture[0]['events']);
		unset($fixture[0]['players']);
		$fixture[0]['events'] = [];
		array_push($fixture[0]['events'], $fixture_event);
	
		
		// стартовый состав
		if(!empty($fixture[0]['lineups']) && ($fixture[0]['lineups'][0]["formation"] !== null || $fixture[0]['lineups'][1]["formation"] !== null)) {
			$startXI = [];
			foreach($fixture[0]['lineups'] as $lineup) {
				$tmp_startXI = [0=>[],];
				foreach($lineup['startXI'] as $player) {
					$grid_line = substr($player['player']['grid'], 0, 1);
					$tmp_startXI[$grid_line] = [];
					if($player['player']['pos'] == 'G') {
						array_push($tmp_startXI[0], $player);
					} else {
						array_push($tmp_startXI[($grid_line-1)], $player);
					}
					continue;
				}
				array_push($startXI, $tmp_startXI);
			}
			unset($fixture[0]['lineups'][0]['startXI']);
			$fixture[0]['lineups'][0]['startXI'] = [];
			unset($fixture[0]['lineups'][1]['startXI']);
			$fixture[0]['lineups'][1]['startXI'] = [];
			array_push($fixture[0]['lineups'][0]['startXI'], $startXI[0]);
			array_push($fixture[0]['lineups'][1]['startXI'], $startXI[1]);
		}
	
		// статистика матча 
		if(!empty($fixture[0]['statistics'])) {
			$stats_home = $fixture[0]['statistics'][0]['statistics'];
			$stats_away = $fixture[0]['statistics'][1]['statistics'];

			$stats_sort = [];
			foreach($stats_home as $stat_h) {
				foreach($stats_away as $stat_a) {
					if($stat_h['type'] === $stat_a['type']) {
						$tmp_stat = 	[
											'type' => $stat_a['type'],
											0 => $stat_h['value'],
											1 => $stat_a['value'],
										];
						array_push($stats_sort, $tmp_stat);
					}
				}
			}
			unset($fixture[0]['statistics']);
			$fixture[0]['statistics'] = [];
			array_push($fixture[0]['statistics'], $stats_sort);
		}


		return $fixture;
	}
}