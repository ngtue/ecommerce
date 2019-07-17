<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel-Ecommerce v1.0 | @yield('title', '')</title>

        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"> -->
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/main.css">
        @yield('extra-css')
    </head>
    <body class="font-sans">
        @include('layouts.nav')
        <main>
            @yield('content')
        </main>
        @include('layouts.footer')
        @yield('extra-js')
    </body>
</html>