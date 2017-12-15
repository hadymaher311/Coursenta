<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EmployeesController extends Controller
{
    // middleware of admin
     // * not access any functionality of this controller for not auth as admin
    public function  __construct()
	{
		$this->middleware('auth:admin');
	}

    // preview employees data for admin
	public function index()
	{
		$con = DB::connection()->getPdo();
    	$stmt = $con->prepare('SELECT * FROM employees ORDER BY employees.id DESC');
    	$stmt->execute();
    	$employees = $stmt->fetchAll();
    	return view('admin.employees.employees', compact('employees'));
	}

    // get page to add new employee
	public function show()
	{
		$con = DB::connection()->getPdo();
    	$stmt = $con->prepare('SELECT branches.code, branches.name FROM branches');
    	$stmt->execute();
    	$branches = $stmt->fetchAll();
		return view('admin.employees.new', compact('branches'));
	}

    // add new employee
	public function store(Request $request)
	{
		$this->validate($request, [
            'username'=> [
                'string',
                'required',
                'max:30',
                Rule::unique('employees'),
            ],
            'email'=> [
                'email',
                'required',
                'max:100',
                Rule::unique('employees'),
            ],
            'name' => 'string|required',
            'position' => 'string|required',
            'salary' => 'numeric|required',
            'mobile'=> 'numeric|required',
            'branch'=> 'numeric|required',
            'password'=> 'string|required|confirmed',
        ]);

		$con = DB::connection()->getPdo();
    	$stmt = $con->prepare('INSERT INTO employees (name, username, email, mobile_number, password, salary, address, position, branch_code, created_at, updated_at) VALUES(:name, :username, :email, :mobile_number, :password, :salary, :address, :position, :branch_code, :created_at, :updated_at)');
    	$stmt->execute(array(
    		':name' => $request->name,
    		':username' => $request->username,
    		':email' => $request->email,
    		':mobile_number' => $request->mobile,
    		':password' => Hash::make($request->password),
    		':salary' => $request->salary,
    		':address' => $request->address,
    		':position' => $request->position,
    		':branch_code' => $request->branch,
    		'created_at' => \Carbon\Carbon::now(), 
    		'updated_at' => \Carbon\Carbon::now(),
    	));
    	if ($stmt) {
	        return redirect('admin/employees')->with('status', 'Added Successfully');
    	} else {
    		return back()->with('error', 'There is Some Errors');
    	}
	}

}
