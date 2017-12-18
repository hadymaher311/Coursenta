<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
