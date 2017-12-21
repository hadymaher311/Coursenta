@extends('admin.layouts.app')

@section('title')
Student stats
@endsection

@section('head')
<link rel="stylesheet" href="{{ asset('/admin_style/css/morris.css') }}">
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
              <h3 class="box-title">Max {{ count($students) }} Students stats</h3>

              <form action="{{ url('/admin/student/stats') }}" method="POST" class="inline-form">
                {{ csrf_field() }}
                <div class="form-group">
                  <div class="col-sm-9">
                    <input type="number" name="student" min="0" required class="form-control">
                  </div>
                </div>
                <button class="btn btn-primary btn-flat">Get student stats</button>
              </form>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
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
<!-- ChartJS 1.0.1 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('/admin_style/js/morris.min.js') }}"></script>
<script>
  $(function () {
    //DONUT CHART
    var donut = new Morris.Donut({
      element: 'sales-chart',
      resize: true,
      colors: [
        @foreach ($students as $student)
          <?php $color = str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT) . str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT) . str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT); ?>
          "#{{ $color }}",
        @endforeach
      ],
      data: [
      @foreach ($students as $student)
        {label: "{{ $student['name'] }}", value: {{ intval($student['comments_count']) }}},
      @endforeach
      ],
      hideHover: 'auto'
    });

  });

</script>
@endsection
