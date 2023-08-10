<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaguesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('leagues', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('type');
			$table->string('logo')->nullable();
			$table->timestamps();
			
			$table->string('country_name');
			$table->index('country_name', 'league_country_idx');
			$table->foreign('country_name', 'league_country_fk')->on('countries')->references('name');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('leagues');
	}
}
