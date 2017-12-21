@extends('admin.layouts.app')

@section('title')
Admins
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
        Admins
      </h1>
    </section>
	<section class="content">
	      <div class="row">
	        <div class="col-xs-12">
    			<div class="box">
	            <div class="box-header">
	              <h3 class="box-title">Admins Table</h3>
	              <a type="button" href="{{ url('admin/new/admin') }}" class="btn btn-success btn-flat pull-right">Add New Admin</a>
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
	                  <th>Username</th>
	                  <th>Email</th>
	                  <th>Mobile</th>
	                  <th>Verified</th>
	                  <th>Added From</th>
	                </tr>
	                </thead>

	                <tbody>

	                @foreach ($admins as $admin)
	                	<tr>
	                		<?php $admin = (object)$admin; ?>
	                		<td>{{ $loop->index + 1 }}</td>
	                		<td>{{ $admin->username }}</td>
	                		<td>{{ $admin->email }}</td>
	                		<td>{{ $admin->mobile_number }}</td>
	                		<td>
	                			@if ($admin->status == 0)
									<button class="btn btn-danger btn-sm">Not Verified</button>
								@else
									<button class="btn btn-success btn-sm">Verified</button>
	                			@endif
	                		</td>
	                		<td>{{ Carbon\Carbon::createFromTimestamp(strtotime($admin->created_at))->diffForHumans() }}</td>
	                	</tr>
	                @endforeach

	                </tbody>

	                <tfoot>
	                <tr>
	                  <th>#</th>
	                  <th>Username</th>
	                  <th>Email</th>
	                  <th>Mobile</th>
	                  <th>Verified</th>
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
