@extends('admin.layouts.app')

@section('title')
Courses
@endsection

@section('head')
	<link rel="stylesheet" href="{{ asset('/admin_style/css/dataTables.bootstrap.css') }}">
@endsection

@section('content')

	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Courses
      </h1>
    </section>
	<section class="content">
	      <div class="row">
	        <div class="col-xs-12">
    			<div class="box">
	            <div class="box-header">
	              <h3 class="box-title">Courses Table</h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
	              <table id="example1" class="table table-bordered table-striped">
	                <thead>
	                <tr>
	                  <th>#</th>
	                  <th>Name</th>
	                  <th>Cost</th>
	                  <th>Offer Cost</th>
	                  <th>Description</th>
	                  <th>Sessions Number</th>
	                  <th>Professor</th>
	                  <th>Created at</th>
	                  <th>Verified</th>
	                </tr>
	                </thead>

	                <tbody>

	                @foreach ($courses as $course)
	                	<tr>
	                		<?php $course = (object)$course; ?>
	                		<td>{{ $loop->index + 1 }}</td>
	                		<td>{{ $course->name }}</td>
	                		<td>{{ $course->cost }}</td>
	                		<td>{{ $course->offer_cost }}</td>
	                		<td>{{ $course->describtion }}</td>
	                		<td>{{ $course->sessions_number }}</td>
	                		<td>{{ $course->professor_name }}</td>
	                		<td>{{ Carbon\Carbon::createFromTimestamp(strtotime($course->created_at))->diffForHumans() }}</td>
	                		<td>
	                			@if ($course->verified == 0)
									<form action="{{ url('/admin/courses/verify/' . $course->code) }}" method="POST">
										{{ csrf_field() }}
										<button class="btn btn-danger btn-sm">Verify</button>
									</form>
								@else
									<button class="btn btn-success btn-sm">Verified</button>
	                			@endif
	                		</td>
	                	</tr>
	                @endforeach

	                </tbody>

	                <tfoot>
	                <tr>
	                  <th>#</th>
	                  <th>Name</th>
	                  <th>Cost</th>
	                  <th>Offer Cost</th>
	                  <th>Description</th>
	                  <th>Sessions Number</th>
	                  <th>Professor</th>
	                  <th>Created at</th>
	                  <th>Verified</th>
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

<script src="{{ asset('/admin_style/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/admin_style/js/dataTables.bootstrap.min.js') }}"></script>
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
