@extends('admin.layouts.app')

@section('title')
    Admin Home Page
@endsection

@section('content')
<!-- Site wrapper -->
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Admin Home Page
      </h1>
    </section>

  <div class="container">
    <h4>Get Courses Stats</h4>
  </div>
    <form action="{{ url('/admin/course/stats') }}" method="POST" class="inline-form">
      {{ csrf_field() }}
      <div class="form-group">
        <div class="col-sm-9">
          <select class="form-control" name="course" required>
            <option value="">Choose Course</option>
            @foreach ($courses2 as $course)
              <?php $course = (object)$course; ?>
              <option value="{{ $course->code }}">{{ $course->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <button class="btn btn-primary btn-flat">Get course stats</button>
    </form>

  <div class="container">
    <h4>Get Professors Stats</h4>
  </div>
    <form action="{{ url('/admin/professor/stats') }}" method="POST" class="inline-form">
      {{ csrf_field() }}
      <div class="form-group">
        <div class="col-sm-9">
          <select class="form-control" name="professor" required>
            <option value="">Choose Professor</option>
            @foreach ($professors as $professor)
              <?php $professor = (object)$professor; ?>
              <option value="{{ $professor->id }}">{{ $professor->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <button class="btn btn-primary btn-flat">Get professor stats</button>
    </form>

    <!-- Main content -->
    <section class="content">

      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $professors_count }}</h3>

              <p>Professors</p>
            </div>
            <div class="icon">
              <i class="ion-briefcase"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $courses_count }}</h3>

              <p>Courses</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $students_count }}</h3>

              <p>Student Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $employees_count }}</h3>

              <p>Employees</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

    
        <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Latest Courses</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
            <!-- /.col -->
        @foreach ($courses as $course)

            <div class="col-md-6">
              <!-- Box Comment -->
              <div class="box box-widget">
                <div class="box-header with-border">
                  <div class="user-block">
                    <img class="img-circle" src="{{ asset('/images/team2.jpg') }}" alt="User Image">
                    <span class="username"><a href="{{ url('/professor') }}/{{ $course['prof_id'] }}">{{ $course['prof_name'] }}</a></span>
                    <span class="description">{{ $course['course_name'] }} - {{ Carbon\Carbon::createFromTimestampUTC(strtotime($course['course_time']))->diffForHumans() }}</span>
                  </div>
                  <!-- /.user-block -->
                  <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <!-- post text -->
                  <p>{{ $course['describtion'] }}</p>

                  <span class="pull-right text-muted">{{ sizeof($comments[$loop->index]) }} comments</span>
                </div>
                <!-- /.box-body -->
                @foreach ($comments[$loop->index] as $comment)
                    <div class="box-footer box-comments">
                      <div class="box-comment">
                        <!-- User image -->
                        <img class="img-circle img-sm" src="{{ asset('/images/team2.jpg') }}" alt="User Image">
                
                        <div class="comment-text">
                              <span class="username">
                                {{ $comment['name'] }}
                                <span class="text-muted pull-right">{{ Carbon\Carbon::createFromTimestampUTC(strtotime($comment['updated_at']))->diffForHumans() }}</span>
                              </span><!-- /.username -->
                          {{ $comment['content'] }}
                        </div>

                        <!-- /.comment-text -->
                      </div>
                    </div>
                @endforeach
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->

        @endforeach
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->


    </section>
    <!-- /.content -->
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


@endsection

