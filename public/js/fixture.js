"use strict"

$(document).ready(function() {
	ajaxRequestFixture();
	setTimeout(refreshFixture, 5000);
});

function ajaxRequestFixture() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});
	$.ajax({
	method: "GET",
	url: "/fixture",
	data: {
		id: getFixtureId(),
		timezone: getTimezone()
	},
	success: function(data) {
		let game = data[0];
		console.log(game);

		document.title = 'Foot-score | '+game.teams.home.name+' - '+game.teams.away.name+'';

		$('#fixtureData').attr('data-status', game.fixture.status.short);
		$('#fixtureData').attr('data-time', game.fixture.date);

		let fixture_head = fixtureHead(game);

		document.getElementById('fixture_head').innerHTML = fixture_head;

		generateButtons(game);

		let selectedButton = localStorage.getItem(`selectedButton${game.fixture.id}`);

		if (selectedButton === 'events') {
			eventsFixture(game);
		} else if (selectedButton === 'lineups') {
			lineupFixure(game.lineups);
		} else if (selectedButton === 'statistics') {
			statsFixture(game.statistics[0]);
		} else {
			eventsFixture(game);
		}
},
	error: function(data) {
		var errors = data.responseJSON;
		console.log(errors);
		let errorsHtml = '<div class="alert alert-danger mt-3">';
		errorsHtml += '<p>'+ errors.error + '</p>';
		errorsHtml += '</div>';

		$('#fixture_head').html(errorsHtml);
	}
	});
}

function generateButtons(fxtr) {
	
	let buttons = IsButtons(fxtr);

	document.getElementById('buttons').innerHTML = buttons;

	document.getElementById('buttons').addEventListener('click', function(event) {

		let activeButton = document.querySelector('.btn-primary');
		if (activeButton) {
			activeButton.classList.remove('btn-primary');
		}

		if (event.target.classList.contains('events')) {
			eventsFixture(fxtr);
			localStorage.setItem(`selectedButton${fxtr.fixture.id}`, 'events');
			event.target.classList.add('btn-primary');
		} else if (event.target.classList.contains('lineups')) {
			lineupFixure(fxtr.lineups);
			localStorage.setItem(`selectedButton${fxtr.fixture.id}`, 'lineups');
			event.target.classList.add('btn-primary');
		} else if (event.target.classList.contains('statistics')) {
			statsFixture(fxtr.statistics[0]);
			localStorage.setItem(`selectedButton${fxtr.fixture.id}`, 'statistics');
			event.target.classList.add('btn-primary');
		}
	});

	function IsButtons(fxtr) {
		let buttons = '';
	
		if(fxtr.events.length !== 0) {
			buttons += `<button class="btn events m-1 ${localStorage.getItem(`selectedButton${fxtr.fixture.id}`) === 'events' || !localStorage.getItem(`selectedButton${fxtr.fixture.id}`) ? 'btn-primary' : ''}">Events</button>`;
		};
	
		if(fxtr.lineups.length !== 0) {
			buttons += `<button class="btn lineups m-1 ${localStorage.getItem(`selectedButton${fxtr.fixture.id}`) === 'lineups' ? 'btn-primary' : ''}">Lineups</button>`;
		};
	
		if(fxtr.statistics.length !== 0) {
			buttons += `<button class="btn statistics m-1 ${localStorage.getItem(`selectedButton${fxtr.fixture.id}`) === 'statistics' ? 'btn-primary' : ''}">Statistics</button>`;
		};
	
		return buttons;
	}
}

