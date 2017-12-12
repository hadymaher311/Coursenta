<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
}
