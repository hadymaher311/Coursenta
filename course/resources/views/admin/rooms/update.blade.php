@extends('admin.layouts.app')

@section('title')
Update Room
@endsection

@section('head')
	<!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('/admin_style/css/all.css') }}">
@endsection

@section('content')

	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Rooms
      </h1>
    </section>
	<section class="content">
	      <div class="row">
	        <div class="col-xs-12">
    			<div class="box">
	            <div class="box-header">
	              <h3 class="box-title">Update Room</h3>
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

                <form class="form-horizontal" action="{{ url('/admin/rooms/' . $room->number . '/edit/' . $room->branch_code) }}" method="POST">
                	{{ csrf_field() }}
                  {{ method_field('PATCH') }}
                  <div class="form-group">
                    <label for="inputNumber" class="col-sm-3 control-label">Number</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="inputNumber" placeholder="Room Number" value="{{ $room->number }}" required name="number">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputCapacity" class="col-sm-3 control-label">Capacity</label>

                    <div class="col-sm-9">
                      <input type="tel" class="form-control" id="inputCapacity" placeholder="Capacity" value="{{ $room->capacity }}" required name="capacity">
                    </div>
                  </div>

                  <!-- radio -->
                  <div class="form-group">
                    <label for="inputCapacity" class="col-sm-3 control-label">AC</label>
                    <div class="col-sm-9">
                      <label class="text-success col-sm-3">
                        <input type="radio" name="AC" class="minimal-green" required value="1" @if ($room->AC)
                          {{ 'checked' }}
                        @endif>
                        Yes
                      </label>
                      <label class="text-danger col-sm-3">
                        <input type="radio" name="AC" class="minimal-red" required value="0" @if (!$room->AC)
                          {{ 'checked' }}
                        @endif>
                        No
                      </label>
                    </div>
                  </div>

                  <!-- radio -->
                  <div class="form-group">
                    <label for="inputCapacity" class="col-sm-3 control-label">Projector</label>
                    <div class="col-sm-9">
                      <label class="text-success col-sm-3">
                        <input type="radio" name="projector" class="minimal-green" required value="1" @if ($room->projector)
                          {{ 'checked' }}
                        @endif>
                        Yes
                      </label>
                      <label class="text-danger col-sm-3">
                        <input type="radio" name="projector" class="minimal-red" required value="0" @if (!$room->projector)
                          {{ 'checked' }}
                        @endif>
                        No
                      </label>
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
  
  <!-- iCheck 1.0.1 -->
  <script src="{{ asset('/admin_style/js/icheck.min.js') }}"></script>

  <script>
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-green, input[type="radio"].minimal-green').iCheck({
      checkboxClass: 'icheckbox_minimal-green',
      radioClass: 'iradio_minimal-green'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_minimal-green'
    });
  </script>
@endsection
