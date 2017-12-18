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
     * middleware of admin
     * not access any functionality of this controller for not auth as admin
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
    // get admin dashboard
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

        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('SELECT professors.id, professors.name FROM professors');
        $stmt->execute();
        $professors = $stmt->fetchAll();

        return view('admin.home', compact('courses_count', 'professors_count', 'students_count', 'employees_count', 'courses', 'comments', 'professors'));
    }

    // get count of table with column
    private function getcount($column, $table)
    {
        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('SELECT COUNT(' . $table . '.' . $column . ') FROM ' . $table);
        $stmt->execute();
        return $stmt->fetch()['COUNT(' . $table . '.' . $column . ')'];
    }

    // get admin profile
    public function profile()
    {
        return view('admin.profile');
    }

    // change admin photo
    public function photo(Request $request)
    {
        $image = $request->profile_photo->store('public/admins/' . Auth::id());
        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('UPDATE admins SET image = ?, updated_at = ? WHERE id = ?');
        $stmt->execute(array($image, \Carbon\Carbon::now(), Auth::id()));
        return back();
    }

    // update admin info
    public function update(Request $request)
    {
        $this->validate($request, [
            'username'=> [
                'string',
                'required',
                'max:30',
                // validae unique value for admin username except this admin
                Rule::unique('admins')->ignore(Auth::id()),
            ],
            'email'=> [
                'email',
                'required',
                'max:100',
                // validae unique value for admin email except this admin
                Rule::unique('admins')->ignore(Auth::id()),
            ],
            'mobile'=> 'numeric|required',
            'password'=> 'string|required|confirmed',
        ]);

        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('UPDATE admins SET username = ?, email = ?, mobile_number = ?, password = ?, updated_at = ? WHERE id = ?');
        $stmt->execute(array($request->username, $request->email, $request->mobile, Hash::make($request->password), \Carbon\Carbon::now(), Auth::id()));
        return back();
    }

}
