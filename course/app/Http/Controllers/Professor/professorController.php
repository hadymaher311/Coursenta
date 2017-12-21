<?php

namespace App\Http\Controllers\Professor;


use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class professorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:professor');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    // get professor profile
    public function index()
    {
        $con = DB::connection()->getPdo();
        $stmt = $con->prepare("SELECT * FROM courses WHERE courses.professor_id = ?");   
        $stmt->execute(array(Auth::id()));
        $courses = $stmt->fetchAll();
        return view('professor.profile', compact('courses'));
    }

    public function photo(Request $request)
    {
        $this->validate($request, [
            'profile_photo' => 'image|required',
        ]);
        $image = $request->profile_photo->store('public/professor/' . Auth::id());
        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('UPDATE professors SET image = ?, updated_at = ? WHERE id = ?');
        $stmt->execute(array($image, Carbon::now(), Auth::id()));
        return back();
    }

    public function update_info(Request $request)
    {
        $this->validate($request, [
            'username'=> [
                'required',
                'string',
                'max:30',
                Rule::unique('professors')->ignore(Auth::id()),
            ],
            'email'=> [
                'required',
                'email',
                'max:100',
                Rule::unique('professors')->ignore(Auth::id()),
            ],
            'mobile_number'=> 'numeric|required',
            'field'=> 'required',
            'password' => 'required'
        ]);

        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('UPDATE professors SET username = ?,name = ? , email = ?,mobile_number = ?,field = ?,address = ?,password = ?, updated_at = ? WHERE id = ? ');
        $stmt->execute(array($request->username, $request->name, $request->email,$request->mobile_number,$request->field,$request->address  ,Hash::make($request->password), Carbon::now(), Auth::id())); 
        return back();
    }

    // add new course
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'string|required',
            'cost' => 'numeric|required',
            'offer_cost' => 'numeric|required|max:' . $request->cost,
            'sessions_number' => 'numeric|required',
            'description' => 'string|required',
        ]);

        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('INSERT INTO courses (name, cost, offer_cost, sessions_number, describtion, professor_id, created_at, updated_at) VALUES(:name, :cost, :offer_cost, :sessions_number, :describtion, :professor_id, :created_at, :updated_at)');
        $stmt->execute(array(
            ':name' => $request->name, 
            ':cost' => $request->cost, 
            ':offer_cost' => $request->offer_cost, 
            ':sessions_number' => $request->sessions_number, 
            ':describtion' => $request->description, 
            ':professor_id' => Auth::id(), 
            ':created_at' => Carbon::now(), 
            ':updated_at' => Carbon::now(),
        ));

        if ($stmt) {
            return back()->with('status', 'Add successfully!');
        }
        return back()->with('error', 'Some Errors!');

    }

    private $subject = '';
    // send Email to center 
    public function sendEmail(Request $request)
    {
        $this->validate($request, [
            'subject' => 'string|required',
            'message' => 'string|required',
        ]);

        $file = fopen("../resources/views/test.blade.php","w");
        $txt = 'Professor ' . Auth::user()->name . ' Says ';
        fwrite($file,$txt . $request->message);
        fclose($file);

        $this->subject = $request->subject;

        
        Mail::send(['text' => 'test'], ['name' => Auth::user()->name], function($message) {
            $message->to('databasepro31@gmail.com', 'to Coursenta')->subject($this->subject);
            $message->from(Auth::user()->email, Auth::user()->name);
        });

        if (Mail::failures()) {
            return back()->with('error', 'Some errors occurs');
        }

        return back()->with('status', 'Sent Successfully!');

    }

}
