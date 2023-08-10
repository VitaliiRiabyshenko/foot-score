<?php


namespace App\Services\RapidApi;

use Exception;
use App\Services\RapidApiSevice;


class LeagueTeamService
{
	private string $host = 'api-football-v1.p.rapidapi.com';
	private string $url = 'https://api-football-v1.p.rapidapi.com/v3/teams';

	public function __construct(protected RapidApiSevice $rapidApiSevice)
	{
	}

	public function getAllTeams($league, $season)
	{
		$responce = $this->rapidApiSevice->get($this->host, $this->url, compact('league', 'season'));
		
		if($responce->failed()) {
			throw new Exception('Failed to connect', $responce->status());
		}
		return $responce;
	}
}