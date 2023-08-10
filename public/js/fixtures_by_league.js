"use strict"

const {league_id, season} = getFixtureData();

function getFixtures(route) {

	$.ajax({
	method: "GET",
	url: `/${route}`,
	data: {
		league: league_id,
		season: season,
		timezone: getTimezone()
	},
	success: function(fixtures) {
		console.log(fixtures);

		document.title = 'Foot-score | '+fixtures[0].league.country+': '+fixtures[0].league.name+'';

		let header_html = 	'<div><img src="'+fixtures[0].league.logo+'" class="rounded" width="100px" style="margin:5px"></div>'+
							'<div class="mt-3">'+
								'<h3>'+fixtures[0].league.country+': '+fixtures[0].league.name+'</h3>'+
								'<span>'+fixtures[0].league.season+'</span>'+
							'</div>';
		document.getElementById('league_header').innerHTML = header_html;

		if(typeof fixtures.error == 'undefined') {
			gamesHTML(fixtures[0].fixturesByRound);
		} else {
			let errorsHtml = `<div class="alert alert-danger mt-3">${fixtures.error}</div>`;
			document.getElementById('fixtures').innerHTML = errorsHtml;
		}
		
	},
	error: function(data) {
		$("#btns").empty();
		$("#league_header").empty();
		var errors = data.responseJSON;
		let errorsHtml = '<div class="alert alert-danger"><ul>';
		$.each(errors.errors, function(k,v) {
			errorsHtml += '<p>'+ v + '</p>';
		});
		errorsHtml += '</div>';

		document.getElementById('fixtures').innerHTML = errorsHtml;
	}
	});
};

function gamesHTML(games) {
	let games_html = '';

	$.each(games, function() {
			let games_html = '<div class="row m-1">'+
								'<div class="border bg-light rounded-1">'+
									'<span class="ms-1">'+ this.round +'</span>'+
								'</div>';
			$("#fixtures").append(games_html);
			$.each(this.fixtures, function() {
				let games_html = '<a href="/match/'+ this.fixture.id +'" class="text-decoration-none text-black wd-600 fixture-hover">'+
									'<div class="fixture pl-15 fixture-hover">'+
										'<div class="fixture-time">'+
											'<span>'+ timeFixture(this.fixture.date) +'</span>'+
										'</div>'+
										'<div class="fxt-team fxt-home">'+
											'<img src="'+ this.teams.home.logo +'" height="20">'+
											'<span class="text-center p-1">'+ teamWinner(this.teams.home) +'</span>'+
											'<span class="home-goal">'+ getGoal(this.goals.home) +'</span>'+
										'</div>'+
										'<div class="fxt-team fxt-away">'+
											'<img src="'+ this.teams.away.logo +'" height="20">'+
											'<span class="text-center p-1">' + teamWinner(this.teams.away) +'</span>'+
											'<span class="away-goal">'+ getGoal(this.goals.away) +'</span>'+
										'</div>'+
									'</div>'
								'</a>'+
							'</div>';
			$("#fixtures").append(games_html);
			});
		});
}
/*
'<div class="fixture pl-15 fixture-hover">'+
	'<div class="fixture-time">'+
		'<span>'+ timeFixture(this.fixture.status, this.fixture.date) +'</span>'+
	'</div>'+
	'<div class="fxt-team fxt-home">'+
		'<img src="'+ this.teams.home.logo +'" height="20">'+
		'<span class="text-center p-1">'+ teamWinner(this.teams.home) +'</span>'+
		'<span class="home-goal">'+ getGoal(this.goals.home) +'</span>'+
	'</div>'+
	'<div class="fxt-team fxt-away">'+
		'<img src="'+ this.teams.away.logo +'" height="20">'+
		'<span class="text-center p-1">' + teamWinner(this.teams.away) +'</span>'+
		'<span class="away-goal">'+ getGoal(this.goals.away) +'</span>'+
	'</div>'+
'</div>'*/

function timeFixture(un_sort_date) {
	let date_format = moment(un_sort_date);
	return date_format.format("DD.MM kk:mm");
};