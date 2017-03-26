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

    <title>Error</title>
    <link href="{{asset('themes/front/shield/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('themes/front/shield/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('themes/front/shield/css/icomoon.css')}}" rel="stylesheet">
    <link href="{{asset('themes/front/shield/css/animate-custom.css')}}" rel="stylesheet">
    <link href="{{asset('themes/front/css/custom.css')}}" rel="stylesheet">

    <!-- Image Slider -->
    <link href="{{asset('themes/front/slider/css/slider-def.css')}}" rel="stylesheet">
    <!-- End Image Slider -->

    <!-- Carousel With Side Caption Style -->
    <link href="{{asset('themes/front/carousel/style/slider.css')}}" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{asset('themes/front/carousel/js/slider.js')}}"></script>
    <!-- End Carousel With Side Caption Style -->

    <!-- Javascript Animation -->
    <script type="text/javascript" src="{{asset('themes/front/animation/js/scrollreveal.js')}}"></script>
    <!-- End Javascript Animation -->
    


    <!-- Anmasi Loading Page -->

    <link rel="stylesheet" href="{{asset('themes/front/animation/loading/css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('themes/front/animation/loading/css/main.css')}}">
    <script src="{{asset('themes/front/animation/loading/js/modernizr-2.6.2.min.js')}}"></script>

    <!-- End Anmasi Loading Page -->


    <!-- Javascript file -->
    <!-- <script src="{{asset('themes/front/shield/js/jquery.min.js')}}"></script> -->
    <script type="text/javascript" src="{{asset('themes/front/shield/js/modernizr.custom.js')}}"></script>
    <script src="{{asset('themes/front/js/respond.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bower_components/toastr/toastr.css')}}">
    <script type="text/javascript" src="{{asset('js/bower_components/toastr/toastr.min.js')}}"></script>

    <script type="text/javascript">
        (function() {
            var link = document.createElement('link');
            link.rel = "stylesheet";
            link.href = "//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700";
            document.querySelector("head").appendChild(link);
        })();
    </script>

    <!-- Main Gallery -->

    <script src="{{asset('themes/front/gallery/js/rbootstrap.min.js')}}"></script>
    <link href="{{asset('themes/front/gallery/css/effects.css')}}" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet" media="all">

    <!-- End Main Gallery -->

    <!-- Main Banner JS -->

    <script src="{{asset('themes/front/slider/slider.js')}}"></script>
    <link href="{{asset('themes/front/slider/slider.css')}}" rel="stylesheet">