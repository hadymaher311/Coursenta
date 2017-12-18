<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StudentsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:employee');
    }

    public function index()
    {
    	$con = DB::connection()->getPdo();
    	$stmt = $con->prepare('SELECT * FROM students ORDER BY students.id DESC');
    	$stmt->execute();
    	$students = $stmt->fetchAll();
    	return view('employee.students.students', compact('students'));
    }

    public function create()
    {
    	return view('employee.students.new');
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
            'username'=> [
                'string',
                'required',
                'max:30',
                Rule::unique('students'),
            ],
            'email'=> [
                'email',
                'required',
                'max:100',
                Rule::unique('students'),
            ],
            'name' => 'string|required',
            'school' => 'string|required|max:50',
            'address' => 'string|required',
            'mobile'=> 'numeric|required',
            'date'=> 'date|required',
            'password'=> 'string|required|confirmed',
        ]);

		$con = DB::connection()->getPdo();
    	$stmt = $con->prepare('INSERT INTO students (name, username, email, mobile_number, password, school, address, date_of_birth, status, created_at, updated_at) VALUES(:name, :username, :email, :mobile_number, :password, :school, :address, :date_of_birth, :status, :created_at, :updated_at)');
    	$stmt->execute(array(
    		':name' => $request->name,
    		':username' => $request->username,
    		':email' => $request->email,
    		':mobile_number' => $request->mobile,
    		':password' => Hash::make($request->password),
    		':school' => $request->school,
    		':address' => $request->address,
    		':date_of_birth' => Carbon::createFromTimestamp(strtotime($request->date))->toDateString(),
    		':status' => 1,
    		'created_at' => Carbon::now(), 
    		'updated_at' => Carbon::now(),
    	));
    	if ($stmt) {
	        return redirect('employee/students')->with('status', 'Added Successfully');
    	} else {
    		return back()->with('error', 'There is Some Errors');
    	}
    }
}
