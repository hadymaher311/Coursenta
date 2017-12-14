<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class adminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses_count = $this->getcount('code', 'courses');
        $professors_count = $this->getcount('id', 'professors');
        $students_count = $this->getcount('id', 'students');
        $employees_count = $this->getcount('id', 'employees');

        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('SELECT courses.code as course_code, courses.name as course_name, courses.updated_at as course_time, courses.describtion, professors.name as prof_name, professors.image as prof_image, professors.id as prof_id FROM courses, professors WHERE courses.professor_id = professors.id ORDER BY courses.code DESC LIMIT 2');
        $stmt->execute();
        $courses = $stmt->fetchAll();

        $comments = array();
        foreach ($courses as $course) {
            $stmt = $con->prepare('SELECT comments.content, comments.updated_at, students.name, students.image FROM comments INNER JOIN students ON comments.student_id = students.id WHERE comments.course_code = ' . $course['course_code']);
            $stmt->execute();
            array_push($comments, $stmt->fetchAll());
        }
        // return $comments;
        return view('admin.home', compact('courses_count', 'professors_count', 'students_count', 'employees_count', 'courses', 'comments'));
    }

    private function getcount($count, $from)
    {
        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('SELECT COUNT(' . $from . '.' . $count . ') FROM ' . $from);
        $stmt->execute();
        return $stmt->fetch()['COUNT(' . $from . '.' . $count . ')'];
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function photo(Request $request)
    {
        // return $request->file('profile_photo');
        $image = $request->profile_photo->store('public/admins/' . Auth::id());
        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('UPDATE admins SET image = ? WHERE id = ?');
        $stmt->execute(array($image, Auth::id()));
        return back();
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'username'=> [
                'string',
                'required',
                'max:30',
                Rule::unique('admins')->ignore(Auth::id()),
            ],
            'email'=> [
                'email',
                'required',
                'max:100',
                Rule::unique('admins')->ignore(Auth::id()),
            ],
            'mobile'=> 'numeric|required',
            'password'=> 'string|required|confirmed',
        ]);

        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('UPDATE admins SET username = ?, email = ?, mobile_number = ?, password = ? WHERE id = ?');
        $stmt->execute(array($request->username, $request->email, $request->mobile, Hash::make($request->password), Auth::id()));
        return back();
    }

}
