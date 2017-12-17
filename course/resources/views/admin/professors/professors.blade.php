@extends('admin.layouts.app')

@section('title')
Professors
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
        Professors
      </h1>
    </section>
	<section class="content">
	      <div class="row">
	        <div class="col-xs-12">
    			<div class="box">
	            <div class="box-header">
	              <h3 class="box-title">Professors Table</h3>
	              <a type="button" href="{{ url('admin/new/professor') }}" class="btn btn-success btn-flat pull-right">Add New Professor</a>
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
	                  <th>Name</th>
	                  <th>Username</th>
	                  <th>Email</th>
	                  <th>Mobile</th>
	                  <th>Field</th>
	                  <th>Address</th>
	                  <th>Added From</th>
	                </tr>
	                </thead>

	                <tbody>

	                @foreach ($professors as $professor)
	                	<tr>
	                		<?php $professor = (object)$professor; ?>
	                		<td>{{ $loop->index + 1 }}</td>
	                		<td>{{ $professor->name }}</td>
	                		<td>{{ $professor->username }}</td>
	                		<td>{{ $professor->email }}</td>
	                		<td>{{ $professor->mobile_number }}</td>
	                		<td>{{ $professor->field }}</td>
	                		<td>{{ $professor->address }}</td>
	                		<td>{{ Carbon\Carbon::createFromTimestamp(strtotime($professor->created_at))->diffForHumans() }}</td>
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
	                  <th>Field</th>
	                  <th>Address</th>
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
