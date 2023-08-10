<?php

namespace App\Models\RapidApi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeagueSeason extends Model
{
	use HasFactory;

	protected $fillable = [
		'league_id',
		'season_year',
		'start',
		'end',
		'current',
		'events',
		'lineups',
		'statistics_fixtures',
		'standings',
		'players',
		'top_scorers',
		'top_assists',
		'top_cards',
		'injuries',
		'predictions',
		'odds'
	];
}
