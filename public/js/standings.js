"use strict"

ajaxRequestStandings();

setInterval(ajaxRequestStandings, 2700000);

function ajaxRequestStandings() {
	const {league_id, season, type} = getFixtureData();
	$.ajax({
		method: "GET",
		url: "/standings",
		data: {
			league: league_id,
			season: season,
			type: type
		},
		success: function(data) {
			console.log(data);

			document.title = 'Foot-score | '+data[0].league.country+': '+data[0].league.name+'';

			let header_html = 	'<div><img src="'+data[0].league.logo+'" class="rounded" width="100px" style="margin:5px"></div>'+
								'<div class="mt-3">'+
									'<h3>'+data[0].league.country+': '+data[0].league.name+'</h3>'+
									'<span>'+data[0].league.season+'</span>'+
								'</div>';
			document.getElementById('league_header').innerHTML = header_html;

			generateButtons(data[0].league.standings, data[0].type, data[0].league.id);

			let selectedButton = localStorage.getItem(`selectedButton${data[0].league.id}`);

			if (selectedButton === 'all') {
				StandingsAllHTML(data[0].league.standings, data[0].type);
			} else if (selectedButton === 'home') {
				StandingsHmAwHtml(data[0].league.standings, data[0].type, 'home');
			} else if (selectedButton === 'away') {
				StandingsHmAwHtml(data[0].league.standings, data[0].type, 'away');
			} else {
				StandingsAllHTML(data[0].league.standings, data[0].type);
				let btn =  document.getElementsByClassName('btn all');
			}
		},
		error: function(data) {
			$("#league_header").empty();
			$("#standings").empty();
			var errors = data.responseJSON;
			let errorsHtml = '<div class="alert alert-danger mt-3">';
			errorsHtml += '<p>'+ errors.error + '</p>';
			errorsHtml += '</div>';

			$('#standings').html(errorsHtml);
		}
	})
}

function generateButtons(standings, type, id) {
	
	let buttons = StandingsBtn(standings[0], id);

	document.getElementById('buttons').innerHTML = buttons;

	document.getElementById('buttons').addEventListener('click', function(event) {

		let activeButton = document.querySelector('.btn-primary');
		if (activeButton) {
			activeButton.classList.remove('btn-primary');
		}

		if (event.target.classList.contains('all')) {
			StandingsAllHTML(standings, type);
			localStorage.setItem(`selectedButton${id}`, 'all');
			event.target.classList.add('btn-primary');
		} else if (event.target.classList.contains('home')) {
			StandingsHmAwHtml(standings, type, 'home');
			localStorage.setItem(`selectedButton${id}`, 'home');
			event.target.classList.add('btn-primary');
		} else if (event.target.classList.contains('away')) {
			StandingsHmAwHtml(standings, type, 'away');
			localStorage.setItem(`selectedButton${id}`, 'away');
			event.target.classList.add('btn-primary');
		}
	});

	function isBtnHomeAway(standings) {
		return standings.every(obj => obj.home.draw !== null && obj.home.lose !== null && obj.home.played !== null && obj.away.draw !== null && obj.away.lose !== null && obj.away.played !== null);
	}

	function StandingsBtn(stnd, id) {
		let standings_btn_html = '';

		let selectedButton = localStorage.getItem(`selectedButton${id}`);

		let btn = isBtnHomeAway(stnd);

		if(btn !== false) {
			standings_btn_html += '<div class="m-3">';
			standings_btn_html += 	`<button class="btn all ${localStorage.getItem(`selectedButton${id}`) === 'all' || !localStorage.getItem(`selectedButton${id}`) ? 'btn-primary' : ''}">ALL</button>`;
			standings_btn_html += 	`<button class="btn home ${localStorage.getItem(`selectedButton${id}`) === 'home' ? 'btn-primary' : ''}">HOME</button>`;
			standings_btn_html += 	`<button class="btn away ${localStorage.getItem(`selectedButton${id}`) === 'away' ? 'btn-primary' : ''}">AWAY</button>`;
			standings_btn_html += '</div>';
		} else {
			standings_btn_html += '<div class="m-3">';
			standings_btn_html += 	`<button class="btn all ${localStorage.getItem(`selectedButton${id}`) === 'all' || !localStorage.getItem(`selectedButton${id}`) ? 'btn-primary' : ''}">ALL</button>`;
			standings_btn_html += '</div>';
		};

		return standings_btn_html;
	}
}

