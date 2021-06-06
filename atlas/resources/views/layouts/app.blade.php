<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles
        @bukStyles

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>

        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

        <style>
            #map { height: 400px; }
        </style>

        @stack('css')

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        @bukScripts
        <script>
            // center of the map
            var center = [37.46335,-4.575648];

            // Create the map
            var map = L.map('map').setView(center, 6.5);

            // Set up the OSM layer
            L.tileLayer(
                'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18
                }).addTo(map);

            // add a marker in the given location
            //L.marker(center).addTo(map);

            // Initialise the FeatureGroup to store editable layers
            var editableLayers = new L.FeatureGroup();
            map.addLayer(editableLayers);

            // define custom marker
            var MyCustomMarker = L.Icon.extend({
                options: {
                shadowUrl: null,
                iconAnchor: new L.Point(12, 12),
                iconSize: new L.Point(24, 24),
                iconUrl: 'https://upload.wikimedia.org/wikipedia/commons/6/6b/Information_icon4_orange.svg'
                }
            });

            var drawPluginOptions = {
                position: 'topright',
                draw: {
                polyline: {
                    shapeOptions: {
                    color: '#f357a1',
                    weight: 10
                    }
                },
                polygon: {
                    allowIntersection: false, // Restricts shapes to simple polygons
                    drawError: {
                    color: '#e1e100', // Color the shape will turn when intersects
                    message: '<strong>Polygon draw does not allow intersections!<strong> (allowIntersection: false)' // Message that will show when intersect
                    },
                    shapeOptions: {
                    color: '#bada55'
                    }
                },
                circle: false, // Turns off this drawing tool
                rectangle: {
                    shapeOptions: {
                    clickable: false
                    }
                },
                marker: {
                    icon: new MyCustomMarker()
                }
                },
                edit: {
                featureGroup: editableLayers, //REQUIRED!!
                remove: false
                }
            };





            // Initialise the draw control and pass it the FeatureGroup of editable layers
            var drawControl = new L.Control.Draw(drawPluginOptions);
            map.addControl(drawControl);


            var editableLayers = new L.FeatureGroup();
            map.addLayer(editableLayers);




            map.on('draw:created', function(e) {
                var type = e.layerType,
                layer = e.layer;

                if (type === 'marker') {
                layer.bindPopup('A popup!');
                }

                editableLayers.addLayer(layer);
            });

        </script>

        @stack('scripts')
    </body>
</html>
