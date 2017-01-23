    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $seo['meta_description'] or '' }}">
    <meta name="author" content="PT. Asia Resorce System">
    <meta name="meta_keywords" content="{{ $seo['meta_keyword'] or '' }}">
    <meta name="meta_title" content="{{ $seo['meta_title'] or '' }}">
    <meta name="meta_desctiprion" content="{{ $seo['meta_description'] or '' }}">

    <meta property="og:url"                content="http://www.nusantara-group.co.id/" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="{{ $landing_page['og_title'] or '' }}" />
    <meta property="og:site_name"          content="{{ $landing_page['site_name'] or '' }}" />
    <meta property="og:description"        content="{{ $landing_page['og_description'] or '' }}" />
    <meta property="og:image"              content="{{ $landing_page['og_images'] or '' }}" />
    <meta id="token" name="token" value="{{ csrf_token() }}">

    <title> {{ $landing_page['site_title'] or 'Nusantara Group' }} </title>

    <link href="{{asset('themes/front/shield/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('themes/front/shield/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('themes/front/shield/css/icomoon.css')}}" rel="stylesheet">
    <link href="{{asset('themes/front/shield/css/animate-custom.css')}}" rel="stylesheet">
    <link href="{{asset('themes/front/css/custom.css')}}" rel="stylesheet">

    <!-- Image Slider -->
    <link href="{{asset('themes/front/slider/css/slider-def.css')}}" rel="stylesheet">
    <!-- End Image Slider -->

    <!-- Javascript Animation -->
    <script type="text/javascript" src="{{asset('themes/front/animation/js/scrollreveal.js')}}"></script>
    <!-- End Javascript Animation -->
    
    <link rel="stylesheet" type="text/css" href="https://cloud.typography.com/6245934/7028772/css/fonts.css" />


    <!-- Anmasi Loading Page -->

    <link rel="stylesheet" href="{{asset('themes/front/animation/loading/css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('themes/front/animation/loading/css/main.css')}}">
    <script src="{{asset('themes/front/animation/loading/js/modernizr-2.6.2.min.js')}}"></script>

    <!-- End Anmasi Loading Page -->


    <!-- js file -->
    <script src="{{asset('themes/front/shield/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('themes/front/shield/js/modernizr.custom.js')}}"></script>
    <script src="{{asset('themes/front/js/respond.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bower_components/toastr/toastr.css')}}">
    <script type="text/javascript" src="{{asset('js/bower_components/toastr/toastr.min.js')}}"></script>

    <!-- <script type="text/javascript" src="{{ asset('themes/front/API/google-maps/style.js')}} "></script>

    <script>
        function initMap() {
            var uluru = {lat: -6.169557, lng: 106.819661};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: uluru
            });
            var marker = new google.maps.Marker({
                position: uluru,
                map: map
            });
        }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAr9WjGsW6KZ91tJl_hBfjaAAMco9dc0p4&callback=initMap">
    </script> -->

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAr9WjGsW6KZ91tJl_hBfjaAAMco9dc0p4&callback=initMap">
    </script>
        
        <script type="text/javascript">
            // When the window has finished loading create our google map below
            google.maps.event.addDomListener(window, 'load', initMap);
        
            function initMap() {
                // Basic options for a simple Google Map
                // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
                var mapOptions = {
                    // How zoomed in you want the map to start at (always required)
                    zoom: 15,

                    // The latitude and longitude to center the map (always required)
                    center: new google.maps.LatLng(-6.169557, 106.819661), // New York

                    // How you would like to style the map. 
                    // This is where you would paste any style found on Snazzy Maps.
                    styles: [{"featureType":"all","elementType":"all","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":-30}]},{"featureType":"all","elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"color":"#353535"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#656565"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#505050"}]},{"featureType":"poi","elementType":"geometry.stroke","stylers":[{"color":"#808080"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#454545"}]}]
                };

                // Get the HTML DOM element that will contain your map 
                // We are using a div with id="map" seen below in the <body>
                var mapElement = document.getElementById('map');

                // Create the Google Map using our element and options defined above
                var map = new google.maps.Map(mapElement, mapOptions);

                // Let's also add a marker while we're at it
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(-6.169557, 106.819661),
                    map: map,
                    title: 'Snazzy!'
                });
            }
        </script>