function StandingsHmAwHtml(stnd, type, side) {
	
	let standings_html = '';

	standings_html += StandingsTableHmAw(stnd, type);

	document.getElementById('standings').innerHTML = standings_html;

	function StandingsTableHmAw(stnd, type) {
		let standings_html = '';

		if(type == 'League') {
			standings_html += tableHeaderHmAw('TEAM');

			$.each(stnd[0], function() {
				standings_html += tableMainHmAw(this, side);
			});
			standings_html += '</table></div></div>';
		};
		if(type == 'Cup') {
			$.each(stnd, function(i) {
				standings_html += tableHeaderHmAw(getCommonGroup(stnd[i]));
				
				$.each(stnd[i], function() {
					standings_html += tableMainHmAw(this, side);
				});
				standings_html += '</table></div></div>';
			});
		};
		return standings_html;
	}
	
	function tableHeaderHmAw(title) {
		return '<div class="table-scroll">'+
								'<div class="wrapper">'+
										'<table class="table table-striped mt-4">'+
										'<thead>'+
											'<tr>'+
												'<th class="sticky-col number-col" title="Rank">#</th>'+
												'<th class="sticky-col team-col" title="Team">'+title+'</th>'+
												'<th title="Games played">GP</th>'+
												'<th title="Wins">W</th>'+
												'<th title="Draws">D</th>'+
												'<th title="Losses">L</th>'+
												'<th title="Goals">G</th>'+
											'</tr>'+
										'</thead>';
	}

	function tableMainHmAw(item, side) {
		return	'<tr>'+
					'<td class="sticky-col number-col" '+teamTitle(item.description)+'>'+ item.rank +'</td>'+
					'<td class="sticky-col team-col">'+
						'<img src="'+ item.team.logo +'" height="23px" style="margin-right: 3px; max-width:35px">'+
						'<span>'+ item.team.name +'</span>'+
					'</td>'+
					'<td>'+ item[side].played +'</td>'+
					'<td>'+ item[side].win +'</td>'+
					'<td>'+ item[side].draw +'</td>'+
					'<td>'+ item[side].lose +'</td>'+
					'<td>'+ item[side].goals.for +':'+ item[side].goals.against +'</td>'+
				'</tr>';
	}
}

function StandingsAllHTML(stnd, type) {

	let standings_html = '';

	standings_html += StandingsTableAll(stnd, type);

	document.getElementById('standings').innerHTML = standings_html;

	function StandingsTableAll(stnd, type) {
		let standings_html = '';

		if(type == 'League') {
			standings_html += tableHeaderAll('TEAM');

			$.each(stnd[0], function() {
				standings_html += tableMainAll(this);
			});
			standings_html += '</table></div></div>';
		};
		if(type == 'Cup') {
			$.each(stnd, function(i) {
				standings_html += tableHeaderAll(getCommonGroup(stnd[i]));
				
				$.each(stnd[i], function() {
					standings_html += tableMainAll(this);
				});
				standings_html += '</table></div></div>';
			});
		};
		return standings_html;

	
		function tableHeaderAll(title) {
			return '<div class="table-scroll">'+
									'<div class="wrapper">'+
											'<table class="table table-striped mt-4">'+
											'<thead>'+
												'<tr>'+
													'<th class="sticky-col number-col" title="Rank">#</th>'+
													'<th class="sticky-col team-col" title="Team">'+title+'</th>'+
													'<th title="Games played">GP</th>'+
													'<th title="Wins">W</th>'+
													'<th title="Draws">D</th>'+
													'<th title="Losses">L</th>'+
													'<th title="Goals">G</th>'+
													'<th title="Points">P</th>'+
													'<th title="Form">FORM</th>'+
												'</tr>'+
											'</thead>';
		}

		function tableMainAll(team) {
			return	'<tr>'+
						'<td class="sticky-col number-col" '+teamTitle(team.description)+'>'+ team.rank +'</td>'+
						'<td class="sticky-col team-col">'+
							'<img src="'+ team.team.logo +'" height="23px" style="margin-right: 3px; max-width:35px">'+
							'<span>'+ team.team.name +'</span>'+
						'</td>'+
						'<td>'+ team.all.played +'</td>'+
						'<td>'+ team.all.win +'</td>'+
						'<td>'+ team.all.draw +'</td>'+
						'<td>'+ team.all.lose +'</td>'+
						'<td>'+ team.all.goals.for +':'+ team.all.goals.against +'</td>'+
						'<td>'+ team.points +'</td>'+
						'<td><div class="stn-form">'+ splitStringByChar(team.form) +'</div></td>'+
					'</tr>';
		}

		function splitStringByChar(str) {
			let arrByChar = str.split('');

			let arrByCharHTML = '';
			$.each(arrByChar, function() {
				if (this == 'W') {
					arrByCharHTML += `<span class="form-icon stn-win">${this}</span>`;
				}
				if (this == 'D') {
					arrByCharHTML += `<span class="form-icon stn-draw">${this}</span>`;
				}
				if (this == 'L') {
					arrByCharHTML += `<span class="form-icon stn-lose">${this}</span>`;
				}
				
			});
			return arrByCharHTML;
		}
	}


}

function getCommonGroup(array) {
	if (!array.length) return 'Team';

	let firstGroup = array[0].group;
	for (let i = 1; i < array.length; i++) {
		if (array[i].group !== firstGroup) {
		return 'Team';
		}
	}
	return firstGroup;
}

function teamTitle(title) {
	if(title !== null) {
		return `title="${title}"`;
	} else { return '';}
}