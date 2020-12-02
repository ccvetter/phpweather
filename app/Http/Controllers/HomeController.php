<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $minutes = 30;
        Log::info("Retrieving forecast");
        $forecast = Cache::remember('forecast', $minutes, function () {
            $weather = null;
            Log::info("Not from cache");
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

        return view('forecast', ["forecast" => $forecast]);
    }
}