@extends('layouts.master')

@section('content')
    <div>
        @if ($currentForecast)
            <h1>{{ $currentForecast["name"]}}</h1> <h5>{{ date("F j Y, g:i a", $currentForecast["dt"]) }}<h5><br>
            <h3>Latitude: {{ $currentForecast["coord"]["lat"]}}, Longitude: {{ $currentForecast["coord"]["lon"] }}</h3><br>
            <div class="mt-10">
                <h5>Current Weather</h5>
            </div>
            <div>
                <div class="card-group">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Weather</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                @foreach($currentForecast["weather"] as $w)
                                    <img src="http://openweathermap.org/img/w/{{ $w['icon'] }}.png">
                                    {{ $w["main"] }} - {{ $w["description"] }}
                                @endforeach
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Wind</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                Speed: {{ $currentForecast["wind"]["speed"] }} mph<br>
                                Direction: {{ convertDegreesToDirection($currentForecast["wind"]["deg"]) }}
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Temperature</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                Temperature: {{ $currentForecast["main"]["temp"] }}<span>&#8457;</span><br>
                                Feels Like: {{ $currentForecast["main"]["feels_like"] }}<span>&#8457;</span><br>
                                Humidity: {{ $currentForecast["main"]["humidity"] }}%
                            </p>
                        </div>
                    </div>
                </div>
            </div><br>
            <div>
                <h5>Daily Forecast</h5>
            </div>
            <div>
                @foreach($dailyForecast["list"] as $daily)
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">{{ date('F j', $daily["dt"]) }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                @foreach($daily["weather"] as $w)
                                    <img src="http://openweathermap.org/img/w/{{ $w['icon'] }}.png">
                                    {{ $w["main"] }} - {{ $w["description"] }}<br>
                                @endforeach
                                High: {{ $daily["temp"]["max"] }}<span>&#8457;</span><br>
                                Low: {{ $daily["temp"]["min"] }}<span>&#8457;</span>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else 
            There is no forecast for that location 
        @endif
    </div>  
    <script type="text/javascript">
        setTimeout(function(){
            location.reload();
        },1805000);
    </script>
@stop