function fixtureHead(game) {
	let fixture_head = '<div class="mt-2">'+
								'<div class="d-flex justify-content-between bg-light border border-bottom-0 b-t-r f-s-sml">'+
									'<div>'+
										'<span class="p-2 f-w-600 text-uppercase">'+
											'<a href="/standings/'+game.league.country+'/'+game.league.name+'" class="text-decoration-none">'+ game.league.country +': '+ game.league.name +'</a>'+
										'</span>'+
									'</div>'+
									'<div>'+
										'<span class="p-2 f-w-600 text-uppercase">'+ game.league.round +'</span>'+
									'</div>'+
								'</div>'+

								'<div class="d-flex justify-content-around border-start border-end">'+
									'<div class="d-flex flex-column mt-3">'+
										'<img src='+ game.teams.home.logo +' width="100" class="img-thumbnail">'+
										teamWinner(game.teams.home)+
									'</div>'+
									'<div class="d-flex flex-column mt-2">'+
										'<span class="text-center">'+ getDateFixture(game.fixture.date) +'</span>'+
										'<p class="text-center f-w-600 fs-3">'+ getFixtureGoals(game.goals) +'</p>'+
										'<span class="text-center">'+ getFixtureStatus(game.fixture.status) +'</span>'+
									'</div>'+
									'<div class="d-flex flex-column mt-3">'+
										'<img src='+ game.teams.away.logo +' width="100" class="img-thumbnail">'+
										teamWinner(game.teams.away)+
									'</div>'+
								'</div>'+
							'</div>';
	return fixture_head;

	function getFixtureGoals(goals) {
		if(goals.home !== null || goals.away !== null) {
			return goals.home +' - '+ goals.away;
		} else {
			return '-';
		}
	}

	function getFixtureStatus(status) {
		if(status.short == 'FT' || status.short == 'WO' || status.short == 'PST' || status.short == 'P' || status.short == 'ABD') {
			return status.long;
		}
		
		if(status.short == '1H' || status.short == 'HT' || status.short == '2H' || status.short == 'ET' || status.short == 'BT' || status.short == 'SUSP' || status.short == 'INT') {
			if(status.elapsed !== null) {
				return `${status.long} - ${status.elapsed}<span class="flicker">\'</span>`;
			} else {
				return status.long;
			}
		}
	
		if(status.short == 'TBD' || status.short == 'NS' || status.short == 'CANC') {
			return '';
		}
		if(status.short == 'LIVE') {
			return status.short;
		}
		if(status.short == 'PEN') {
			return 'Game finished after penalty';
		}
		if(status.short == 'AET') {
			return 'Game finished after extra time';
		}
	}

	function getDateFixture(un_sort_date) {
		let date = un_sort_date;
		let date_format = moment(date);
		return date_format.format("YYYY/MM/DD kk:mm");
	}
}

