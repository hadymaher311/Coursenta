@extends('employee.layouts.app')

@section('title')
Rooms
@endsection

@section('head')
	<link rel="stylesheet" href="{{ asset('/employee_style/css/dataTables.bootstrap.css') }}">
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
	              <h3 class="box-title">Rooms Table</h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
	            	@if (session('status'))
					    <div class="alert alert-success">
					        {{ session('status') }}
					    </div>
					@endif
	              <table id="example1" class="table table-bordered table-striped">
	                <thead>
	                <tr>
	                  <th>#</th>
	                  <th>Number</th>
	                  <th>Branch</th>
	                  <th>Capacity</th>
	                  <th>Availability</th>
	                  <th>AC</th>
	                  <th>Projector</th>
	                  <th>Actions</th>
	                  <th>Added From</th>
	                </tr>
	                </thead>

	                <tbody>

	                @foreach ($rooms as $room)
	                	<tr>
	                		<?php $room = (object)$room; ?>
	                		<td>{{ $loop->index + 1 }}</td>
	                		<td>{{ $room->number }}</td>
	                		<td>{{ $room->branch_name }}</td>
	                		<td>{{ $room->capacity }}</td>
	                		<td>
	                			@if ($room->availability)
	                				<button class="btn btn-success btn-xs"><i class="fa fa-check" aria-hidden="true"></i></button>
	                			@else
	                				<button class="btn btn-danger btn-xs"><i class="fa fa-times" aria-hidden="true"></i></button>
	                			@endif
	                		</td>
	                		<td>
								@if ($room->AC)
	                				<button class="btn btn-success btn-xs"><i class="fa fa-check" aria-hidden="true"></i></button>
	                			@else
	                				<button class="btn btn-danger btn-xs"><i class="fa fa-times" aria-hidden="true"></i></button>
	                			@endif
	                		</td>
	                		<td>
								@if ($room->projector)
	                				<button class="btn btn-success btn-xs"><i class="fa fa-check" aria-hidden="true"></i></button>
	                			@else
	                				<button class="btn btn-danger btn-xs"><i class="fa fa-times" aria-hidden="true"></i></button>
	                			@endif
	                		</td>

							<td>
								<a href="{{ url('/employee/rooms/' . $room->number . '/edit') }}" class="btn btn-primary btn-xs">Update</a>

							</td>

	                		<td>{{ Carbon\Carbon::createFromTimestamp(strtotime($room->created_at))->diffForHumans() }}</td>
	                	</tr>
	                @endforeach

	                </tbody>

	                <tfoot>
	                <tr>
	                  <th>#</th>
	                  <th>Number</th>
	                  <th>Branch</th>
	                  <th>Capacity</th>
	                  <th>Availability</th>
	                  <th>AC</th>
	                  <th>Projector</th>
	                  <th>Actions</th>
	                  <th>Added From</th>
	                </tr>
	                </tfoot>
	              </table>
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

<script src="{{ asset('/employee_style/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/employee_style/js/dataTables.bootstrap.min.js') }}"></script>
<!-- page script -->
<script>
  $(function () {
  	$("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>

@endsection
