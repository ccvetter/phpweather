@extends('layouts.master')

@section('content')
    <div>
        @if ($forecast)
            <h1>{{ $forecast["name"]}}</h1><br>
            <h3>Latitude: {{ $forecast["coord"]["lat"]}}, Longitude: {{ $forecast["coord"]["lon"] }}</h3><br>
            <div class="mt-30">
                <div class="card-group">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Weather</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                @foreach($forecast["weather"] as $w)
                                    {{ $w["main"] }}<br>
                                    {{ $w["description"] }}
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
                                Speed: {{ $forecast["wind"]["speed"] }}<br>
                                Direction: {{ convertDegreesToDirection($forecast["wind"]["deg"]) }}
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Temperature</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                {{ $forecast["main"]["temp"] }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @else 
            There is no forecast for that location 
        @endif
    </div>  
@stop