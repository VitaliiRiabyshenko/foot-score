<?php


namespace App\Services\RapidApi\StatFixture;

use Exception;
use App\Services\RapidApiSevice;


class FixtureByIdService
{
	private string $host = 'api-football-v1.p.rapidapi.com';
	private string $url = 'https://api-football-v1.p.rapidapi.com/v3/fixtures';

	public function __construct(protected RapidApiSevice $rapidApiSevice)
	{
	}

	public function getFixtureById($id, $timezone)
	{
		$responce = $this->rapidApiSevice->get($this->host, $this->url, compact('id', 'timezone'));
		
		if($responce->failed()) {
			throw new Exception('Failed to connect', $responce->status());
		}
		return $responce;
	}
}