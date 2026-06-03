@extends('layouts.templatemap')

@section('styles')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-4">
        @guest
            <div class="alert alert-warning">
                <h4 class="alert-heading">You are not logged in</h4>
                <p>Please sign in with your name and password to unlock dashboard access and map editing features.</p>
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>
                @endif
            </div>
        @else
            <div class="alert alert-success d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="alert-heading">Welcome back, {{ auth()->user()->name }}!</h4>
                    <p class="mb-0">You are logged in and can explore the map, table, and dashboard.</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Log out</button>
                </form>
            </div>
        @endguest

        <div class="card">
        <div class="card-header">
            <h2>Hello, World!</h2>
        </div>
        <div class="card-body">
            <div class="table-controls">
                <div class="search-control">
                    <label for="search">Search:</label>
                    <input type="text" id="search" placeholder="">
                </div>
            </div class="card-body">
                <p>
                My name is Yoshikage Kira. I'm 33 years old.
                My house is in the northeast section of Morioh, where all the villas are, and I am not married.
                I work as an employee for the Kame Yu department stores, and I get home every day by 8 PM at the latest.
                I don't smoke, but I occasionally drink. I'm in bed by 11 PM, and make sure I get eight hours of sleep, no matter what.
                After having a glass of warm milk and doing about twenty minutes of stretches before going to bed, I usually have no problems sleeping until morning.
                Just like a baby, I wake up without any fatigue or stress in the morning. I was told there were no issues at my last check-up.
                I'm trying to explain that I'm a person who wishes to live a very quiet life.
                I take care not to trouble myself with any enemies, like winning and losing, that would cause me to lose sleep at night.
                That is how I deal with society, and I know that is what brings me happiness. Although, if I were to fight I wouldn't lose to anyone.
                </p>
            </div>
    <div class="container mt-5">
        <div class="text-center">
            <h1 class="display-4">{{ $title ?? 'Welcome' }}</h1>
            <p class="text-muted small mt-3">Welcome to the site — explore the map and data from the navigation.</p>

            <div class="d-flex justify-content-center gap-3 mt-4">
                <div class="border rounded p-3 text-center">
                    <div class="h5 mb-0">{{ $pointsCount ?? 0 }}</div>
                    <div class="small text-muted">Points</div>
                </div>
                <div class="border rounded p-3 text-center">
                    <div class="h5 mb-0">{{ $polylinesCount ?? 0 }}</div>
                    <div class="small text-muted">Polylines</div>
                </div>
                <div class="border rounded p-3 text-center">
                    <div class="h5 mb-0">{{ $polygonsCount ?? 0 }}</div>
                    <div class="small text-muted">Polygons</div>
                </div>
            </div>

            <a href="{{ route('peta') }}" class="btn btn-primary mt-4">View Map</a>
        </div>
    </div>
@endsection
