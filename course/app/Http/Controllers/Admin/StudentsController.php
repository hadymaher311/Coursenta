<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
	// middleware of admin
     // * not access any functionality of this controller for not auth as admin
    public function  __construct()
	{
		$this->middleware('auth:admin');
	}

	// preview students data for admin
	public function index()
	{
		$con = DB::connection()->getPdo();
    	$stmt = $con->prepare('SELECT * FROM students ORDER BY students.id DESC');
    	$stmt->execute();
    	$students = $stmt->fetchAll();
    	return view('admin.students.students', compact('students'));
	}

	// get professor stats
    public function stats(Request $request)
    {
        $this->validate($request, [
            'student' => 'numeric|required',
        ]);
        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('SELECT students.name, COUNT(*) as comments_count FROM comments JOIN students ON student_id = students.id GROUP BY students.name ORDER BY COUNT(*) DESC LIMIT ?');
        $stmt->execute(array($request->student));
        $students = $stmt->fetchAll();

        return view('admin.students.stats', compact('students'));
    }
}
