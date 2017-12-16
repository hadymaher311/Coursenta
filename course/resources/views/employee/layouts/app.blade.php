<!DOCTYPE html>
<html>
<head>
	@include('employee.layouts.head')
</head>
<body class="hold-transition skin-purple-light sidebar-mini">

	@include('employee.layouts.header')
	@include('employee.layouts.sidenavbar')

	@section('content')
		@show

	@include('employee.layouts.footer')

</body>
</html>