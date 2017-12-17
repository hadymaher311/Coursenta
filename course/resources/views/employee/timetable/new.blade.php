@extends('employee.layouts.app')

@section('title')
New Reservation
@endsection

@section('head')
	<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ asset('/employee_style/css/datepicker3.css') }}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{ asset('/employee_style/css/bootstrap-timepicker.min.css') }}">
@endsection

@section('content')

	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Reservations
      </h1>
    </section>
	<section class="content">
	      <div class="row">
	        <div class="col-xs-12">
    			<div class="box">
	            <div class="box-header">
	              <h3 class="box-title">Add new Reservation</h3>
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

                <form class="form-horizontal" action="{{ url('/employee/new/timetable') }}" method="POST">
                	{{ csrf_field() }}
                  <div class="form-group">
                    <label for="selectBranch" class="col-sm-3 control-label">Room</label>
                    <div class="col-sm-9">
                    <select class="form-control" name="room" required>
                      <option value="">Choose Room</option>
                      @foreach ($rooms as $room)
                        <?php $room = (object)$room; ?>
                        <option value="{{ $room->number }}">{{ $room->number }}</option>
                      @endforeach
                    </select>
                  </div>
                  </div>

                   <div class="form-group">
                    <label for="selectBranch" class="col-sm-3 control-label">Course</label>
                    <div class="col-sm-9">
                    <select class="form-control" name="course" required>
                      <option value="">Choose Course</option>
                      @foreach ($courses as $course)
                        <?php $course = (object)$course; ?>
                        <option value="{{ $course->code }}">{{ $course->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  </div>

                  <!-- Date -->
                  <div class="form-group">
                    <label class="col-sm-3 control-label">Date:</label>

                    <div class="col-sm-9">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" required name="date" id="datepicker" value="{{ old('date') }}">
                      </div>
                    </div>
                    <!-- /.input group -->
                  </div>

                  <!-- time Picker -->
                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Start Time:</label>

                      <div class="col-sm-9">
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                          <input type="text" name="start_time" required class="form-control timepicker" value="{{ old('start_time') }}">

                        </div>
                      </div>
                      <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                  </div>

                  <!-- time Picker -->
                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      <label class="col-sm-3 control-label">End Time:</label>

                      <div class="col-sm-9">
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                          <input type="text" name="end_time" required class="form-control timepicker" value="{{ old('end_time') }}">

                        </div>
                      </div>
                      <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
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
<!-- bootstrap datepicker -->
<script src="{{ asset('/employee_style/js/bootstrap-datepicker.js') }}"></script>
<!-- bootstrap time picker -->
<script src="{{ asset('/employee_style/js/bootstrap-timepicker.min.js') }}"></script>
<script>
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false,
      showMeridian: false
    });
</script>
@endsection
