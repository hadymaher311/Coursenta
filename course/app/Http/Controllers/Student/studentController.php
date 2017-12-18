<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
     public function courseview()
    {
        $con = DB::connection()->getPdo();
        $stmt=$con->prepare("SELECT courses.name,courses.code,courses.cost,courses.offer_cost ,professors.name as prof_name, professors.image as prof_image FROM professors,courses WHERE professors.id = courses.professor_id AND courses.verified = 1 ");
        $stmt->execute();
        $courses = $stmt->fetchAll();
        return view ('student.coursesview',compact('courses'));
    }

     public function commentview($id)
    {
         $con = DB::connection()->getPdo();
        $stmt = $con->prepare("SELECT comments.*, students.name as student_name ,students.image as student_image, courses.code as course_code, courses.name as course_name, courses.cost as course_cost, courses.offer_cost as course_offer, courses.describtion as course_desc, professors.name as prof_name, professors.image as prof_image, professors.email as prof_email, professors.mobile_number as prof_mobile, professors.address as prof_address FROM students,courses INNER JOIN comments ON comments.course_code = courses.code INNER JOIN professors ON courses.professor_id = professors.id WHERE students.id = comments.student_id AND courses.code = ? AND courses.verified = 1");
        $stmt->execute(array($id));
        $comments = $stmt->fetchAll();

        $stmt = $con->prepare('SELECT * FROM attends WHERE attends.student_id = ? AND attends.course_code = ?');
        $stmt->execute(array(Auth::id(), $id));
        $enrolled = $stmt->fetch();

        $stmt = $con->prepare('SELECT COUNT(attends.student_id) as enrolls FROM attends WHERE attends.course_code = ?');
        $stmt->execute(array($id));
        $enrolls = $stmt->fetchAll();
        if (empty($comments)) {
            return back();
        }
        return view ('student.commentsview',compact('comments', 'enrolled', 'enrolls'));
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
        return back();
    }


    public function enroll($course)
    {
        Validator::make(array('course_code' => $course), [
            'course_code' => [
                'required',
                'numeric',
                Rule::unique('attdends')->where(function ($query) {
                    return $query->where('student_id', Auth::id());
                }),
                'exists:course,code',
            ],
        ]);

        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('INSERT INTO attends(course_code, student_id, created_at, updated_at) VALUES(:course_code, :student_id, :created_at, :updated_at)');
        $stmt->execute(array($course, Auth::id(), Carbon::now(), Carbon::now()));

        if ($stmt) {
            return back()->with('status', 'Enrolled Successfully');
        } else {
            return back()->with('error', 'There is Some Errors');
        }

    }

    public function unenroll($course)
    {
        Validator::make(array('course_code' => $course), [
            'course_code' => [
                'required',
                'numeric',
                'exists:attends,course_code',
            ],
        ]);

        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('DELETE FROM attends WHERE attends.course_code = ? AND attends.student_id = ?');
        $stmt->execute(array($course, Auth::id()));

        if ($stmt) {
            return back()->with('status', 'Unenrolled Successfully');
        } else {
            return back()->with('error', 'There is Some Errors');
        }
    }


    // comment on course
    public function comment(Request $request, $course)
    {
        $request['course'] = $course;
        $this->validate($request, [
            'content' => 'string|required',
            'course' => 'numeric|required|exists:courses,code',
        ]);

        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('INSERT INTO comments (student_id, course_code, content, created_at, updated_at) VALUES(:student_id, :course_code, :content, :created_at, :updated_at)');
        $stmt->execute(array(Auth::id(), $request->course, $request->content, Carbon::now(), Carbon::now()));

        if ($stmt) {
            return back()->with('status', 'Commented Successfully');
        } else {
            return back()->with('error', 'There is Some Errors');
        }

    }

}
