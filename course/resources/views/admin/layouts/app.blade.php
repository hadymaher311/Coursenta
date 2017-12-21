<!DOCTYPE html>
<html>
<head>
	@include('admin.layouts.head')
</head>
<body class="hold-transition skin-purple sidebar-mini">

	@include('admin.layouts.header')
	@include('admin.layouts.sidenavbar')
<div class="wrapper">
	@section('content')
		@show
		<div class="control-sidebar-bg"></div>
</div>
	@include('admin.layouts.footer')

</body>
</html>