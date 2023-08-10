<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\RapidApi\Home\FinishedFixturesService;
use Illuminate\Support\Facades\Validator;
use App\Services\RapidApi\Home\LiveFixturesService;
use App\Services\RapidApi\Home\FixturesByDateService;
use App\Services\RapidApi\Home\ScheduledFixturesService;

class FixturesController extends Controller
{
	public function fixturesByDate(FixturesByDateService $fixturesByDateService, Request $request)
	{
		$validator = Validator::make($request->all(), [
			'date' => 'required|date_format:Y-m-d'
		]);
		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()->all(),], 404);
		}

		$timezone_offset_minutes = $request->timezone;
		$timezone_name = timezone_name_from_abbr("", $timezone_offset_minutes*60, false);

		$response = $fixturesByDateService->getFixtureByDate($request->date, $timezone_name);
		$fixtures = $response->json('response');

		return $this->shortFixturesByLeague($fixtures);
	}

	public function liveFixtures(LiveFixturesService $liveFixturesService, Request $request)
	{
		$timezone_offset_minutes = $request->timezone;
		$timezone_name = timezone_name_from_abbr("", $timezone_offset_minutes*60, false);

		$response = $liveFixturesService->getLiveFixtures($timezone_name);
		$fixtures = $response->json('response');

		return $this->shortFixturesByLeague($fixtures);
	}

	public function scheduledFixtures(ScheduledFixturesService $scheduledFixturesService, Request $request)
	{
		$validator = Validator::make($request->all(), [
			'date' => 'required|date_format:Y-m-d'
		]);
		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()->all(),], 404);
		}

		$timezone_offset_minutes = $request->timezone;
		$timezone_name = timezone_name_from_abbr("", $timezone_offset_minutes*60, false);

		$response = $scheduledFixturesService->getScheduledFixtures($request->date, $timezone_name);
		$fixtures = $response->json('response');

		return $this->shortFixturesByLeague($fixtures);
	}

	public function finishedFixtures(FinishedFixturesService $finishedFixturesService, Request $request)
	{
		$validator = Validator::make($request->all(), [
			'date' => 'required|date_format:Y-m-d'
		]);
		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()->all(),], 404);
		}

		$timezone_offset_minutes = $request->timezone;
		$timezone_name = timezone_name_from_abbr("", $timezone_offset_minutes*60, false);

		$response = $finishedFixturesService->getFinishedFixtures($request->date, $timezone_name);
		$fixtures = $response->json('response');

		return $this->shortFixturesByLeague($fixtures);
	}

	private function shortFixturesByLeague($fixtures)
	{
		$leagues = [];
		$fixture_data = [];

		foreach ($fixtures as $fixture) {

			$league = $fixture['league'];
			$goals = $fixture['goals'];
			$teams = $fixture['teams'];
			$fixture = $fixture['fixture'];
			
			array_push($leagues, $league);

			$tmp_array = [
				'fixture' => $fixture,
				'league' => $league,
				'teams' => $teams,
				'goals' => $goals
			];

			array_push($fixture_data, $tmp_array);

		}

		// уникализируем 
		$leagues = array_unique($leagues, SORT_REGULAR);

		// группируем
		$fixture_groups = [];

		foreach($leagues as $league) {
			$tmp_array = [
				'league' => $league,
				'fixtures'=> [],
			];
			$tmp_fixtures = [];
			foreach($fixture_data as $value) {
				if (in_array($league, $value)) {
					array_push($tmp_fixtures, $value);
				}
			}

			$tmp_array['fixtures'] = $tmp_fixtures;

			array_push($fixture_groups, $tmp_array);
		}
		//сортруем по стране
		$array_name = [];

		foreach ($fixture_groups as $key => $row) {
			$array_name[$key] = $row['league']["country"];
		}
		array_multisort($array_name, SORT_ASC, $fixture_groups);

		return $fixture_groups;
	}
}