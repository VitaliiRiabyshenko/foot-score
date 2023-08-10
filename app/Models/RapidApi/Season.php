<?php

namespace App\Models\RapidApi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
	use HasFactory;

	protected $fillable = [
		'year',
	];

	public function leagues()
	{
		return $this->hasMany(LeagueSeason::class, 'season_year', 'year');
	}
}
