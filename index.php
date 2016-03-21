<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title>What time does Shabbat start?</title>
		<link rel="stylesheet" href="./style.css">
	</head>
	<body>
		<div id="loading">
			<div class="vertical-center text-center">
				<div>
					<div class="loader">Loading...</div>
				</div>
			</div>
		</div>
		<div id="top">
			<span id="location" class="h1">Loading...</span> <span id="zip"></span>
			<div id="lighting-date" class="muted">date</div>
			<div id="top-icon">+</div>
		</div>
		<div id="content">
			<div class="container">
				<div class="col-9">
					<div class="row-5 bg-primary-dark mobile-full">
						<div class="col-6">
							<div class="vertical-center text-center">
								<div>
									<span id="lighting-time" class="h2"></span>
									<div class="muted h6">Lighting Time</div>
								</div>
							</div>
						</div>
						<div class="col-6">
							<div class="vertical-center text-center">
								<div>
									<span id="havdalah-time" class="h2"></span>
									<div class="muted h6">Havdalah Time</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row-7 bg-primary mobile-full">
						<div class="col-12">
							<div class="row-6 h4">
								<div class="vertical-center text-center">
									<div>
										<span class="muted">Parashat</span> <span id="parashat"></span>
									</div>
								</div>
							</div>
							<div class="row-6">
								<div class="vertical-center text-center">
									<div>
										<a class="btn" href="http://shabbat.com" target="_blank">Find a Shabbat Meal</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-3">
					<div class="row-12 bg-primary-light mobile-full">
						<div class="vertical-center">
							<div>
								<div class="h4 muted">Weather</div>
								<div>
									<canvas id="skycon"></canvas>
								</div>
								<div class="h5">
									<span id="weather-min"></span>
									-
									<span id="weather-max"></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="search">
			<button id="close">&times;</button>
			<form class="vertical-center" id="search-form">
				<div>
					<div class="h3">Search by ZIP Code</div>
					<div>
						<input type="number" name="search" value=""  autocomplete="off">
						<button id="submit"><img src="search.svg"></button>
					</div>
					<div id="message" style="opacity: 0;">Message</div>
				</div>
			</form>
		</div>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="./skycons.js"></script>
		<script src="./script.js"></script>
	</body>
</html>