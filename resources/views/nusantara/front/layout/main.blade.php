<!DOCTYPE html>
<html lang="en">

	<head>
		@include('nusantara.front.include.head')
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
			@include('nusantara.front.include.navbar')
		    <!-- *** NAVBAR END *** -->
		    
			<!-- *** CONTENT *** -->
		    @yield('content')
			<!-- *** CONTENT END *** -->

			<!-- *** FOOTER *** -->
			@include('nusantara.front.include.footer')
			<!-- /#all -->
			<div class="dmtop" id="back-to-top" style="bottom: 25px;">Scroll to Top</div>
		</div>
		<script type="text/javascript">
			if ($('#back-to-top').length) {
			    var scrollTrigger = 100, // px
			        backToTop = function () {
			            var scrollTop = $(window).scrollTop();
			            if (scrollTop > scrollTrigger) {
			                $('#back-to-top').addClass('show');
			            } else {
			                $('#back-to-top').removeClass('show');
			            }
			        };
			    backToTop();
			    $(window).on('scroll', function () {
			        backToTop();
			    });
			    $('#back-to-top').on('click', function (e) {
			        e.preventDefault();
			        $('html,body').animate({
			            scrollTop: 0
			        }, 700);
			    });
			}
		</script>
	    
    	<script type="text/javascript" src="{{ asset('js/jquery.form.js') }}"></script>
		<script type="text/javascript" src="{{asset('themes/front/shield/js/retina.js')}}"></script>
		<script type="text/javascript" src="{{asset('themes/front/shield/js/jquery.easing.1.3.js')}}"></script>
	    <script type="text/javascript" src="{{asset('themes/front/shield/js/smoothscroll.js')}}"></script>

	    <!-- Start Vue Js Component -->
	    <script src="{{asset('js/vue/1.x/vue.js')}}"></script>
	    <script src="{{asset('js/vue/1.x/vue-min.js')}}"></script>
	    <script src="{{asset('js/vue/1.x/vue-resource.js')}}"></script>
    	<script src="{{asset('themes/front/content/booking-service.js')}}"></script>
    	<script src="{{asset('themes/front/content/booking-test-drive.js')}}"></script>
    	<script src="{{asset('themes/front/content/footer.js')}}"></script>
	    
		<script>window.jQuery || document.write('<script src="{{asset("themes/front/animation/loading/js/jquery-1.9.1.min.js")}}"><\/script>')</script>
		<script src="{{asset('themes/front/animation/loading/js/main.js')}}"></script>

	</body>
</html>