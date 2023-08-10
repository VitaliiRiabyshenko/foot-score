<?php


namespace App\Services\RapidApi\Standings;

use Exception;
use App\Services\RapidApiSevice;


class FixturesByLeagueService
{
	private string $host = 'api-football-v1.p.rapidapi.com';
	private string $url = 'https://api-football-v1.p.rapidapi.com/v3/fixtures';

	public function __construct(protected RapidApiSevice $rapidApiSevice)
	{
	}

	public function getFinishedFixtures($league, $season,$timezone, $status)
	{
		$responce = $this->rapidApiSevice->get($this->host, $this->url, compact('league', 'season', 'timezone', 'status'));
		
		if($responce->failed()) {
			throw new Exception('Failed to connect', $responce->status());
		}
		
		return $responce;
	}
}