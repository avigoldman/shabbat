
$location = null, $zip = null, $lightingDate = null, $lightingTime = null, $havdalahTime = null, $parashat = null, $weatherMin = null, $weatherMax = null;

$search = null, $loading = null;

var skycons = new Skycons({"color": "white"});
skycons.add("skycon", Skycons.CLEAR_DAY);

function getData(zip, f) {
	var url = './get_data.php';

	if (zip != null)
		url += '?zip='+zip;

	$.ajax({
		url: url,
	})
	.done(function(data) {
		f(JSON.parse(data));
	})
	.fail(function() {
		console.log("error");
	});
}

function parseData(data) {
	var returnData = {
		location: data['location']['city'],
		zip:      data['location']['zip'],
		weather:  data['weather']
	};

	var items = data['items'];

	for (var i = 0; i < items.length; i++) {
		switch (items[i]['category']) {
			case "candles":
			  returnData['lighting-time'] = items[i]["title"].substring(17); // offset to time
			  returnData['lighting-date'] = formatDate(items[i]["date"]);
			  break;
			case "havdalah":
		    returnData['havdalah-time'] = items[i]["title"].substring(19); // offset to time
		    break;
		  case "parashat":
				returnData['parashat'] = items[i]["title"].substring(9);
				break;
		}
	}



	return returnData;
}

function populateData(data) {
	var data = parseData(data);

	console.log(data);

	$location    .text(data['location']);
	$zip         .text(data['zip']);
	$lightingDate.text(data['lighting-date']);
	$lightingTime.text(data['lighting-time']);
	$havdalahTime.text(data['havdalah-time']);
	$parashat    .text(data['parashat']);

	skycons.set("skycon", data['weather']['icon']);
	skycons.play();

	$weatherMin.text(Math.round(data['weather']['min']));
	$weatherMax.text(Math.round(data['weather']['max']));


	setSize();

	loadingBox('hide');
}

function formatDate(string) {
	var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	var date = new Date(string);

	return MONTHS[date.getMonth()] + " " + date.getDate() + ", " + date.getFullYear();
}

function setSize() {
	$("#content").height($(window).height() - $("#top").outerHeight());
}

function loadingBox(action) {
	switch (action) {
		case "show":
			$loading.fadeIn();
			break;
		case "hide":
			$loading.fadeOut();
			break;
	}
}

function searchBox(action, message) {
	var $message = $search.find('#message');
	switch (action) {
		case "show":
			$search.fadeIn();
			break;
		case "hide":
			$message.animate({opacity: 0});
			$search.fadeOut();
			break;
		case "message":
			$message.text(message);
			$message.animate({opacity: 0});
			$message.animate({opacity: 1});
			break;
	}
}

function isValidZipCode(zip) {
	return /^[0-9]{5}$/.test(zip);
}

$(document).ready(function() {

	$location     = $("#location");
	$zip          = $("#zip");
	$lightingDate = $("#lighting-date");
	$lightingTime = $("#lighting-time");
	$havdalahTime = $("#havdalah-time");
	$parashat     = $("#parashat");

	$weatherMin     = $("#weather-min");
	$weatherMax     = $("#weather-max");

	$search       = $("#search");
	$loading       = $("#loading");

	setSize();

	var $searchBox = $("#search input[name=search]");

	// LOAD INITIAL DATA
	getData(null, populateData);


	// OPEN SEARCH
	$("#top").click(function() {
		searchBox('show');
	});

	// SERACH
	$("#search-form").submit(function(event) {
		event.preventDefault();

		var zip = $searchBox.val();

		console.log(zip);
		if (isValidZipCode(zip)) {
			loadingBox('show');
			searchBox('hide');
			getData(zip, populateData);
		}
		else {
			searchBox('message', 'Please enter a valid US zip code');
		}
	});

	$("#search #close").click(function(event) {
		event.preventDefault();
		searchBox('hide');
	});


	// credit - https://css-tricks.com/snippets/jquery/done-resizing-event/
	var resizeTimer;

	$(window).on('resize', function(e) {

	  clearTimeout(resizeTimer);
	  resizeTimer = setTimeout(function() {
	  	setSize();
	  }, 250);

	});
});