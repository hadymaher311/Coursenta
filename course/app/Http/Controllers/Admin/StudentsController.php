<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
    public function  __construct()
	{
		$this->middleware('auth:admin');
	}

	public function index()
	{
		$con = DB::connection()->getPdo();
    	$stmt = $con->prepare('SELECT * FROM students ORDER BY students.id DESC');
    	$stmt->execute();
    	$students = $stmt->fetchAll();
    	return view('admin.students.students', compact('students'));
	}
}
