@extends('employee.layouts.app')

@section('title')
Room stats
@endsection

@section('head')
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
	              @foreach ($errors->all() as $error)
        					<div class="alert alert-danger col-sm-9 col-sm-offset-3">{{ $error }}</div>
        				@endforeach

        				@if (session('error'))
        				    <div class="alert alert-danger col-sm-9 col-sm-offset-3">
        				        {{ session('error') }}
        				    </div>
        				@endif

          
          <!-- AREA CHART -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Room {{ $timetables[0]['number'] }} stats</h3>

              <form action="{{ url('/employee/room/stats') }}" method="POST" class="inline-form">
              {{ csrf_field() }}
              <div class="form-group">
                <div class="col-sm-9">
                  <select class="form-control" name="room" required>
                    <option value="">Choose room</option>
                    @foreach ($rooms as $room)
                      <?php $room = (object)$room; ?>
                      <option value="{{ $room->number }}">{{ $room->number }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <button class="btn btn-primary btn-flat">Get room stats</button>
            </form>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <!-- The time line -->
              <ul class="timeline">
                <!-- /.timeline-label -->
                @foreach ($timetables as $timetable)
                <?php $timetable = (object) $timetable; ?>
                <!-- timeline item -->
                <li>
                  <i class="fa fa-calendar bg-purple"></i>

                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> to {{ \Carbon\Carbon::createFromTimestamp(strtotime($timetable->end_date))->toDayDateTimeString() }}</span>
                    <span class="time"><i class="fa fa-clock-o"></i> From {{ \Carbon\Carbon::createFromTimestamp(strtotime($timetable->start_date))->toDayDateTimeString() }}</span>

                    <h3 class="timeline-header no-border"><strong>Room {{ $timetable->number }}</strong> has <strong>{{ $timetable->name }}</strong> Course</h3>
                    <div class="timeline-body">
                      <a href="{{ url('/employee/timetable/' . $timetable->id . '/edit') }}" class="btn btn-primary btn-xs">Update</a>

                      <form id="delete-{{ $timetable->id }}" method="POST" action="{{ url('/employee/timetable/' . $timetable->id . '/delete') }}" style="display: none">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                      </form>
                      <a class="btn btn-danger btn-xs" href="" onclick="
                        if(confirm('Are you sure, You Want to delete this?'))
                          {
                            event.preventDefault();
                            document.getElementById('delete-{{ $timetable->id }}').submit();
                          }
                          else{
                            event.preventDefault();
                          }">Delete</a>
                    </div>
                  </div>
                </li>
                <!-- END timeline item -->
                @endforeach

                <li>
                  <i class="fa fa-clock-o bg-gray"></i>
                </li>
              </ul>
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
