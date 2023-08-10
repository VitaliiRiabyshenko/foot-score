<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeagueSeasonsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('league_seasons', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('league_id');
			$table->index('league_id', 'league_season_league_id_idx');
			$table->foreign('league_id', 'league_season_league_id_fk')->on('leagues')->references('id');

			$table->integer('season_year');
			$table->foreign('season_year')->references('year')->on('seasons');

			$table->date('start');
			$table->date('end');
			$table->boolean('current')->default(0);
			$table->boolean('events')->default(0);
			$table->boolean('lineups')->default(0);
			$table->boolean('statistics_fixtures')->default(0);
			$table->boolean('statistics_players')->default(0);
			$table->boolean('standings')->default(0);
			$table->boolean('players')->default(0);
			$table->boolean('top_scorers')->default(0);
			$table->boolean('top_assists')->default(0);
			$table->boolean('top_cards')->default(0);
			$table->boolean('injuries')->default(0);
			$table->boolean('predictions')->default(0);
			$table->boolean('odds')->default(0);

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('league_seasons');
	}
}
