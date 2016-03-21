<?php
	
	function get_ip() {
		return $_SERVER['REMOTE_ADDR'];
	}

	function get_zipcode($ip) {
		$text = file_get_contents('http://ip-api.com/json/' . $ip);
		$json = json_decode($text, true);

		return $json['zip'];
	}

	function get_jewish_data($zipcode) {
		$text = file_get_contents('http://www.hebcal.com/shabbat/?cfg=json&geo=zip&zip=' . $zipcode);

		$json = json_decode($text, true);

		return $json;
	}

	function get_weather_data($lat, $long, $time) {
		$text = file_get_contents('https://api.forecast.io/forecast/830e2c560210a81acaa6006c016429b3/' . $lat . ',' . $long . ',' . $time);

		$json = json_decode($text, true);

		return $json['daily']['data'][0];
	}

	if (isset($_GET['zip'])) {
		$zip = $_GET['zip'];
	}
	else {
		$ip = get_ip();
		$zip = get_zipcode($ip);
	}

	$jewish_data = get_jewish_data($zip);

	$weather_data = get_weather_data($jewish_data['location']['latitude'], $jewish_data['location']['longitude'], strtotime("next saturday"));

	$jewish_data['weather'] = array(
		'icon' => $weather_data['icon'],
		'min' => $weather_data['temperatureMin'],
		'max' => $weather_data['temperatureMax']);


	// $jewish_data['weather'] = array(
	// 	'icon' => 'rain',
	// 	'min' => 0,
	// 	'max' => 0);


	echo json_encode($jewish_data);
?>