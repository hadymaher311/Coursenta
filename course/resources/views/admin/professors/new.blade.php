@extends('admin.layouts.app')

@section('title')
New Professor
@endsection

@section('head')

@endsection

@section('content')

	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Professors
      </h1>
    </section>
	<section class="content">
	      <div class="row">
	        <div class="col-xs-12">
    			<div class="box">
	            <div class="box-header">
	              <h3 class="box-title">Add new Professor</h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
	              @foreach ($errors->all() as $error)
					<div class="alert alert-danger col-sm-9 col-sm-offset-3">{{ $error }}</div>
				@endforeach

				@if (session('error'))
				    <div class="alert alert-danger col-sm-9 col-sm-offset-3">
				        {{ session('error') }}
				    </div>
				@endif

                <form class="form-horizontal" action="{{ url('/admin/new/professor') }}" method="POST">
                	{{ csrf_field() }}
                  <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Username</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="inputName" placeholder="Username" value="" required name="username">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="inputName" placeholder="Name" value="" required name="name">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">Email</label>

                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="" required name="email">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputMobile" class="col-sm-3 control-label">Mobile Number</label>

                    <div class="col-sm-9">
                      <input type="tel" class="form-control" id="inputMobile" placeholder="Mobile Number" value="" required name="mobile">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputField" class="col-sm-3 control-label">Field</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="inputField" placeholder="Field" value="" required name="field">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputAddress" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="inputAddress" placeholder="Address" value="" name="address">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-3 control-label">Password</label>

                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="inputSkills" placeholder="Password" required name="password">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputPassword" class="col-sm-3 control-label">Confirm Password</label>

                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="inputPassword" placeholder="Confirm Password" required  name="password_confirmation">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                      <button type="submit" class="btn bg-purple">Submit</button>
                    </div>
                  </div>
                </form>
	            </div>
	            <!-- /.box-body -->
	          </div>
	          <!-- /.box -->
	      </div>
	  </div>
	</section>

</div>

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
    </div>
    <strong>Copyright &copy; 2014-{{ Carbon\Carbon::now()->year }} <a href="{{ url('/') }}">{{ config('app.name') }}</a>.</strong> All rights
    reserved.
  </footer>

@endsection

@section('footer')

@endsection
