<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App Title -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- CONSTANT CSS JS FILES, FONTS -->
    @include('constant/head')
    @yield('additives')
</head>
<body>
    <div id="app" class="maindiv">
        @include('constant/navigationBar') <!-- Navigation Bar -->
        <main class="py-4">
            @yield('content')
        </main>
    </div>
         @include('constant/footer')
</body>
</html>
