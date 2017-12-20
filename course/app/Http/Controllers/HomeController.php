<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses_count = $this->getcount('code', 'courses');
        $rooms_count = $this->getcount('number', 'rooms');
        $students_count = $this->getcount('id', 'students');

        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('SELECT * FROM courses WHERE courses.verified = 1 ORDER BY code DESC LIMIT 3');
        $stmt->execute();
        $courses = $stmt->fetchAll();

        $stmt = $con->prepare('SELECT professors.name, professors.field, professors.image FROM professors ORDER BY id DESC LIMIT 4');
        $stmt->execute();
        $professors = $stmt->fetchAll();

        return view('homepage', compact('courses_count', 'rooms_count', 'students_count', 'courses', 'professors'));
    }

    // get count of table with column
    private function getcount($column, $table)
    {
        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('SELECT COUNT(' . $table . '.' . $column . ') FROM ' . $table);
        $stmt->execute();
        return $stmt->fetch()['COUNT(' . $table . '.' . $column . ')'];
    }

    // view all courses
    public function courseview()
    {
        $con = DB::connection()->getPdo();
        $stmt=$con->prepare("SELECT courses.name,courses.code,courses.cost,courses.offer_cost ,professors.name as prof_name, professors.image as prof_image FROM professors,courses WHERE professors.id = courses.professor_id AND courses.verified = 1 ");
        $stmt->execute();
        $courses = $stmt->fetchAll();
        return view ('student.coursesview',compact('courses'));
    }

    // view one course
     public function commentview($id)
    {
        // $con = DB::connection()->getPdo();
        // // $stmt = $con->prepare("SELECT comments.*, students.name as student_name ,students.image as student_image, courses.code as course_code, courses.name as course_name, courses.cost as course_cost, courses.offer_cost as course_offer, courses.describtion as course_desc, professors.name as prof_name, professors.image as prof_image, professors.email as prof_email, professors.mobile_number as prof_mobile, professors.address as prof_address FROM students,courses INNER JOIN comments ON comments.course_code = courses.code INNER JOIN professors ON courses.professor_id = professors.id WHERE students.id = comments.student_id AND courses.code = ? AND courses.verified = 1");
        // $stmt->execute(array($id));
        // $comments = $stmt->fetchAll();

        $con = DB::connection()->getPdo();
        // get the course
        $stmt = $con->prepare('SELECT courses.code as course_code, courses.name as course_name, courses.describtion as course_desc, professors.name as prof_name, professors.image as prof_image, professors.email as prof_email, professors.mobile_number as prof_mobile, professors.address as prof_address, courses.cost as course_cost, courses.offer_cost as course_offer FROM courses, professors WHERE courses.professor_id = professors.id AND courses.code = ? AND courses.verified = 1 LIMIT 1');
        $stmt->execute(array($id));
        $course = $stmt->fetch();

        // if this course ids not exists return back to last page
        if (empty($course)) {
            return back();
        }

        // get the comments on this course
        $stmt = $con->prepare('SELECT comments.content, comments.updated_at, students.name as student_name , students.image as student_image FROM comments INNER JOIN students ON comments.student_id = students.id WHERE comments.course_code = ?');
        $stmt->execute(array($id));
        $comments = $stmt->fetchAll();

        // check if this student is enrolled
        $stmt = $con->prepare('SELECT * FROM attends WHERE attends.student_id = ? AND attends.course_code = ?');
        $stmt->execute(array(Auth::id(), $id));
        $enrolled = $stmt->fetch();

        // get number of enrolled students
        $stmt = $con->prepare('SELECT COUNT(attends.student_id) as enrolls FROM attends WHERE attends.course_code = ?');
        $stmt->execute(array($id));
        $enrolls = $stmt->fetchAll();
        
        return view ('student.commentsview',compact('comments', 'enrolled', 'enrolls', 'course'));
    }
}
