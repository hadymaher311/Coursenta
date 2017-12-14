<!DOCTYPE html>
<html>
<head>
	@include('admin.layouts.head')
</head>
<body class="hold-transition skin-purple-light sidebar-mini">

	@include('admin.layouts.header')
	@include('admin.layouts.sidenavbar')

	@section('content')
		@show

	@include('admin.layouts.footer')

</body>
</html>