<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class studentController extends Controller
{	
	 public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    	$con = DB::connection()->getPdo();
    	$stmt = $con->prepare("SELECT * FROM courses INNER JOIN attends ON attends.course_code = courses.code WHERE student_id = ?");	
    	$stmt->execute(array(Auth::user()->id));
    	$courses = $stmt->fetchAll();
    	$stmt = $con->prepare("SELECT comments.updated_at, comments.content, courses.name FROM comments INNER JOIN courses ON courses.code = comments.course_code WHERE student_id = ?");	
    	$stmt->execute(array(Auth::user()->id));
    	$comments = $stmt->fetchAll();
    	return view('student.profile', compact('courses', 'comments'));
    }

    public function photo(Request $request)
    {
        $this->validate($request, [
            'profile_photo' => 'image|required',
        ]);
        $image = $request->profile_photo->store('public/student/' . Auth::id());
        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('UPDATE students SET image = ? WHERE id = ?');
        $stmt->execute(array($image, Auth::id()));
        return back();
    }
    
    public function update_info(Request $request)
    {
        $this->validate($request, [
            'username'=> [
                'string',
                'max:30',
                Rule::unique('students')->ignore(Auth::id()),
            ],
            'email'=> [
                'email',
                'max:100',
                Rule::unique('students')->ignore(Auth::id()),
            ],
            'mobile_number'=> 'numeric|required',
            //'password'=> 'string|confirmed',       
        ]);

        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('UPDATE students SET username = ?,name = ? , email = ?,mobile_number = ?,school = ?,address = ?,date_of_birth = ?,password = ? WHERE id = ? ');
        $stmt->execute(array($request->username, $request->name, $request->email,$request->mobile_number,$request->school ,$request->address ,$request->date_of_birth ,Hash::make($request->password), Auth::id())); 
        $this->index();       
        return back();
    }
}
