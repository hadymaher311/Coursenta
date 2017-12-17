@extends('admin.layouts.app')

@section('title')
Students
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
        Students
      </h1>
    </section>
	<section class="content">
	      <div class="row">
	        <div class="col-xs-12">
    			<div class="box">
	            <div class="box-header">
	              <h3 class="box-title">Students Table</h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
	              <table id="example1" class="table table-bordered table-striped">
	                <thead>
	                <tr>
	                  <th>#</th>
	                  <th>Name</th>
	                  <th>Username</th>
	                  <th>Email</th>
	                  <th>Mobile</th>
	                  <th>School</th>
	                  <th>Date Of Birth</th>
	                  <th>Address</th>
	                  <th>Added From</th>
	                  <th>Verified</th>
	                </tr>
	                </thead>

	                <tbody>

	                @foreach ($students as $student)
	                	<tr>
	                		<?php $student = (object)$student; ?>
	                		<td>{{ $loop->index + 1 }}</td>
	                		<td>{{ $student->name }}</td>
	                		<td>{{ $student->username }}</td>
	                		<td>{{ $student->email }}</td>
	                		<td>{{ $student->mobile_number }}</td>
	                		<td>{{ $student->school }}</td>
	                		<td>{{ $student->date_of_birth }}</td>
	                		<td>{{ $student->address }}</td>
	                		<td>{{ Carbon\Carbon::createFromTimestamp(strtotime($student->created_at))->diffForHumans() }}</td>
	                		<td>
	                			@if ($student->status == 0)
									<button class="btn btn-danger btn-sm">Not Verified</button>
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
	                  <th>Username</th>
	                  <th>Email</th>
	                  <th>Mobile</th>
	                  <th>School</th>
	                  <th>Date Of Birth</th>
	                  <th>Address</th>
	                  <th>Added From</th>
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
