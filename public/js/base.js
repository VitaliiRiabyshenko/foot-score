/* прокрутка страницы наверх */
var btn = $('#button-up');

$(window).scroll(function() {
	if ($(window).scrollTop() > 300) {
		btn.addClass('show');
	} else {
		btn.removeClass('show');
	}
});

btn.on('click', function(e) {
	e.preventDefault();
	$('html, body').animate({scrollTop:0}, '300');
});

document.getElementById("year").innerHTML = new Date().getFullYear();

/* function timezone */
function getTimezone() {
	var timezone_offset_minutes = new Date().getTimezoneOffset();
	timezone_offset_minutes = timezone_offset_minutes == 0 ? 0 : -timezone_offset_minutes;
	return timezone_offset_minutes;
}

/* team winner */
function teamWinner(team) {
	if(team.winner == true) {
		return `<span class="f-w-600 text-center p-1">${team.name}</span>`;
	}
	else {
		return `<span class="text-center p-1">${team.name}</span>`;
	}
}

function getGoal(goal) {
	return goal !== null ? goal : '-';
}