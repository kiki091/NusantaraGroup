<!DOCTYPE html>
<html lang="en">

	<head>
		@include('Cms.include.head-login')
	</head>
	<body class="login">

		<div>
      		<a class="hiddenanchor" id="signup"></a>
      		<a class="hiddenanchor" id="signin"></a>

      		<div class="login_wrapper">
        		<div class="animate form login_form">
          			<section class="login_content">
            			<form role="form" method="POST" action="{{ route('authenticate') }}">
              				<h1>Login Form</h1>

              				<div class="form-group">
                				<input type="email" class="form-control" placeholder="Email" value="{{ old('email') }}" name="email" required="required" />
              					<div class="form--error--message" id="form--error--message--email">
	              					{{ $errors->has('email') ? ' Invalid Email' : '' }}
	              				</div>
              				</div>
              				
              				<div class="form-group">
                				<input type="password" class="form-control" placeholder="Password" name="password" required="required" />
                				<div class="form--error--message" id="form--error--message--email">
	              					{{ $errors->has('password') ? ' Invalid Password' : '' }}
	              				</div>
              				</div>
              				
              				<div>
                				{{ csrf_field() }}
                				<button class="btn btn-default submit">Log in</button>
              				</div>
                		</form>
          			</section>
        		</div>
        	</div>
      	</div>

	</body>
</html>