<!DOCTYPE html>
<html lang="en">
  	<head>
  	@include('Cms.include.head')
  	</head>

  	<body class="nav-md">
      @include('Cms.include.notify')
  		<div class="container body">
      		<div class="main_container">
        			@include('Cms.include.sidebar')
        			@include('Cms.include.top-bar')
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
      @include('Cms.include.vars')
  		@include('Cms.include.js_component')
		
  	</body>
</html>