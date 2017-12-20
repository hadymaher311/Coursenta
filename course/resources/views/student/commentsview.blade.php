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
    .label img {
        max-width: 50px;
        margin-right: 20px;
    }

</style>

@endsection

@section('body')


<div class="bg-dark pt-5 pb-5 text-white">
    <div class="container">
    
        @if (session('status'))
            <div class="card bg-success" style="padding: 1rem;">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="card bg-danger"  style="padding: 1rem;">
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <h1>{{ $course['course_name'] }}</h1> 
                <div><span class="text-secondary">@if ($course['course_cost'] != $course['course_offer'] )
                    <s>${{ $course['course_cost'] }}</s>
                    @else
                    ${{ $course['course_cost'] }}
                @endif</span> @if ($course['course_cost'] != $course['course_offer'] )
                    <span class="text-white">${{ $course['course_offer'] }}</span>
                @endif</div>
                <p>{{ $course['course_desc'] }}</p>
                <div class="text-secondary">
                    <i class="fa fa-comment-o" aria-hidden="true"></i> {{ count($comments) }} Comments 
                    <i class="fa fa-user-o" aria-hidden="true"></i> {{ $enrolls[0]['enrolls'] }} Enrolled Students
                </div>
                @if (empty($enrolled))
                    <a href="{{ url('/student/enroll/' . $course['course_code']) }}" class="btn btn-purple btn-flat">Enroll</a>
                @else
                    <a href="{{ url('/student/unenroll/' . $course['course_code']) }}" class="btn btn-danger btn-flat">Unenroll</a>
                @endif
            </div>
            
            <div class="col-md-6">
                <!--Card-->
                <div class="card testimonial-card text-center bg-dark">

                    <!--Bacground color-->
                    <div class="card-up indigo lighten-1">
                    </div>

                    <!--Avatar-->
                    <div class="avatar"><img style="max-width: 150px;" src="@if ($course['prof_image'] == '')
                        {{ asset('images/professor_default.png') }}
                        @else
                        {{ Storage::disk('local')->url($course['prof_image']) }}
                    @endif" class="rounded-circle">
                    </div>

                    <div class="card-body">
                        <!--Name-->
                        <h4 class="card-title">Professor: {{ $course['prof_name'] }}</h4>
                        <hr>
                        <!--Quotation-->
                        <p><i class="fa fa-envelope-o"></i> {{ $course['prof_email'] }}</p>
                        @if ($course['prof_mobile'] != '')
                            <p><i class="fa fa-mobile"></i> {{ $course['prof_mobile'] }}</p>
                        @endif
                        @if ($course['prof_address'])
                            <p><i class="fa fa-address-card-o"></i> {{ $course['prof_address'] }}</p>
                        @endif
                    </div>

                </div>
                <!--/.Card-->
            </div>

        </div>
    </div>
</div>

<div class="container pt-3">
    <div class="row">
            <div class="col-sm-12">
                <!--Section: Social newsfeed v.1-->
                @foreach($comments as $comment)
                <?php $comment = (object) $comment; ?>
                <section class="pt-3 pb-3 card-body-custom">

                    <!--Newsfeed-->
                    <div class="mdb-feed">
                        <!--Fourth news-->
                        <div class="news media">

                            <!--Label-->
                            <div class="label">
                                <img src="@if ($comment->student_image == '')
                                    {{ asset('/images/student_default.jpg') }}
                                @else
                                {{ Storage::disk('local')->url($comment->student_image) }}
                                @endif" class="rounded-circle z-depth-1-half">
                            </div>
    
                            <!--Excert-->
                            <div class="excerpt media-body">

                                <!--Brief-->
                                <div class="brief">
                                    <a href="#" class="name">{{ $comment->student_name }}</a>
                                    <div class="date"><small>{{ Carbon\Carbon::createFromTimestamp(strtotime($comment->updated_at))->diffForHumans() }}</small></div>
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
            
                @auth
                 <!--Comment input-->
                <div class="md-form">
                    <form action="{{ url('/student/comment/' . $course['course_code']) }}" method="POST">
                        {{ csrf_field() }}
                        <div class="avatar prefix mr-3"><img style="max-width: 40px;" src="@if (Auth::user()->image == '')
                            {{ asset('images/student_default.jpg') }}
                            @else
                            {{ Storage::disk('local')->url(Auth::user()->image) }}
                        @endif" class="rounded-circle">
                        </div>
                        <input placeholder="Add Comment..." type="text" id="form5" style="margin-right: 50px;" class="form-control ml-7" name="content">
                    </form>
                </div>
                @endauth

            </div>
        </div>
</div>
        

@endsection

@section('footer')	

@endsection