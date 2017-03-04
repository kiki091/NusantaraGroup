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
      @include('Cms.include.vars')
  		@include('Cms.include.js_component')
		
  	</body>
</html>