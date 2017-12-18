@extends('layouts.layout')

@section('title')
	Professor Profile
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
		@if (session('error'))
			<div class="card-header bg-danger text-white">{{ session('error') }}</div>
		@endif
		@if (session('status'))
			<div class="card-header bg-success text-white">{{ session('status') }}</div>
		@endif
		@foreach ($errors->all() as $error)
			<div class="card-header bg-danger">{{ $error }}</div>
		@endforeach
		<div class="row">
			<div class="col-md-3">
				<div class="card mb-3">
				   <img class="card-img-top" src="
				  @if (Auth::user()->image == '')
				  {{ asset('/images/professor_default.png') }}
				  @else
				  {{ Storage::disk('local')->url(Auth::user()->image) }}
				  @endif" alt="Card image cap">
				  <form action="{{ url('professors/photo') }}" method="POST" enctype="multipart/form-data" style="display: none;">
		            	{{ csrf_field() }}
		              	<input type="file" name="profile_photo" id="fileImage" accept="image/*" />
		          </form>
				  <div class="card-body-custom text-center">
				    <h4 class="card-title">{{ Auth::user()->name }}</h4>
				    <button class="btn btn-purple" id="profileImage">Upload Image</button>
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
				    <h5 class="card-title"><strong>field:</strong> {{ Auth::user()->field }}</h5>
				  </div>
				<div class="card-body-custom text-dark bg-grey-light-3">
				    <h5 class="card-title"><strong>Address:</strong> {{ Auth::user()->address }}</h5>
				  </div>
				<div class="row">
					<div class="col-sm-6">
						<a class="btn btn-purple" data-toggle="modal" data-target="#EditModal">Edit Profile</a>
					</div>
					<div class="col-sm-6">
						<a class="btn btn-primary" data-toggle="modal" data-target="#contactModal">Contact Center</a>
					</div>
				</div>
					
					<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					    <div class="modal-dialog modal-notify modal-primary" role="document">
					        <div class="modal-content">
					            <div class="modal-header bg-secondary text-white">
					                <h5 class="modal-title" id="EditModalLabel">Update profile</h5>
					                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                    <span aria-hidden="true">&times;</span>
					                </button>
					            </div>
					            <div class="modal-body">
					            	<form action="{{ url('professor/update') }} " method="POST">
					            		{{ csrf_field() }}
						                <div class="md-form form-sm">
					                        <i class="fa fa-user prefix"></i>
					                        <input type="text" id="form19" name="username" value="{{ Auth::user()->username }}" class="form-control">
					                        <label for="form19">Username</label>
					                    </div>

					                    <div class="md-form form-sm">
					                        <i class="fa fa-user prefix"></i>
					                        <input type="text" id="form19" name="name" value="{{ Auth::user()->name }}" class="form-control">
					                        <label for="form19">Name</label>
					                    </div>
					    
					                    <div class="md-form form-sm">
					                        <i class="fa fa-envelope prefix"></i>
					                        <input type="Email" id="form20" name="email" value="{{ Auth::user()->email }}" class="form-control">
					                        <label for="form20">Email</label>
					                    </div>
					    
					                    <div class="md-form form-sm">
					                        <i class="fa fa-mobile prefix"></i>
					                        <input type="tel" id="form21" name="mobile_number" value="{{ Auth::user()->mobile_number }}" class="form-control">
					                        <label for="form21">Mobile Number</label>
					                    </div>

					                    <div class="md-form form-sm">
					                        <i class="fa fa-tag prefix"></i>
					                        <input type="text" id="form21" name="field" value="{{ Auth::user()->field }}"class="form-control">
					                        <label for="form22">Field</label>
					                    </div>


						                <div class="md-form form-sm">
					                        <i class="fa fa-address-book prefix"></i>
					                        <input type="text" id="form19" name="address" value="{{ Auth::user()->address }}" class="form-control">
					                        <label for="form19">Address</label>
					                    </div>
					                    <div class="md-form form-sm">
					                        <i class="fa fa-lock prefix"></i>
					                        <input type="password" id="form19" name="password" value="" class="form-control">
					                        <label for="form21">Password</label>
					                    </div>
					                    <div class="text-center mt-1-half">
					                        <button type="submit" class="btn btn-purple mb-2">Update <i class="fa fa-send ml-1"></i></button>
					                    </div>   	    
									</form>
								</div>
							</div>			
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="card border-dark mb-3">
					<div class="card-header">My Courses <a href="" class="btn btn-success btn-flat btn-sm pull-right" data-toggle="modal" data-target="#newCourseModal">Add new course</a></div>
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

	</div>




	{{-- add new course modal --}}
	<!-- Modal -->
	<div class="modal fade right" id="newCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-side modal-top-right" role="document">
	        <div class="modal-content">
	            <div class="modal-header bg-purple">
	                <h5 class="modal-title" id="exampleModalLabel">Add new course</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <div class="modal-body">
	                <form action="{{ url('professor/course/new') }} " method="POST">
	            		{{ csrf_field() }}
	                    <div class="md-form form-sm">
	                        <i class="fa fa-user prefix"></i>
	                        <input type="text" id="form19" name="name" value="{{ old('name') }}" class="form-control" required>
	                        <label for="form19">Name</label>
	                    </div>

		                <div class="md-form form-sm">
	                        <i class="fa fa-usd prefix"></i>
	                        <input type="text" id="form19" name="cost" value="{{ old('cost') }}" class="form-control" required>
	                        <label for="form19">Cost</label>
	                    </div>

	                    <div class="md-form form-sm">
	                        <i class="fa fa-usd prefix"></i>
	                        <input type="text" id="form20" name="offer_cost" value="{{ old('offer_cost') }}" class="form-control" required>
	                        <label for="form20">Offer Cost</label>
	                    </div>
	    
	                    <div class="md-form form-sm">
	                        <i class="fa fa-tag prefix"></i>
	                        <input type="text" id="form21" name="sessions_number" value="{{ old('sessions_number') }}" class="form-control" required>
	                        <label for="form21">Sessions Number</label>
	                    </div>

	                    <div class="md-form form-sm">
	                        <i class="fa fa-tag prefix"></i>
	                        <textarea name="description" id="" class="md-textarea" required cols="30" rows="10">{{ old('description') }}</textarea>
	                        <label for="form22">Description</label>
	                    </div>

	                    <div class="text-center mt-1-half">
	                        <button type="submit" class="btn btn-purple mb-2">Add <i class="fa fa-plus ml-1"></i></button>
	                    </div>   	    
					</form>
	            </div>
	        </div>
	    </div>
	</div>


	<!--Modal: Contact form-->
    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog cascading-modal" role="document">
            <!--Content-->
            <div class="modal-content">
    
                <!--Header-->
                <div class="modal-header light-blue darken-3 white-text">
                    <h4 class="title"><i class="fa fa-pencil"></i> Contact form</h4>
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body mb-0">
    
    				<form action="{{ url('/professor/sendEmail') }}" method="POST">
    					{{ csrf_field() }}
	                    <div class="md-form form-sm">
	                        <i class="fa fa-tag prefix"></i>
	                        <input type="text" id="form21" class="form-control" name="subject">
	                        <label for="form21">Subject</label>
	                    </div>
	    
	                    <div class="md-form form-sm">
	                        <i class="fa fa-pencil prefix"></i>
	                        <textarea type="text" id="form8" class="md-textarea mb-0" name="message"></textarea>
	                        <label for="form8">Your message</label>
	                    </div>
	    
	                    <div class="text-center mt-1-half">
	                        <button class="btn btn-info mb-2">Send <i class="fa fa-send ml-1"></i></button>
	                    </div>
                    </form>
    
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!--Modal: Contact form-->




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





