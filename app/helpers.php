<?php
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

function convertDegreesToDirection($degrees) {
	$directions = array('N', 'NNE', 'NE', 'ENE', 'E', 'ESE', 'SE', 'SSE', 'S', 'SSW', 'SW', 'WSW', 'W', 'WNW', 'NW', 'NNW', 'N');
	return $directions[round($degrees / 22.5)];
}

function getCurrentForecast() {
	$minutes = 30;
	Log::info("Retrieving current forecast");
	return Cache::remember('currentForecast', $minutes, function () {
		$forecast = null;
		Log::info("Current not from cache");
		$app_id = config("here.app_id");
		$default_location = config("here.default_location");
		$url = 'https://api.openweathermap.org/data/2.5/weather';
		$query = ['q' => $default_location, 'appid' => $app_id, 'units' => 'imperial'];
		$res = Http::get($url, $query);

		if ($res->status() == 200) {
			$obj = $res->body();
			$forecast = json_decode($obj, true);
		}

		return $forecast;
	});
}

function getDailyForecast() {
	$minutes = 30;
	Log::info("Retrieving daily forecast");
	return Cache::remember('dailyForecast', $minutes, function() {
		$forecast = null;
		Log::info("Daily not from cache");
		$app_id = config("here.app_id");
		$default_location = config("here.default_location");
		$url = 'https://api.openweathermap.org/data/2.5/forecast/daily';
		$query = ['q' => $default_location, 'appid' => $app_id, 'units' => 'imperial'];
		$res = Http::get($url, $query);
		Log::info($res->status());
		if ($res->status() == 200) {
			$obj = $res->body();
			Log::info($res);
			$forecast = json_decode($obj, true);
		}

		return $forecast;
	});
}

?>