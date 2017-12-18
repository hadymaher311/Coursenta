@extends('layouts.layout')
@section('title')
    View Courses
@endsection

@section('head')
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

@endsection

@section('body')

<!--Card-->
<!--Card Dark-->
<div class="card card-dark">
    <!--Card image-->
   
    <!--/.Card image-->
    <!--Card content-->
    @foreach( $comments as $comment)
    <div class="card-body bg-dark">
    	<div class="text-white" >
			{{ $comment['content'] }}
    	</div>
    </div>
    @endforeach
       </div>
        

@endsection

@section('footer')	

@endsection