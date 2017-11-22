<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Session;
use App\Mail\varifyEmail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:191',
            'username' => 'required|string|max:30|unique:students',
            'email' => 'required|string|email|max:100|unique:students',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        Session::flash('status', 'Registered! go to your mailbox to activate your account');
        $user = Student::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'varify_token' => Str::random(40),
        ]);
        $thisUser = Student::findOrFail($user->id);
        $this->sendVarifyEmail($thisUser);
        return $thisUser;
    }

    public function sendVarifyEmail($thisUser)
    {
        Mail::to($thisUser->email)->send(new varifyEmail($thisUser));
    }

    public function varefied($email, $token)
    {
        $student = Student::where(['email' => $email, 'varify_token' => $token])->first();
        if ($student) {
            Student::where(['email' => $email, 'varify_token' => $token])->update(['status' => '1', 'varify_token' => NULL]);
            Session::flash('status', 'Varified, Just login');
            return redirect(route('login'));
        }
        else {
            abort(404);
        }
    }

}