function eventsFixture(game) {
	$("#fixture_main").empty();
	let fixture_events;
	if(game.fixture.status.short == 'NS' || game.fixture.status.short == 'TBD') {
		fixture_events = '<p class="text-center m-0 p-1">The game has not started</p>';
		$("#fixture_main").append(fixture_events);
		getFixtureEventsFooter(game.fixture)
	}
	if(game.fixture.status.short == 'WO') {
		fixture_events = '<p class="text-center m-0 p-1">Victory by forfeit or absence of competitor</p>';
		$("#fixture_main").append(fixture_events);
		getFixtureEventsFooter(game.fixture)
	}
	if(game.fixture.status.short == '1H' || game.fixture.status.short == 'HT') {
		eventByHalf(game, 'before the game');
		eventByHalf(game, 'FIRST HALF', 'halftime');
		getFixtureEventsFooter(game.fixture)
	}
	if(game.fixture.status.short == '2H' || game.fixture.status.short == 'FT' || game.fixture.status.short == 'LIVE' || game.fixture.status.short == 'ABD') {
		eventByHalf(game, 'before the game');
		eventByHalf(game, 'FIRST HALF', 'halftime');
		eventByHalf(game, 'SECOND HALF', 'fulltime');
		getFixtureEventsFooter(game.fixture)
	}
	if(game.fixture.status.short == 'ET' || game.fixture.status.short == 'BT' || game.fixture.status.short == 'AET') {
		eventByHalf(game, 'before the game');
		eventByHalf(game, 'FIRST HALF', 'halftime');
		eventByHalf(game, 'SECOND HALF', 'fulltime');
		eventByHalf(game, 'EXTRA TIME', 'extratime');
		getFixtureEventsFooter(game.fixture)
	}
	if(game.fixture.status.short == 'P' || game.fixture.status.short == 'PEN') {
		eventByHalf(game, 'before the game');
		eventByHalf(game, 'FIRST HALF', 'halftime');
		eventByHalf(game, 'SECOND HALF', 'fulltime');
		eventByHalf(game, 'EXTRA TIME', 'extratime');
		eventByHalf(game, 'PENALTY SHOOTOUT', 'penalty');
		getFixtureEventsFooter(game.fixture)
	}
	if(game.fixture.status.short == 'CANC' || game.fixture.status.short == 'AWD' || game.fixture.status.short == 'INT' || game.fixture.status.short == 'SUSP'){
		fixture_events = `<div class="d-flex f-s-sml justify-content-center f-w-600">${game.fixture.status.long}<div>`;
		$("#fixture_main").append(fixture_events);
		getFixtureEventsFooter(game.fixture)
	}

	function eventByHalf(game, half, score_half) {
		let event_half = halfEventsHead(half, game.score[score_half])
		$("#fixture_main").append(event_half);
		if(game.events[0][half].length !== 0) {
			$.each(game.events[0][half], function() {
				let fixture_events = '<div class="d-flex f-s-sml '+ eventSide(game, this) +'">'+
									timeElapsed(this)+
									'<div class="p-1 icon '+ iconEvent(this) +'"></div>'+
									asistEvent(this)+
								'</div>';
				$("#fixture_main").append(fixture_events);
			});
		} else if(half !== 'before the game') {
			fixture_events = '<div class="d-flex f-s-sml justify-content-center">-<div>';
			$("#fixture_main").append(fixture_events);
		}
	}

	function asistEvent(event) {
		if(event.type == 'Card') {
			if( event.comments !== null) {
				return '<div class="p-1 f-w-600">'+ eventNull(event.player.name)+'</div>'+
						'<div class="pt-1">('+ eventNull(event.comments) +')</div>';
			} else {
				return '<div class="p-1 f-w-600">'+ eventNull(event.player.name)+'</div>';
			}
		}
		if(event.type == 'subst') {
			return '<div class="p-1 f-w-600">'+ eventNull(event.assist.name) +'</div>'+
					'<div class="pt-1">('+ eventNull(event.player.name)+')</div>';
		}
		if(event.type == 'Goal' && event.comments !== 'Penalty Shootout') {
			if(event.detail == 'Penalty') {
				return '<div class="p-1 f-w-600">'+ eventNull(event.player.name)+'</div>'+
						'<div class="pt-1">('+ eventNull(event.detail) +')</div>';
			}
			if(event.detail == 'Missed Penalty') {
				return '<div class="p-1 f-w-600">'+ eventNull(event.player.name)+'</div>';
			}
			if(event.assist.id !== null) {
				return '<div class="p-1 f-w-600">'+ eventNull(event.player.name)+'</div>'+
						'<div class="pt-1">('+ eventNull(event.assist.name) +')</div>';
			}
			if(event.detail == 'Own Goal') {
				return '<div class="p-1 f-w-600">'+ eventNull(event.player.name)+'</div>'+
						'<div class="pt-1">('+ eventNull(event.detail)  +')</div>';
			} else {
				return '<div class="p-1 f-w-600">'+ eventNull(event.player.name)+'</div>';
			}
		}
		if(event.comments == 'Penalty Shootout') {
			return '<div class="p-1 f-w-600">'+ eventNull(event.player.name)+'</div>';
		}
		if(event.type == 'Var') {
			if (event.detail.length !== 0) {
				return '<div class="p-1 f-w-600">'+ eventNull(event.player.name) +'</div>'+
					'<div class="pt-1">('+ eventNull(event.detail)+')</div>';
			} else {
				return '<div class="p-1 f-w-600">'+ eventNull(event.player.name) +'</div>';
			}
			
		}
		
		function eventNull(event) {
			if(event !== null) {
				return event;
			} else {
				return '';
			}
		}
	}

	function halfEventsHead(half, goals) {
		if(half == 'before the game') {
			return
		} else {
			return '<div class="d-flex justify-content-center bg-light f-s-sml">'+
						'<div>'+
							'<span class="p-1 f-w-600 text-uppercase">'+half+'</span>'+
						'</div>'+
						eventHeadGoals(goals)+
					'</div>';
		}
	}

	function eventHeadGoals(goals) {
		if(goals.home !== null && goals.away !== null) {
			return '<div>'+
						'<span class="p-1 f-w-600 text-uppercase">('+ goals.home+' - '+ goals.away+')</span>'+
					'</div>';
		} else {
			return '';
		}
	}

	function iconEvent(event) {
		if(event.detail == 'Normal Goal' || event.detail == 'Penalty') {
			return 'goal';
		};
		if(event.detail == 'Own Goal') {
			return 'own-goal';
		};
		if(event.detail == 'Missed Penalty') {
			return 'penalty-missed';
		};
		if(event.detail == 'Yellow Card') {
			return 'yellow-card';
		};
		if(event.detail == 'Red Card') {
			return 'red-card';
		};
		if(event.type == 'subst') {
			return 'substitution';
		}
		if(event.type == 'Var') {
			return 'var';
		}
		else return '';
		
	}

	function eventSide(game, event) {
		if(game.teams.home.id == event.team.id) {
			return 'flex-row';
		}
		if(game.teams.away.id == event.team.id) {
			return 'flex-row-reverse';
		} else return '';
	}

	function timeElapsed(event) {
		if(event.time.extra !== null && event.comments !== 'Penalty Shootout') {
			return '<div class="p-1">'+ event.time.elapsed +'+'+ event.time.extra +'\'</div>';
		} else {
			return '<div class="p-1">'+ event.time.elapsed +'\'</div>';
		}
	}

	function getFixtureEventsFooter(game) {
		let fixture_footer ='';
		if(game.referee == null && game.venue.name == null) {
			return '';
		} else {
			fixture_footer = '<div class="d-flex justify-content-center bg-light f-s-sml">'+
									'<span class="p-1 f-w-600 text-uppercase">INFORMATION ABOUT THE Game</span>'+
								'</div>';
			if(game.referee !== null) {
				fixture_footer += '<div class="d-flex justify-content-between f-s-sml">';
				fixture_footer += '<span class="p-1 f-w-600">Referee</span>';
				fixture_footer += `<span class="p-1 f-w-600 text-uppercase">${game.referee}</span></div>`;
			}
			if(game.venue.name !== null && game.venue.city !== null) {
				fixture_footer += '<div class="d-flex justify-content-between f-s-sml">';
				fixture_footer += '<span class="p-1 f-w-600">Stadium</span>';
				fixture_footer += `<span class="p-1 f-w-600 text-uppercase">${game.venue.name} (${game.venue.city})</span></div>`;
			} else {
				fixture_footer += '<div class="d-flex justify-content-between f-s-sml">';
				fixture_footer += '<span class="p-1 f-w-600">Stadium</span>';
				fixture_footer += `<span class="p-1 f-w-600 text-uppercase">${game.venue.name}</span></div>`;
			}
		}
	
		$("#fixture_main").append(fixture_footer);
	}
}

