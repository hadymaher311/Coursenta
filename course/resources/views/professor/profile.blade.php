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
		<div class="row">
			<div class="col-md-5">
				<div class="card mb-3">
				   <img class="card-img-top" src="
				  @if (Auth::user()->image == '')
				  {{ asset('/images/professor_default.png') }}
				  @else
				  {{ Storage::disk('local')->url(Auth::user()->image) }}
				  @endif" alt="Card image cap">
				  <form action="{{ url('professors/photo') }}" method="POST" enctype="multipart/form-data">
		            	{{ csrf_field() }}
		              	<input type="file" name="profile_photo" id="fileImage" accept="image/*" />
		              	 </form>
				  <div class="card-body-custom text-center">
				    <h4 class="card-title">{{ Auth::user()->name }}</h4>
				    <button class="btn btn-purple" id="profileImage">Upload Image</button>
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
				    <h5 class="card-title"><strong>field:</strong> {{ Auth::user()->field }}</h5>
				  </div>
				<div class="card-body-custom text-dark bg-grey-light-3">
				    <h5 class="card-title"><strong>Address:</strong> {{ Auth::user()->address }}</h5>
				  </div>

						<a class="btn btn-purple" data-toggle="modal" data-target="#EditModal">Edit Profile</a>
					
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
				                        <i class="fa fa-tag prefix"></i>
				                        <input type="tel" id="form21" name="mobile_number" value="{{ Auth::user()->mobile_number }}" class="form-control">
				                        <label for="form21">Mobile Number</label>
				                    </div>

				                    <div class="md-form form-sm">
				                        <i class="fa fa-tag prefix"></i>
				                        <input type="text" id="form21" name="school" value="{{ Auth::user()->field }}"class="form-control">
				                        <label for="form22">Field</label>
				                    </div>


					                <div class="md-form form-sm">
				                        <i class="fa fa-envelope prefix"></i>
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





