<!DOCTYPE html>
<html lang="en">

	<head>
		@include('Cms.include.head-login')
	</head>
	<body>

		<div class="login__background" style="background-image:url('{{URL::asset('themes/cms/images/bg-login.jpg')}}');">
      		<div class="login_wrapper">
        		<div class="animate form login_form">
                <div class="login__header">
                    <img src="{{ asset('themes/cms/svg/login.svg') }}" alt="Login CMS" class="login__header__logo">
                </div>
          			<section class="login_content">
              			<form role="form" method="POST" action="{{ route('authenticate') }}">
                				<h1>Login Form</h1>
                        @if (count($errors) > 0)
                              @foreach ($errors->all() as $error)
                                  <p class="error--state--message">{{ $error }}</p>
                              @endforeach
                        @else
                            <p>Please enter your username and password to login</p>
                        @endif
                				<div class="form-group">
                  				<input type="email" class="form-control" placeholder="Email" value="{{ old('email') }}" name="email" required="required" />
                				</div>
                				
                				<div class="form-group">
                  				<input type="password" class="form-control" placeholder="Password" name="password" required="required" />
                				</div>
                				<div>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <button class="btn__submit__login">Submit</button>
                        </div>
                  	</form>
          			</section>
        		</div>
        	</div>
      	</div>

	</body>
</html>