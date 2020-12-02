<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $currentForecast = getCurrentForecast();
        $dailyForecast = getDailyForecast();

        return view('forecast', [
            "currentForecast" => $currentForecast,
            "dailyForecast" => $dailyForecast
        ]);
    }
}