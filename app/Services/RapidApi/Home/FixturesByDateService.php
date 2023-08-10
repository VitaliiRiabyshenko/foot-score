<?php


namespace App\Services\RapidApi\Home;

use Exception;
use App\Services\RapidApiSevice;


class FixturesByDateService
{
	private string $host = 'api-football-v1.p.rapidapi.com';
	private string $url = 'https://api-football-v1.p.rapidapi.com/v3/fixtures';

	public function __construct(protected RapidApiSevice $rapidApiSevice)
	{
	}

	public function getFixtureByDate($date, $timezone)
	{
		$responce = $this->rapidApiSevice->get($this->host, $this->url, compact('date', 'timezone'));
		
		if($responce->failed()) {
			throw new Exception('Failed to connect', $responce->status());
		}
		return $responce;
	}
}