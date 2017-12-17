@extends('employee.layouts.app')

@section('title')
    Employee Home Page
@endsection

@section('head')

<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ asset('/employee_style/css/datepicker3.css') }}">

@endsection

@section('content')
<!-- Site wrapper -->
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        TimeTable
    </section>

    <!-- Main content -->
    <section class="content">

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ url('employee/timetable') }}" method="POST">
            {{ csrf_field() }}
            <div class="row">
            <!-- Date -->
              <div class="form-group col-sm-6">
                <label>Date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="date" id="datepicker">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
                <div class="form-group col-sm-6">
                    <label></label>
                    <div class="input-group">
                        <button class="btn bg-purple">Get Timetable</button>
                        <a href="{{ url('/employee/new/timetable') }}" class="btn btn-success pull-right btn-flat" style="margin-left: 20px;">Add New Reservation</a>
                    </div>
                </div>
          </div>
      </form>


      <!-- row -->
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    @if (empty($timetables))
                        {{ $thisDate->toFormattedDateString() }}    
                    @else
                        {{ \Carbon\Carbon::createFromTimestamp(strtotime($timetables[0]['start_date']))->toFormattedDateString() }}
                    @endif
                  </span>
            </li>
            <!-- /.timeline-label -->
            @foreach ($timetables as $timetable)
            <?php $timetable = (object) $timetable; ?>
            <!-- timeline item -->
            <li>
              <i class="fa fa-calendar bg-purple"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> to {{ \Carbon\Carbon::createFromTimestamp(strtotime($timetable->end_date))->toTimeString() }}</span>
                <span class="time"><i class="fa fa-clock-o"></i> From {{ \Carbon\Carbon::createFromTimestamp(strtotime($timetable->start_date))->toTimeString() }}</span>

                <h3 class="timeline-header no-border"><strong>Room {{ $timetable->room_number }}</strong> has <strong>{{ $timetable->course_name }}</strong> Course</h3>
              </div>
            </li>
            <!-- END timeline item -->
            @endforeach

            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
          </ul>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
    </div>
    <strong>Copyright &copy; 2017-{{ Carbon\Carbon::now()->year }} <a href="{{ url('/') }}">{{ config('app.name') }}</a>.</strong> All rights
    reserved.
  </footer>


  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
@endsection

@section('footer')
<!-- bootstrap datepicker -->
<script src="{{ asset('/employee_style/js/bootstrap-datepicker.js') }}"></script>
<script>
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
</script>

@endsection
