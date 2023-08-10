<?php

namespace App\Models\RapidApi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeagueTeam extends Model
{
	use HasFactory;

	protected $fillable = [
		'league_id',
		'season_year',
		'team_id',
		'name',
		'code',
		'country',
		'founded',
		'national',
		'logo',
		'venue_id',
		'venue_name',
		'address',
		'city',
		'capacity',
		'surface',
		'image'
	];
}
