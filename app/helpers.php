<?php
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

function convertDegreesToDirection($degrees) {
	$directions = array('N', 'NNE', 'NE', 'ENE', 'E', 'ESE', 'SE', 'SSE', 'S', 'SSW', 'SW', 'WSW', 'W', 'WNW', 'NW', 'NNW', 'N');
	return $directions[round($degrees / 22.5)];
}

function getCurrentForecast() {
	return getForecast('currentForecast', 'weather');
}

function getDailyForecast() {
	return getForecast('dailyForecast', 'forecast/daily');
}

function getForecast($name, $route) {
	$minutes = 30;
	Log::info("Retrieving {$name}");
	return Cache::remember($name, $minutes, function() use ($route) {
		$forecast = null;
		Log::info("not from cache");
		$app_id = config("configs.app_id");
		$default_location = config("configs.default_location");
		$base_url = config("configs.api_base_url");
		$url = "{$base_url}{$route}";
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