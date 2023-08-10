"use strict"

const REFRESH_TIME = 2000000;

getListDate();

$('#listDate').on('change', function() {
	var selectValue = $(this).val();
	var action = $('.nav-link.active').attr('data-action');
	initAction(action);
});

$(document).ready(function() {
	getFixturesByDate();
	$('.nav-link[data-action=all]').toggleClass('active');
	setInterval(getFixturesByDate, REFRESH_TIME);
	
});

$('.nav-link').on('click', function() {
	var action = $(this).attr('data-action');
	$('.nav-link').removeClass('active');
	$(this).toggleClass('active');

	initAction(action);
});

function initAction(action) {
	if (action == 'all') {
		getFixturesByDate();
		setInterval(getFixturesByDate, REFRESH_TIME);
		removeClassToListDate();
	}

	if (action == 'live') {
		getLiveFixtures();
		setInterval(getLiveFixtures, REFRESH_TIME);
		$("#listDate").addClass("invisible");
	}

	if (action == 'finished') {
		getFinishedFixtures();
		setInterval(getFinishedFixtures, REFRESH_TIME);
		removeClassToListDate()
	}

	if (action == 'scheduled') {
		getScheduledFixtures();
		setInterval(getScheduledFixtures, REFRESH_TIME);
		removeClassToListDate()
	}
}

function getFixturesByDate() {
	$.ajax({
	method: "GET",
	url: "fixturesByDate",
	data: {
		date: dateSelected(),
		timezone: getTimezone()
	},
	success: function(Fixtures) {
		$("#info").empty();
		if (Fixtures.length == 0) {
				$("#info").append('<h2>There are no matches today</h2>');
		} else {
			dataFixtures(Fixtures);
		}
	},
	error: function(data) {
		var errors = data.responseJSON;
		errorsHtml = '<div class="alert alert-danger"><ul>';
		$.each(errors.errors, function(k,v) {
			errorsHtml += '<p>'+ v + '</p>';
		});
		errorsHtml += '</div>';

		$('#info').html(errorsHtml);
	}
	});
};

function getLiveFixtures() {
	$.ajax({
	method: "GET",
	url: "live",
	data: {
		timezone: getTimezone()
	},
	success: function(liveFixtures) {
		$("#info").empty();
		if (liveFixtures.length == 0) {
				$("#info").append('<h2>There are no live matches</h2>');
		} else {
			dataFixtures(liveFixtures);
		}
	}
	});
};

function getFinishedFixtures() {
	$.ajax({
	method: "GET",
	url: "finishedFixtures",
	data: {
		date: dateSelected(),
		timezone: getTimezone()
	},
	success: function(Fixtures) {
		$("#info").empty();
		if (Fixtures.length == 0) {
				$("#info").append('<h2>There are no finished matches today</h2>');
		} else {
			dataFixtures(Fixtures);
		}
	},
	error: function(data) {
		var errors = data.responseJSON;
		errorsHtml = '<div class="alert alert-danger"><ul>';
		$.each(errors.errors, function(k,v) {
			errorsHtml += '<p>'+ v + '</p>';
		});

		$('#info').html(errorsHtml);
	}
	});
}

function getScheduledFixtures() {
	$.ajax({
	method: "GET",
	url: "scheduledFixtures",
	data: {
		date: dateSelected(),
		timezone: getTimezone()
	},
	success: function(fixtures) {
		$("#info").empty();
		if (fixtures.length == 0) {
				$("#info").append('<h2>There are no scheduled today</h2>');
		} else {
			dataFixtures(fixtures);
		}
	},
	error: function(data) {
		var errors = data.responseJSON;
		errorsHtml = '<div class="alert alert-danger"><ul>';
		$.each(errors.errors, function(k,v) {
			errorsHtml += '<p>'+ v + '</p>';
		});

		$('#info').html(errorsHtml);
	}
	});
}

function timeFixture(status, un_sort_date) {
	if((status.short == '1H') || (status.short == '2H') || (status.short == 'ET')) {
		if(status.elapsed == null) {
			return status.long;
		} else {
			return status.elapsed + '<span class="flicker">\'</span>';
		}
	} else if (status.short == 'NS' || status.short == 'PST') {
		let date = new Date(un_sort_date);
		let minute = date.getMinutes();
		let hour = date.getHours();
		minute = (minute < 10) ? '0' + minute : minute;
		hour = (hour < 10) ? '0' + hour : hour;
		return hour + ':' + minute;
	} else if (status.short == 'FT' || status.short == 'AET' || status.short == 'PEN') {
		return 'Finished';
	} else  {
		return status.long;
	}
};

function leagueFlag(flag) {
	if(flag == null) {
		return "dist/img/world.league.logo.png";
	} else {
		return flag;
	}
};

function getDayName(dateStr, locale) {
	let date = new Date(dateStr);
	return date.toLocaleDateString(locale, { weekday: 'short' });
};

function getListDate() {
	
	let curr = new Date();
	let date = new Date(curr.getTime() - 7 * 24 * 60 * 60 * 1000);
	let week = [];

	loopDateList(date)
	date = new Date(date.getTime());
	loopDateList(date)
	date = new Date(date.getTime());
	loopDateList(date)


	$.each(week, function(index){
		let option_date;
		if (curr.toISOString().slice(0, 10) == this.slice(0, 10)) {
			option_date = `<option value="${this.slice(0, 10)}" selected>Today</option>`;
		} else {
			option_date = `<option value="${this.slice(0, 10)}">${this.slice(5, 10)}  ${getDayName(this, "en-US")}</option>`;
		}
		$("#listDate").append(option_date);
	})

	function loopDateList(date) {
		for (let i = 1; i <= 7; i++) {
			let first = date.getDate() - date.getDay() + i;
			let day = new Date(date.setDate(first)).toISOString()
			week.push(day)
		}
	}
};

function dateSelected() {
	var selectDate = $('#listDate').val();
	return selectDate;
	$('#listDate').on('change', function() {
		var selectDate = $(this).val();
		return selectDate;
	});
};

function removeClassToListDate() {
	// показать date-picker
	$("#listDate").removeClass("invisible");
}

function dataFixtures(data) {
	$.each(data, function() {
			let leagues = '<div class="row m-1">'+
								'<div class="border border-success rounded-1">'+
									'<img src="' + leagueFlag(this.league.flag) +'" height="15" class="mb-1">'+
									'<span class="ms-1">'+
										'<a href="/standings/'+this.league.country+'/'+this.league.name+'" class="text-decoration-none text-black">'+ this.league.country +': '+ this.league.name +'</a>'
									'</span>'+
								'</div>';
			$("#info").append(leagues);
			$.each(this.fixtures, function() {
				let fixtures = '<a href="/match/'+ this.fixture.id +'" class="text-decoration-none text-black wd-600">'+
									'<div class="fixture pl-15 fixture-hover">'+
										'<div class="fixture-time">'+
											'<span>'+ timeFixture(this.fixture.status, this.fixture.date) +'</span>'+
										'</div>'+
										'<div class="fxt-team fxt-home">'+
											'<img src="'+ this.teams.home.logo +'" height="20">'+
											teamWinner(this.teams.home) +
											'<span class="home-goal">'+ getGoal(this.goals.home) +'</span>'+
										'</div>'+
										'<div class="fxt-team fxt-away">'+
											'<img src="'+ this.teams.away.logo +'" height="20">'+
											teamWinner(this.teams.away) +
											'<span class="away-goal">'+ getGoal(this.goals.away) +'</span>'+
										'</div>'+
									'</div>'
								'</a>'+
							'</div>';
			$("#info").append(fixtures);
			});
	});
};