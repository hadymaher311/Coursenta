@extends('layouts.layout')
@section('title')
    Student Login
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('/css/animate.css') }}">
@endsection

@section('body')

	<div class="container">
		<div class="row align-items-center full" style="padding: 30px 0; visibility: hidden;">
			<div class="col-md-5 ml-auto mr-auto">
				@if (session('status'))
					<div class="card text-white bg-info mb-3" style="visibility: visible;">
				  		<div class="card-header wow">{{ session('status') }}</div>
					</div>
			  	@endif
			  	@if ($errors->has('status'))
					<div class="card text-white bg-danger mb-3" style="visibility: visible;">
				  		<div class="card-header wow">{{ $errors->first('status') }}</div>
					</div>
			  	@endif
				<h2 class="text-center wow fadeInRight">Students Login</h2>
				<form method="POST" action="{{ route('login') }}">
					{{ csrf_field() }}
					<div class="md-form wow fadeInLeft{{ $errors->has('username') ? ' has-error' : '' }}" data-wow-delay="0.5s">
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

					<div class="md-form wow fadeInRight{{ $errors->has('password') ? ' has-error' : '' }}" data-wow-delay="1s">
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
					
                    <div class="form-check wow fadeInLeft" data-wow-delay="1.5s">
					    <label class="form-check-label">
					      <input type="checkbox" name="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
					      Remember Me
					    </label>
					  </div>

					<a href="{{ route('password.request') }}" class="wow fadeInLeft" data-wow-delay="1.5s">Forget your password</a>

					<div class="text-center">
						<button type="submit" class="btn btn-purple wow fadeInLeft" data-wow-delay="1.5s">
							<i class="fa fa-sign-in" aria-hidden="true"></i> 
							Login
						</button>
						<a href="{{ route('professor.login') }}" class="btn btn-outline-purple wow fadeInRight" data-wow-delay="1.5s">
							<i class="fa fa-users" aria-hidden="true"></i> Professors
						</a>
					</div>

				</form>
			</div>
		</div>
	</div>

@endsection

@section('footer')

	<script src="{{ asset('/js/wow.min.js') }}"></script>
	<script>
		new WOW().init(); 
		$(".full").height($(window).height() - 116);
		$(window).on("resize", function() {
		    $(".full").height($(window).height() - 116);
		});
	</script>

@endsection