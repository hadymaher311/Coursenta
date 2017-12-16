@extends('layouts.layout')
@section('title')
    Employee Login
@endsection

@section('head')

@endsection

@section('body')

	<div class="container">
		<div class="row align-items-center full" style="padding: 30px 0;">
			<div class="col-md-5 ml-auto mr-auto">
				@if (session('status'))
					<div class="card text-white bg-info mb-3">
				  		<div class="card-header">{{ session('status') }}</div>
					</div>
			  	@endif
			  	@if ($errors->has('status'))
					<div class="card text-white bg-danger mb-3">
				  		<div class="card-header">{{ $errors->first('status') }}</div>
					</div>
			  	@endif
				<h2 class="text-center">Employees Login</h2>
				<form method="POST" action="{{ route('employee.login') }}">
					{{ csrf_field() }}
					<div class="md-form{{ $errors->has('username') ? ' has-error' : '' }}" data-wow-delay="0.5s">
					    <i class="fa fa-user prefix"></i>
					    <input type="text" id="form9" class="form-control validate" name="username" value="{{ old('username') }}">
					    <label for="form9" data-error="
							@if ($errors->has('username'))
								{{ $errors->first('username') }}
							@else
								{{ 'Enter valid username' }}
							@endif
					    " data-success="right">Username</label>
					</div>

					<div class="md-form{{ $errors->has('password') ? ' has-error' : '' }}" data-wow-delay="1s">
					    <i class="fa fa-lock prefix"></i>
					    <input type="password" id="form10" class="form-control validate" name="password">
					    <label for="form10" data-error="
							@if ($errors->has('password'))
								{{ $errors->first('password') }}
							@else
								{{ 'Password must be more than 6 characters' }}
							@endif
					    " data-success="right">Password</label>
					</div>
					
                    <div class="form-check">
					    <label class="form-check-label">
					      <input type="checkbox" name="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
					      Remember Me
					    </label>
					  </div>

					<a href="{{ route('employee.password.request') }}">Forget your password</a>

					<div class="text-center">
						<button type="submit" class="btn btn-purple">
							<i class="fa fa-sign-in" aria-hidden="true"></i> 
							Login
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>

@endsection

@section('footer')

	<script>
		$(".full").height($(window).height() - 116);
		$(window).on("resize", function() {
		    $(".full").height($(window).height() - 116);
		});
	</script>

@endsection