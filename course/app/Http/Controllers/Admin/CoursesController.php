<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoursesController extends Controller
{
    // middleware of admin
     // * not access any functionality of this controller for not auth as admin
	public function  __construct()
	{
		$this->middleware('auth:admin');
	}

    // preview courses data for admin 
    public function index()
    {
    	$con = DB::connection()->getPdo();
    	$stmt = $con->prepare('SELECT courses.* ,professors.name as professor_name FROM courses, professors WHERE courses.professor_id = professors.id ORDER BY courses.code DESC');
    	$stmt->execute();
    	$courses = $stmt->fetchAll();
    	return view('admin.courses.courses', compact('courses'));
    }

    // verify course with admin
    public function verify(Request $request, $id)
    {
    	$con = DB::connection()->getPdo();
    	$stmt = $con->prepare('UPDATE courses SET courses.verified = 1 WHERE courses.code = ?');
    	$stmt->execute(array($id));
    	return back();
    }

    // get course stats
    public function stats(Request $request)
    {
        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('SELECT courses.code, courses.name FROM courses');
        $stmt->execute();
        $courses = $stmt->fetchAll();
        
        $stmt = $con->prepare('SELECT courses.name FROM courses WHERE courses.code = ?');
        $stmt->execute(array($request->course));
        $course = $stmt->fetch();
        
        $stmt = $con->prepare('SELECT students.name, COUNT(*) as comments_count FROM comments JOIN students ON student_id = students.id WHERE course_code = ? GROUP BY students.name');
        $stmt->execute(array($request->course));
        $data = $stmt->fetchAll();

        // return $data;

        return view('admin.courses.stats', compact('courses', 'course', 'data'));
    }
}
