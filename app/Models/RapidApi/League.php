<?php

namespace App\Models\RapidApi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
	use HasFactory;

	protected $fillable = [
		'id',
		'name',
		'type',
		'logo',
		'country_name'
	];

	public function country()
	{
		return $this->belongsTo(Country::class);
	}
}
