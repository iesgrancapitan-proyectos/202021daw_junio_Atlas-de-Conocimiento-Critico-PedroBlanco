<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Atlas de Conocimiento Crítico') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        @bukStyles

        <x-load-leaflet></x-load-leaflet>

        <style>
            #map { height: 400px; }
        </style>

        @stack('css')

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Atlas de Conocimiento Crítico') }}
                    </h2>
                </div>
            </header>

            <div class="py-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg space-y-4 p-6">
                        @livewire('search')
                </div>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div id="map"></div>
                </div>
            </div>
        </div>


        @stack('modals')

        @livewireScripts

        @bukScripts

        <x-init-leaflet></x-init-leaflet>

        @stack('scripts')
    </body>
</html>
