<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;


class RapidApiSevice
{
	public function __construct(protected string $key)
	{
	}

	public function get($host, $url, $params=null){
		return Http::withHeaders(
			[
				'X-RapidAPI-Host' => $host,
				'X-RapidAPI-Key' => $this->key
			]
		)->get($url, $params);
	}
}