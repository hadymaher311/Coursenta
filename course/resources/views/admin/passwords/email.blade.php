@extends('layouts.layout')

@section('title')
Reset Admin Password
@endsection

@section('head')
    
@endsection

@section('body')
    <div class="container">
        <div class="row align-items-center full" style="padding: 30px 0;">
            <div class="col-md-5 ml-auto mr-auto">
                @if (session('status'))
                    <div class="card text-white bg-info mb-3">
                        <div class="card-header wow">{{ session('status') }}</div>
                    </div>
                @endif
                @if ($errors->has('status'))
                    <div class="card text-white bg-danger mb-3">
                        <div class="card-header wow">{{ $errors->first('status') }}</div>
                    </div>
                @endif
                <h2 class="text-center wow fadeInRight">Admin Reset Password</h2>
                <form method="POST" action="{{ route('admin.password.email') }}">
                    {{ csrf_field() }}
                    <div class="md-form{{ $errors->has('email') ? ' has-error' : '' }}">
                        <i class="fa fa-envelope prefix"></i>
                        <input type="email" id="form2" class="form-control validate" value="{{ old('email') }}" name="email">
                        <label for="form2" data-error="
                            @if ($errors->has('email'))
                                {{ $errors->first('email') }}
                            @else
                                {{ 'Enter valid email' }}
                            @endif
                        " data-success="right">Email</label>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-purple">
                            <i class="fa fa-sign-in" aria-hidden="true"></i> 
                            Send Password Reset Link
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection


@section('footer')

    <script>
        $(".full").height($(window).height() - 116);
        $(window).on("resize", function() {
            $(".full").height($(window).height() - 116);
        });
    </script>

@endsection
