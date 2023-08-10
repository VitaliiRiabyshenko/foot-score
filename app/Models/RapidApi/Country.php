<?php

namespace App\Models\RapidApi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
	use HasFactory;

	protected $fillable = [
		'name',
		'code',
		'flag',
	];

	public function current_leagues()
	{
		return $this->hasMany(League::class, 'country_name', 'name')
					->join('league_seasons', function($join) {
						$join->on('leagues.id', '=', 'league_seasons.league_id')
						->where('league_seasons.current', '=', 1);
					})
					->select('leagues.*');
	}
}
