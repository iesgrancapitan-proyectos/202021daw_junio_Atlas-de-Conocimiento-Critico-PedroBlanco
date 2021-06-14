<script>
    // center of the map
    var center = [37.46335,-4.575648];

    // Create the map
    var map = L.map('map').setView(center, 6.5);

    // Default icon
    var default_icon = L.icon({
        iconAnchor: new L.Point(12, 12),
        iconSize: new L.Point(24, 24),
        iconUrl: 'img/Atom_negativo_rosa_circulo_24.png'
    });

    // Include OpenStreeMap attribution
    var my_attribution = '&copy; Colaboradores de <a href="https://www.openstreetmap.org/" target="_blank" rel="noreferrer noopener">OpenStreetMap</a>';

    map.attributionControl.addAttribution(my_attribution);

    // Set up the OSM layer
    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attibution: my_attribution,
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
        // iconUrl: 'https://upload.wikimedia.org/wikipedia/commons/6/6b/Information_icon4_orange.svg'
        iconUrl: 'img/Atom_negativo_rosa_circulo_24.png'
        }
    });

    var drawPluginOptions = {
        position: 'topright',
        draw: {

        polyline: false,
{{--
        // polyline: {
        //     shapeOptions: {
        //     color: '#f357a1',
        //     weight: 10
        //     }
        // },
--}}
        polygon: false, // Turns off this drawing tool
{{--
        // polygon: {
        //     allowIntersection: false, // Restricts shapes to simple polygons
        //     drawError: {
        //     color: '#e1e100', // Color the shape will turn when intersects
        //     message: '<strong>Polygon draw does not allow intersections!<strong> (allowIntersection: false)' // Message that will show when intersect
        //     },
        //     shapeOptions: {
        //     color: '#bada55'
        //     }
        // },
--}}
        circle: false, // Turns off this drawing tool
        rectangle: false,
{{--
        // rectangle: {
        //     shapeOptions: {
        //     clickable: false
        //     }
        // },
--}}
        // marker: false,

        marker: {
            icon: new MyCustomMarker()
        }

        },
        edit: false
{{--
        // edit: {
        // featureGroup: editableLayers, //REQUIRED!!
        // remove: false
        // }
--}}
    };

    // Initialise the draw control and pass it the FeatureGroup of editable layers
//   var drawControl = new L.Control.Draw(drawPluginOptions);
//   map.addControl(drawControl);

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
