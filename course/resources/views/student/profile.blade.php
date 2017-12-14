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
		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		<div class="row">
			<div class="col-md-3">
				<div class="card mb-3">
				  <img class="card-img-top" src="
				  @if (Auth::user()->image == '')
				  {{ asset('/images/student_default.jpg') }}
				  @else
				  {{ Storage::disk('local')->url(Auth::user()->image) }}
				  @endif" alt="Card image cap">
				  <div class="card-body-custom text-center">
				    <h4 class="card-title">{{ Auth::user()->name }}</h4>
				    <button id="profileImage" class="btn btn-purple">Upload Image</button>
				    <form action="{{ url('student/photo') }}" method="POST" enctype="multipart/form-data">
		            	{{ csrf_field() }}
		              	<input type="file" name="profile_photo" id="fileImage" accept="image/*" />
		              </form>
					</div>
				</div>
			</div>
			<div class="col-md-9">
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

					<a class="btn btn-purple" data-toggle="modal" data-target="#exampleModal">Edit Profile</a>
				
										<!-- Modal -->
					<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					    <div class="modal-dialog modal-notify modal-primary" role="document">
					        <div class="modal-content">
					            <div class="modal-header bg-secondary text-white">
					                <h5 class="modal-title" id="exampleModalLabel">Update profile</h5>
					                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                    <span aria-hidden="true">&times;</span>
					                </button>
					            </div>
					            <div class="modal-body">
					            	<form action="{{ url('student/update') }} " method="POST">
					            		{{ csrf_field() }}
					                <div class="md-form form-sm">
				                        <i class="fa fa-envelope prefix"></i>
				                        <input type="text" id="form19" name="username" value="{{ Auth::user()->username }}" class="form-control">
				                        <label for="form19">Username</label>
				                    </div>

				                    <div class="md-form form-sm">
				                        <i class="fa fa-envelope prefix"></i>
				                        <input type="text" id="form19" name="name" value="{{ Auth::user()->name }}" class="form-control">
				                        <label for="form19">Name</label>
				                    </div>
				    
				                    <div class="md-form form-sm">
				                        <i class="fa fa-lock prefix"></i>
				                        <input type="Email" id="form20" name="email" value="{{ Auth::user()->email }}" class="form-control">
				                        <label for="form20">Email</label>
				                    </div>
				    
				                    <div class="md-form form-sm">
				                        <i class="fa fa-tag prefix"></i>
				                        <input type="tel" id="form21" name="mobile_number" value="{{ Auth::user()->mobile_number }}" class="form-control">
				                        <label for="form21">Mobile Number</label>
				                    </div>

				                    <div class="md-form form-sm">
				                        <i class="fa fa-tag prefix"></i>
				                        <input type="text" id="form21" name="school" value="{{ Auth::user()->school }}"class="form-control">
				                        <label for="form22">School</label>
				                    </div>


					                <div class="md-form form-sm">
				                        <i class="fa fa-envelope prefix"></i>
				                        <input type="text" id="form19" name="address" value="{{ Auth::user()->address }}" class="form-control">
				                        <label for="form19">Address</label>
				                    </div>
				    
				                    <div class="md-form form-sm">
				                        <i class="fa fa-pencil prefix"></i>
				                        <input type="text" id="form21" name="date_of_birth" value="{{ Auth::user()->date_of_birth }}" class="form-control">
				                        <label for="form23">Date Of Birth</label>
				                    </div>
				    
				                    <div class="text-center mt-1-half">
				                        <button type="submit" class="btn btn-purple mb-2">Update <i class="fa fa-send ml-1"></i></button>
				                    </div>
					            </div>
					           </form>
					        </div>
					    </div>
					</div>

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
		                            <div class="date">{{ Carbon\Carbon::createFromTimestampUTC(strtotime($comment->updated_at))->diffForHumans() }}</div>
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

	<script>
		// make file button
		var wrapper = $('<div/>').css({height:0,width:0,'overflow':'hidden'});
		var fileInput = $('input:file').wrap(wrapper);

		$('#fileImage').on("change", function() {
		    $(this).parents("form").submit();
		});

		$('#profileImage').click(function(){
		    fileInput.click();
		}).show();
	</script>

@endsection







