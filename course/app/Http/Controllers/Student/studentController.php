<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class studentController extends Controller
{	
	 public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    	return view('student.profile');
    }
}
