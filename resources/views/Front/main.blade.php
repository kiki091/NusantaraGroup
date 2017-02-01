<!DOCTYPE html>
<html lang="en">

	<head>
		@include('Front.Includes.head')
	</head>
	<body data-spy="scroll" data-offset="0" data-target="#navbar-main">
		<div id="demo-content">
	    
	    <div id="loader-wrapper">
			<div id="loader"></div>

			<div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>

		</div>
		<div id="content">
		    <!-- *** NAVBAR *** -->
			@include('Front.Includes.navbar')
		    <!-- *** NAVBAR END *** -->
		    
			<!-- *** CONTENT *** -->
		    @yield('content')
			<!-- *** CONTENT END *** -->
			</div>

			<!-- *** FOOTER *** -->
			@include('Front.Includes.footer')
			<!-- /#all -->
		</div>
		<script src="{{asset('themes/front/js/jquery-1.11.0.min.js')}}"></script>
	    
	    <script type="text/javascript" src="{{asset('themes/front/shield/js/bootstrap.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('themes/front/shield/js/retina.js')}}"></script>
		<script type="text/javascript" src="{{asset('themes/front/shield/js/jquery.easing.1.3.js')}}"></script>
	    <script type="text/javascript" src="{{asset('themes/front/shield/js/smoothscroll.js')}}"></script>
		<script type="text/javascript" src="{{asset('themes/front/shield/js/jquery-func.js')}}"></script>

	    <!-- Start Vue Js Component -->
	    <script src="{{asset('js/vue.js')}}"></script>
	    <script src="{{asset('js/vue-min.js')}}"></script>
	    <script src="{{asset('js/vue-resource.js')}}"></script>
    	<script src="{{asset('themes/front/content/booking-service.js')}}"></script>
    	<script src="{{asset('themes/front/content/footer.js')}}"></script>
	    
	    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="{{asset("themes/front/animation/loading/js/jquery-1.9.1.min.js")}}"><\/script>')</script>
		<script src="{{asset('themes/front/animation/loading/js/main.js')}}"></script>

	</body>
</html>