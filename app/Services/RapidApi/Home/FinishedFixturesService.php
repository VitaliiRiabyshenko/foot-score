<?php


namespace App\Services\RapidApi\Home;

use Exception;
use App\Services\RapidApiSevice;


class FinishedFixturesService
{
	private string $host = 'api-football-v1.p.rapidapi.com';
	private string $url = 'https://api-football-v1.p.rapidapi.com/v3/fixtures';

	public function __construct(protected RapidApiSevice $rapidApiSevice)
	{
	}

	public function getFinishedFixtures($date, $timezone)
	{
		$status = 'AET-PEN-FT-AET';
		$responce = $this->rapidApiSevice->get($this->host, $this->url, compact('date', 'status', 'timezone'));
		
		if($responce->failed()) {
			throw new Exception('Failed to connect', $responce->status());
		}
		
		return $responce;
	}
}