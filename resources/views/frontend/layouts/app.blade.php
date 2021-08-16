<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title> @yield('title') || {{ config('app.name', 'Laravel') }} </title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @isset($iconlink)
        <link rel="icon" href="{{ url('storage'.$iconlink) }}">
        @endisset
        @stack('styles')
    </head>
    <body class="font-sans antialiased">
        <div class="" id="app">
            @include('frontend.partials.header')
            <main class="min-h-screen  bg-gray-100">
                {{ $slot }}
            </main>
            @include('frontend.partials.footer')
        </div>
         <!-- Scripts -->
         <script src="{{ asset('js/jquery.min.js') }}"></script>
         <script src="{{ asset('js/app.js') }}"></script>
         <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8" defer></script>
         @include('sweetalert::alert')
         @stack('scripts')
    </body>
</html>
