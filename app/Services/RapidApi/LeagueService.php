<?php


namespace App\Services\RapidApi;

use Exception;
use App\Services\RapidApiSevice;


class LeagueService
{
	private string $host = 'api-football-v1.p.rapidapi.com';
	private string $url = 'https://api-football-v1.p.rapidapi.com/v3/leagues?current=true';

	public function __construct(protected RapidApiSevice $rapidApiSevice)
	{
	}

	public function getLeagues()
	{
		$responce = $this->rapidApiSevice->get($this->host, $this->url);
		
		if($responce->failed()) {
			throw new Exception('Failed to connect', $responce->status());
		}
		return $responce;
	}
}