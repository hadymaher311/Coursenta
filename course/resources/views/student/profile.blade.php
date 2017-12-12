@extends('layouts.layout')

@section('title')
	Student Profile
@endsection
<style>
	header {
		margin-top:85px !important;
	}
	.card-body-custom{
		padding:.75rem 1.25rem;
	}
	.card-body-custom:nth-child(odd){
		background:#eee;
	}

	.label img {
		max-width: 70px;
		margin-right: 20px;
	}

</style>
@section('head')
	
@endsection

@section('body')
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<div class="card mb-3">
				  <img class="card-img-top" src="{{ asset('/images/team2.jpg') }}" alt="Card image cap">
				  <div class="card-body-custom text-center">
				    <h4 class="card-title">{{ Auth::user()->name }}</h4>
				    <button class="btn btn-purple">Upload Image</button>
					</div>
				</div>
			</div>
			<div class="col-md-7">
				<div class="card border-dark mb-3">
				  <div class="card-header">Profile Info</div>
				  <div class="card-body-custom text-dark bg-grey-light-3">
				    <h5 class="card-title"><strong>Name:</strong> {{ Auth::user()->name }}</h5>
				  </div>
				  <div class="card-body-custom text-dark bg-grey-light-3">
				    <h5 class="card-title"><strong>Username:</strong> {{ Auth::user()->username }}</h5>
				  </div>
				  <div class="card-body-custom text-dark bg-grey-light-3">
				    <h5 class="card-title"><strong>Email:</strong> {{ Auth::user()->email }}</h5>
				  </div>
				<div class="card-body-custom text-dark bg-grey-light-3">
				    <h5 class="card-title"><strong>Mobile Number:</strong> {{ Auth::user()->mobile_number }}</h5>
				  </div>
				<div class="card-body-custom text-dark bg-grey-light-3">
				    <h5 class="card-title"><strong>School:</strong> {{ Auth::user()->school }}</h5>
				  </div>
				<div class="card-body-custom text-dark bg-grey-light-3">
				    <h5 class="card-title"><strong>Address:</strong> {{ Auth::user()->address }}</h5>
				  </div>
				<div class="card-body-custom text-dark bg-grey-light-3">
				    <h5 class="card-title"><strong>Date of Birth:</strong> {{ Auth::user()->date_of_birth }}</h5>
				  </div>

					<a class="btn btn-purple">Edit Profile</a>
					
				</div>			
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="card border-dark mb-3">
					<div class="card-header">My Courses</div>
					<div class="card-body">
						
						<div class="row">
							@foreach( $courses as $course)
								<!--Grid column-->
						        <div class="col-md-6 mb-r pt-3" style="padding: 2rem;">
						            <div class="card card-image" style="background-image: url('{{ asset('/images/img3.jpg') }}');">
						                <div class="text-white text-center align-items-center rgba-black-strong py-5 px-4">
						                    <div>
						                        <h3 class="card-title py-3 font-bold"><i class="fa fa-book"></i> <strong>{{ $course['name'] }}</strong></h3>
						                        <p class="pb-3">{{ $course['describtion'] }}</p>
						                        <a href="/course/{{ $course['code'] }}" class="btn btn-success btn-rounded"><i class="fa fa-clone left"></i> View Course</a>
						                    </div>
						                </div>
						            </div>
						        </div>
						        <!--Grid column-->
					        @endforeach

						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="card border-dark mb-3">
					<div class="card-header">My Comments</div>
				<!--Section: Social newsfeed v.1-->
				@foreach($comments as $comment)
				<?php $comment = (object) $comment; ?>
				<section class="pt-5 pb-3 card-body-custom">

		            <!--Newsfeed-->
		            <div class="mdb-feed">
		                <!--Fourth news-->
		                <div class="news media">

		                    <!--Label-->
		                    <div class="label">
		                        <img src="{{ asset('/images/team2.jpg') }}" class="rounded-circle z-depth-1-half">
		                    </div>

		                    <!--Excert-->
		                    <div class="excerpt media-body">

		                        <!--Brief-->
		                        <div class="brief">

		                            <a href="#" class="name">{{ Auth::user()->name }}</a> commented on {{ $comment->name }}
		                            <div class="date">{{Carbon\Carbon::createFromTimestampUTC(strtotime($comment->updated_at))->diffForHumans() }}</div>

		                        </div>

		                        <!--Added text-->
		                        <div class="added-text">{{ $comment->content }}</div>

		                    </div>

		                </div>
		                <!--Fourth news-->

		            </div>
		            <!--Newsfeed-->

				</section>
				@endforeach


			</div>
		</div>
		</div>

	</div>
@endsection


@section('footer')
	
@endsection




