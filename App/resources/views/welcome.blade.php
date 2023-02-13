<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page</title>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <style>
        .text-center {
            text-align: center;
        }
        #map {
            height: 400px;
        }
    </style>
</head>

<body>
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    @if (Route::has('login'))
        <div class="sm:mb-0 self-center">
            @auth
                <a href="{{ url('/home') }}" class="text-md no-underline text-grey-darker hover:text-blue-dark ml-2 px-1">Home</a>
            @else
                <a href="{{ route('login') }}" class="text-md no-underline text-grey-darker hover:text-blue-dark ml-2 px-1">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-md no-underline text-grey-darker hover:text-blue-dark ml-2 px-1">Register</a>
                @endif
            @endauth
        </div>
    @endif
</div><br>

<div class="container mt-5">
    <h2>Google Map</h2>
    <div id="map"></div>
</div>

{{--<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async></script>--}}
{{--<script>--}}
{{--    let map, activeInfoWindow, markers = [];--}}

{{--    /* ----------------------------- Initialize Map ----------------------------- */--}}
{{--    function initMap() {--}}
{{--        map = new google.maps.Map(document.getElementById("map"), {--}}
{{--            center: {--}}
{{--                lat: 28.626137,--}}
{{--                lng: 79.821603,--}}
{{--            },--}}
{{--            zoom: 15--}}
{{--        });--}}

{{--        map.addListener("click", function(event) {--}}
{{--            mapClicked(event);--}}
{{--        });--}}

{{--        initMarkers();--}}
{{--    }--}}

{{--    /* --------------------------- Initialize Markers --------------------------- */--}}
{{--    function initMarkers() {--}}
{{--        const initialMarkers = <?php echo json_encode($initialMarkers); ?>;--}}

{{--        for (let index = 0; index < initialMarkers.length; index++) {--}}

{{--            const markerData = initialMarkers[index];--}}
{{--            const marker = new google.maps.Marker({--}}
{{--                position: markerData.position,--}}
{{--                label: markerData.label,--}}
{{--                draggable: markerData.draggable,--}}
{{--                map--}}
{{--            });--}}
{{--            markers.push(marker);--}}

{{--            const infowindow = new google.maps.InfoWindow({--}}
{{--                content: `<b>${markerData.position.lat}, ${markerData.position.lng}</b>`,--}}
{{--            });--}}
{{--            marker.addListener("click", (event) => {--}}
{{--                if(activeInfoWindow) {--}}
{{--                    activeInfoWindow.close();--}}
{{--                }--}}
{{--                infowindow.open({--}}
{{--                    anchor: marker,--}}
{{--                    shouldFocus: false,--}}
{{--                    map--}}
{{--                });--}}
{{--                activeInfoWindow = infowindow;--}}
{{--                markerClicked(marker, index);--}}
{{--            });--}}

{{--            marker.addListener("dragend", (event) => {--}}
{{--                markerDragEnd(event, index);--}}
{{--            });--}}
{{--        }--}}
{{--    }--}}

{{--    /* ------------------------- Handle Map Click Event ------------------------- */--}}
{{--    function mapClicked(event) {--}}
{{--        console.log(map);--}}
{{--        console.log(event.latLng.lat(), event.latLng.lng());--}}
{{--    }--}}

{{--    /* ------------------------ Handle Marker Click Event ----------------------- */--}}
{{--    function markerClicked(marker, index) {--}}
{{--        console.log(map);--}}
{{--        console.log(marker.position.lat());--}}
{{--        console.log(marker.position.lng());--}}
{{--    }--}}

{{--    /* ----------------------- Handle Marker DragEnd Event ---------------------- */--}}
{{--    function markerDragEnd(event, index) {--}}
{{--        console.log(map);--}}
{{--        console.log(event.latLng.lat());--}}
{{--        console.log(event.latLng.lng());--}}
{{--    }--}}
{{--</script>--}}


<script type="text/javascript">
    function initMap() {
        const myLatLng = { lat: 41.3396503, lng: 69.2053274 };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 5,
            center: myLatLng,
        });

        new google.maps.Marker({
            position: myLatLng,
            map,
            title: "Hello SalikhovR!",
        });
    }

    window.initMap = initMap;
</script>

<script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap" ></script>

</body>
</html>


