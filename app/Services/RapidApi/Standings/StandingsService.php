<?php


namespace App\Services\RapidApi\Standings;

use Exception;
use App\Services\RapidApiSevice;


class StandingsService
{
	private string $host = 'api-football-v1.p.rapidapi.com';
	private string $url = 'https://api-football-v1.p.rapidapi.com/v3/standings';

	public function __construct(protected RapidApiSevice $rapidApiSevice)
	{
	}

	public function getStandings($season, $league)
	{
		$responce = $this->rapidApiSevice->get($this->host, $this->url, compact('season', 'league'));
		
		if($responce->failed()) {
			throw new Exception('Failed to connect', $responce->status());
		}
		return $responce;
	}
}