@extends('layouts.layout')
@section('title')
    View Courses
@endsection
<style>

	header {
		margin-top:85px !important;
	}
	.view {
		height: auto !important;
	}

	footer {
		margin-top: 50px;
	}

</style>


@section('head')

@endsection

@section('body')
	<div class="container">
		<h2 class="text-center"><strong> Courses</strong></h2>
		<div class="row">
			@foreach( $courses as $course)
			<?php $course = (object)$course; ?>
			<div class="col-sm-3 ml-auto mr-auto">
				<!--Card-->
				<div class="card">

				    <!--Card image-->
				    <div class="view overlay hm-white-slight">
				        <img src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20%287%29.jpg" class="img-fluid" alt="">
				        <a href="#">
				            <div class="mask"></div>
				        </a>
				    </div>

				    <!--Card content-->
				    <div class="card-body" style="padding: 0.5rem;">
				        <!--Title-->
				        <h4 class="card-title text-center">{{ $course->name }}</h4>
				        <!--Text-->
				        <p class="card-text text-right"><span @if($course->cost > $course->offer_cost) style="text-decoration: line-through;" @endif>${{ $course->cost }}</span> @if($course->cost > $course->offer_cost) <span>${{ $course->offer_cost }}</span> @endif</p>
				        <a href="{{ url('/course/' . $course->code) }}" class="btn btn-purple btn-sm">View Course</a>
				    </div>

				</div>
				<!--/.Card-->
			</div>
			@endforeach
		</div>
	</div>	
@endsection

@section('footer')



@endsection