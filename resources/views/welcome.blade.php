<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Clash Cloud') }}</title>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script>
            window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'appUrl' => env('APP_URL'),
            'apiUrl' => env('APP_URL') . '/api'
        ]) !!};
        </script>
    </head>
    <body>
        <div id="app"></div>
        <div id="loader"><span>Loading...</span></div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
