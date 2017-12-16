  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="@if (Auth::user()->image == '')
        {{ asset('/images/team2.jpg') }}
        @else
        {{ Storage::disk('local')->url(Auth::user()->image) }}
              @endif" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->username }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li><a href="{{ url('admin/courses') }}"><i class="fa fa-circle-o text-red"></i> <span>Courses</span></a></li>
        <li><a href="{{ url('admin/students') }}"><i class="fa fa-circle-o text-yellow"></i> <span>Students</span></a></li>
        <li><a href="{{ url('admin/professors') }}"><i class="fa fa-circle-o text-aqua"></i> <span>Professors</span></a></li>
        <li><a href="{{ url('admin/employees') }}"><i class="fa fa-circle-o text-green"></i> <span>Employees</span></a></li>
        <li><a href="{{ url('admin/rooms') }}"><i class="fa fa-circle-o text-blue"></i> <span>Rooms</span></a></li>
        <li><a href="{{ url('admin/admins') }}"><i class="fa fa-circle-o text-purple"></i> <span>Admins</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>