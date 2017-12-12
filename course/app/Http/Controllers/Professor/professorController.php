<?php

namespace App\Http\Controllers\Professor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    public function index()
    {
        /* $con = DB::connection()->getPdo();
        $stmt = $con->prepare("SELECT * FROM professors  INNER JOIN attends ON attends.course_code = courses.code WHERE student_id = ?");   
        $stmt->execute(array(Auth::user()->id));
        $courses = $stmt->fetchAll();*/
        return view('professor.profile');
    }
}
