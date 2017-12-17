@extends('admin.layouts.app')

@section('title')
Branches
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
        Branches
      </h1>
    </section>
	<section class="content">
	      <div class="row">
	        <div class="col-xs-12">
    			<div class="box">
	            <div class="box-header">
	              <h3 class="box-title">Branches Table</h3>
	              <a type="button" href="{{ url('admin/branches/create') }}" class="btn btn-success btn-flat pull-right">Add New Branch</a>
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
	                  <th>name</th>
	                  <th>address</th>
	                  <th>Capacity</th>
	                  <th>mobile_number</th>
	                  <th>Actions</th>
	                  <th>Added From</th>
	                </tr>
	                </thead>

	                <tbody>

	                @foreach ($branches as $branch)
	                	<tr>
	                		<?php $branch = (object)$branch; ?>
	                		<td>{{ $loop->index + 1 }}</td>
	                		<td>{{ $branch->name }}</td>
	                		<td>{{ $branch->address }}</td>
	                		<td>{{ $branch->room_number }}</td>
	                		<td>{{ $branch->mobile_number }}</td>

							<td>
								<a href="{{ url('/admin/branches/' . $branch->code . '/edit') }}" class="btn btn-primary btn-xs">Update</a>
								
								<form id="delete-{{ $branch->code }}" method="POST" action="{{ url('/admin/branches/' . $branch->code . '/delete') }}" style="display: none">
	                                {{ csrf_field() }}
	                                {{ method_field('DELETE') }}
	                            </form>
	                            <a class="btn btn-danger btn-xs" href="" onclick="
	                              	if(confirm('Are you sure, You Want to delete this?'))
	                                  {
	                                    event.preventDefault();
	                                    document.getElementById('delete-{{ $branch->code }}').submit();
	                                  }
	                                  else{
	                                    event.preventDefault();
	                                  }">Delete</a>

							</td>

	                		<td>{{ Carbon\Carbon::createFromTimestamp(strtotime($branch->created_at))->diffForHumans() }}</td>
	                	</tr>
	                @endforeach

	                </tbody>

	                <tfoot>
	                <tr>
	                  <th>#</th>
	                  <th>name</th>
	                  <th>address</th>
	                  <th>Capacity</th>
	                  <th>mobile_number</th>
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
