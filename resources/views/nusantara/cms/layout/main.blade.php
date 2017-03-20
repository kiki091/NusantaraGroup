<!DOCTYPE html>
<html lang="en">
  	<head>
  	@include('nusantara.cms.include.head')
  	</head>

  	<body class="nav-md fixed">
      @include('nusantara.cms.include.notify')
  		<div class="container body">
      		<div class="main_container">
        			@include('nusantara.cms.include.sidebar')
        			@include('nusantara.cms.include.top-bar')
              <div class="main__wrapper__content">
                  <div class="right_col" role="main">
      				      @yield('content')
                  </div>
              </div>
  			   </div>
  		</div>
      <div id="custom_notifications" class="custom-notifications dsp_none">
          <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
          </ul>
          <div class="clearfix"></div>
          <div id="notif-group" class="tabbed_notifications"></div>
      </div>
      @include('nusantara.cms.include.vars')
  		@include('nusantara.cms.include.js_component')
		  @section('scripts')
      @show
  	</body>
</html>