function lineupFixure(lineup) {
	let lineupHTML = '';

	if(lineup[0].formation !== null || lineup[1].formation !== null) {
		lineupHTML +=	'<div class="d-flex justify-content-evenly bg-light text-uppercase">'+
							'<div class="f-w-600">'+ lineup[0].formation +'</div>'+
							'<div>formation</div>'+
							'<div class="f-w-600">'+ lineup[1].formation +'</div>'+
						'</div>'+
						'<div class="d-flex justify-content-center">'+
							'<div class="football-field-section mt-2 mb-2">'+
								'<div class="football-field">'+
									'<div class="lineup">'+
										lineUpXI(lineup[0]['startXI'][0])+
									'</div>'+
									'<div class="lineup lineup-away">'+
										lineUpXI(lineup[1]['startXI'][0])+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>';
	}

	if(lineup[0].startXI !== undefined || lineup[1].startXI !== undefined) {
		lineupHTML +=	'<div class="d-flex justify-content-center bg-light f-w-600">STARTING LINEUPS</div>'+
							'<div class="startXI-section">'+
								'<div class="startXI">'+
									startingLineups(lineup[0].startXI)+
								'</div>'+
								'<div class="startXI-away">'+
									startingLineups(lineup[1].startXI)+
								'</div>'+
							'</div>';
	}

	if(lineup[0].substitutes !== undefined || lineup[1].substitutes !== undefined) {
		lineupHTML += 	'<div class="d-flex justify-content-center bg-light f-w-600">SUBSTITUTES</div>'+
						'<div class="startXI-section">'+
							'<div class="startXI">'+
								substitution(lineup[0].substitutes)+
							'</div>'+
							'<div class="startXI-away">'+
								substitution(lineup[1].substitutes)+
							'</div>'+
						'</div>';
	}

	if(lineup[0].coach !== undefined || lineup[1].coach !== undefined) {
		lineupHTML +=	'<div class="d-flex justify-content-center bg-light f-w-600">COACHES</div>'+
						'<div class="startXI-section">'+
							'<div class="startXI">'+
								coaches(lineup[0].coach)+
							'</div>'+
							'<div class="startXI-away">'+
								coaches(lineup[1].coach)+
							'</div>'+
						'</div>';
	}
	document.getElementById('fixture_main').innerHTML = lineupHTML;

	function lineUpXI(lineupXI) {
		let html_lineupXI = '';
		$.each(lineupXI, function(i) {
			if(lineupXI[i].length !== 0) {
				html_lineupXI += '<div>';
	
				$.each(lineupXI[i], function() {
					html_lineupXI += `<div class="player"><span class="player-name">${this.player.name}<span></div>`;
				});
	
				html_lineupXI += '</div>';
			}
		});
		return html_lineupXI;
	}

	function startingLineups(lineupXI) {
		let html_lineupXI = '';
		if(lineupXI.length== 11) {
			$.each(lineupXI, function() {
				html_lineupXI += '<div>'+
									'<span class="player-number">'+ this.player.number +'</span>'+
									'<span>'+ this.player.name +'</span>'+
								'</div>';
			});
		} else {
			$.each(lineupXI[0], function(i) {
				if(lineupXI[0][i].length !== 0) {
		
					$.each(lineupXI[0][i], function() {
						html_lineupXI += '<div>'+
											'<span class="player-number">'+ this.player.number +'</span>'+
											'<span>'+ this.player.name +'</span>'+
										'</div>';
					});
		
				}
			});
		}
		
		return html_lineupXI;
	}

	function substitution(subst) {
		let html_subst = '';
		$.each(subst, function() {
			html_subst += '<div>'+
								'<span class="player-number">'+ this.player.number +'</span>'+
								'<span>'+ this.player.name +'</span>'+
							'</div>';
		});
		return html_subst;
	}

	function coaches(coach) {
		if(coach.name !== null) {
			return coach.name;
		} else {
			return '';
		}
	}
}

