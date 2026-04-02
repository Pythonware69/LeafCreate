<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jakarta Map</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }


        #map {
            height: calc(100vh - 60px);
            width: 100%;
        }
    </style>

    @yield('styles')
</head>
<body>
    @include('components.navbar')

    @yield('content')

    {{-- Bootstrap CSS --}}
    <script src ="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kP1ALjHZA+PBrtT6L10o7MqxVnc" crossorigin="anonymous"></script>

    @yield('scripts')

    @include('components.toast')
</body>
</html>
