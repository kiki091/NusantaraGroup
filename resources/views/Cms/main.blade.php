<!DOCTYPE html>
<html lang="en">
  	<head>
  	@include('Cms.include.head')
  	</head>

  	<body class="nav-md">
  		<div class="container body">
      		<div class="main_container">
      			@include('Cms.include.sidebar')
      			@include('Cms.include.top-bar')
  				@yield('content')

  				<footer>
				    <div class="pull-right">
				        Admin Template by @AsiaSystem Group
				    </div>
				    <div class="clearfix"></div>
				</footer>
  			</div>
  		</div>

  		<!-- jQuery -->
	    <script src="{{ asset('themes/cms/vendors/jquery/dist/jquery.min.js') }}"></script>
	    <!-- Bootstrap -->
	    <script src="{{ asset('themes/cms/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	    <!-- FastClick -->
	    <script src="{{ asset('themes/cms/vendors/fastclick/lib/fastclick.js') }}"></script>
	    <!-- NProgress -->
	    <script src="{{ asset('themes/cms/vendors/nprogress/nprogress.js') }}"></script>
	    <!-- jQuery custom content scroller -->
	    <script src="{{ asset('themes/cms/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>

	    <!-- Custom Theme Scripts -->
	    <script src="{{ asset('themes/cms/build/js/custom.min.js') }}"></script>

  	</body>
</html>