function statsFixture(stats) {
	let stats_html = '';
	$.each(stats, function() {
		if(this.type !== 'Passes %' && this.type !== 'expected_goals') {
			if(this[0] !== null || this[1] !== null) {
				stats_html += 	'<div class="stats-section f-w-600">'+
									'<div class="stat-home">'+ isNullStat(this[0]) +'</div>'+
									'<div class="stat-name">'+ this.type +'</div>'+
									'<div class="stat-away">'+ isNullStat(this[1]) +'</div>'+
								'</div>'+
								'<div class="stat-line">'+
									'<div class="stat-line-home"><div style="width: '+statLinePercent(isNullStat(this[0]), isNullStat(this[1]), this.type)+'%"></div></div>'+
									'<div class="stat-line-away"><div style="width: '+statLinePercent(isNullStat(this[1]), isNullStat(this[0]), this.type)+'%"></div></div>'+
								'</div>';
			}
		}
	});
	document.getElementById('fixture_main').innerHTML = stats_html;

	function isNullStat(stat) {
		return stat !== null ? stat : 0;
	};

	function statLinePercent(stat_h, stat_a, type) {
		let width;
		if (type == 'Ball Possession') {
			width = stat_h.slice(0, -1);
		} else if(stat_h !== null || stat_a !== null) {
			width = (stat_h/(stat_h+stat_a))*100;
			
		} else {
			width = 0;
		}
		return Math.trunc(width);
	}
}

function refreshFixture() {
	let status = $('#fixtureData').attr('data-status');
	if(status == '1H' || status == 'HT' || status == '2H' || status == 'ET' || status == 'BT' || status == 'P' || status == 'SUSP' || status == 'INT' || status == 'LIVE') {
		setInterval(ajaxRequestFixture, 15000);// должно быть каждые 15 сек
	} else if(status == 'FT' || status == 'AET' || status == 'PEN' || status == 'PST' || status == 'CANC' || status == 'ABD' || status == 'AWD' || status == 'WO') {
		return
	} else {
		let fixture_date = $('#fixtureData').attr('data-time');
		let fixture_date_mill = moment(fixture_date, "YYYY-MM-DDTHH:mm:ZZ").valueOf();
		let date_mill = moment().valueOf();
		if((fixture_date_mill-date_mill) <= 3000000) {
			setInterval(ajaxRequestFixture, 500000);// должно быть каждые 15 сек
		}
		if((fixture_date_mill-date_mill) <= 7000000) {
			setInterval(ajaxRequestFixture, 600000);// должно быть каждые 10 мин
		} else {
			setInterval(ajaxRequestFixture, 800000);// должно быть каждые 30 мин
		}
	}
}

function getGoal(goal) {
	return goal !== null ? goal : '-';
}