@extends('layouts.layout')
@section('title')
    Student Login
@endsection

@section('head')

@endsection

@section('body')

	<div class="container">
		<div class="row align-items-center full" style="padding: 100px 0 30px;">
			<div class="col-md-5 ml-auto mr-auto">
				<h2 class="text-center">Students Sign up</h2>
				<form method="POST" action="{{ route('register') }}">
					{{ csrf_field() }}
					<div class="md-form{{ $errors->has('username') ? ' has-error' : '' }}">
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

					<div class="md-form{{ $errors->has('name') ? ' has-error' : '' }}">
					    <i class="fa fa-user prefix"></i>
					    <input type="text" id="form" class="form-control validate" name="name" value="{{ old('name') }}">
					    <label for="form" data-error="
							@if ($errors->has('name'))
								{{ $errors->first('name') }}
							@else
								{{ 'Enter valid name' }}
							@endif
					    " data-success="right">Name</label>
					</div>

					<div class="md-form{{ $errors->has('email') ? ' has-error' : '' }}">
					    <i class="fa fa-envelope prefix"></i>
					    <input type="email" id="form2" class="form-control validate" value="{{ old('email') }}" name="email">
					    <label for="form2" data-error="
							@if ($errors->has('email'))
								{{ $errors->first('email') }}
							@else
								{{ 'Enter valid email' }}
							@endif
					    " data-success="right">Email</label>
					</div>

					<div class="md-form{{ $errors->has('password') ? ' has-error' : '' }}">
					    <i class="fa fa-lock prefix"></i>
					    <input type="password" id="form10" class="form-control validate" name="password">
					    <label for="form10" data-error="
							@if ($errors->has('password'))
								{{ $errors->first('password') }}
							@else
								{{ 'password must be more than 6 characters' }}
							@endif
					    " data-success="right">Password</label>
					</div>

					<div class="md-form">
					    <i class="fa fa-lock prefix"></i>
					    <input type="password" id="form5" class="form-control validate" name="password_confirmation">
					    <label for="form5" data-error="password must be more than 6 characters" data-success="right">Comfirm Password</label>
					</div>

					<div class="text-center">
						<button type="submit" class="btn btn-purple">
							<i class="fa fa-sign-in" aria-hidden="true"></i> 
							Sign up
						</button>
						<a href="#" class="btn btn-outline-purple">
							<i class="fa fa-users" aria-hidden="true"></i> Professors
						</a>
					</div>

				</form>
			</div>
		</div>
	</div>

@endsection

@section('footer')

@endsection