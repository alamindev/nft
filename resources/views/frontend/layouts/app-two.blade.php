<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title> @yield('title') || NFTalpha.net </title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
            @isset($iconlink)
                <link rel="icon" href="{{ url('storage'.$iconlink) }}">
            @endisset

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen " id="app">
            <main class="sm:h-screen bg-gray-100">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
