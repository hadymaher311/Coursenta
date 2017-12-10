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
				  <img class="card-img-top" src="{{ asset('/images/team3.jpg') }}" alt="Card image cap">
				  <div class="card-body-custom text-center">
				    <h4 class="card-title">reem ashraf</h4>
				    <button class="btn btn-purple">Upload Image</button>
					</div>
				</div>
			</div>
			<div class="col-md-7">
				<div class="card border-dark mb-3">
				  <div class="card-header">Profile Info</div>
				  <div class="card-body-custom text-dark bg-grey-light-3">
				    <h5 class="card-title">Name: </h5>
				  </div>
				  <div class="card-body-custom text-dark bg-grey-light-3">
				    <h5 class="card-title">Username: </h5>
				  </div>
				  <div class="card-body-custom text-dark bg-grey-light-3">
				    <h5 class="card-title">Email: </h5>
				  </div>
				<div class="card-body-custom text-dark bg-grey-light-3">
				    <h5 class="card-title">Mobile Number: </h5>
				  </div>
				<div class="card-body-custom text-dark bg-grey-light-3">
				    <h5 class="card-title">School: </h5>
				  </div>
				<div class="card-body-custom text-dark bg-grey-light-3">
				    <h5 class="card-title">Address: </h5>
				  </div>
				<div class="card-body-custom text-dark bg-grey-light-3">
				    <h5 class="card-title">Date of Birth: </h5>
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
							<!--Grid column-->
					        <div class="col-md-6 mb-r pt-3" style="padding: 2rem;">
					            <div class="card card-image" style="background-image: url('{{ asset('/images/img3.jpg') }}');">
					                <div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
					                    <div>
					                        <h3 class="card-title py-3 font-bold"><i class="fa fa-book"></i> <strong>Course Title</strong></h3>
					                        <p class="pb-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat fugiat, laboriosam, voluptatem,
					                            optio vero odio nam sit officia accusamus minus error nisi architecto nulla ipsum dignissimos.
					                            Odit sed qui, dolorum!</p>
					                        <a class="btn btn-success btn-rounded"><i class="fa fa-clone left"></i> View Course</a>
					                    </div>
					                </div>
					            </div>
					        </div>
					        <!--Grid column-->

					        <!--Grid column-->
					        <div class="col-md-6 mb-r pt-3" style="padding: 2rem;">
					            <div class="card card-image" style="background-image: url('{{ asset('/images/img2.jpg') }}');">
					                <div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
					                    <div>
					                        <h3 class="card-title py-3 font-bold"><i class="fa fa-book"></i> <strong>Course Title</strong></h3>
					                        <p class="pb-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat fugiat, laboriosam, voluptatem,
					                            optio vero odio nam sit officia accusamus minus error nisi architecto nulla ipsum dignissimos.
					                            Odit sed qui, dolorum!</p>
					                        <a class="btn btn-danger btn-rounded"><i class="fa fa-clone left"></i> View Course</a>
					                    </div>
					                </div>
					            </div>
					        </div>
					        <!--Grid column-->

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
				<section class="pt-5 pb-3 card-body-custom">

		            <!--Newsfeed-->
		            <div class="mdb-feed">
		                <!--Fourth news-->
		                <div class="news media">

		                    <!--Label-->
		                    <div class="label">
		                        <img src="{{ asset('/images/team3.jpg') }}" class="rounded-circle z-depth-1-half">
		                    </div>

		                    <!--Excert-->
		                    <div class="excerpt media-body">

		                        <!--Brief-->
		                        <div class="brief">
		                            <a href="#" class="name">Lili Rose</a> posted on his page<div class="date">2 days ago</div>
		                        </div>

		                        <!--Added text-->
		                        <div class="added-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero inventore, iste quas libero eius? Vitae sint neque animi alias sunt dolor, accusantium ducimus, non placeat voluptate.</div>

		                    </div>

		                </div>
		                <!--Fourth news-->

		            </div>
		            <!--Newsfeed-->

				</section>
 
			</div>
		</div>
		</div>

	</div>
@endsection


@section('footer')
	
@endsection




