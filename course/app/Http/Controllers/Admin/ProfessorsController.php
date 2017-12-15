<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfessorsController extends Controller
{
    // middleware of admin
     // * not access any functionality of this controller for not auth as admin
    public function  __construct()
	{
		$this->middleware('auth:admin');
	}

    // preview professors data to admin
	public function index()
	{
		$con = DB::connection()->getPdo();
    	$stmt = $con->prepare('SELECT * FROM professors ORDER BY professors.id DESC');
    	$stmt->execute();
    	$professors = $stmt->fetchAll();
    	return view('admin.professors.professors', compact('professors'));
	}

    // get page to add new professor
	public function show()
	{
		return view('admin.professors.new');
	}

    // add new professor  data
	public function store(Request $request)
	{
		$this->validate($request, [
            'username'=> [
                'string',
                'required',
                'max:30',
                Rule::unique('professors'),
            ],
            'email'=> [
                'email',
                'required',
                'max:100',
                Rule::unique('professors'),
            ],
            'name' => 'string|required',
            'field' => 'string|required|max:50',
            'mobile'=> 'numeric|required',
            'password'=> 'string|required|confirmed',
        ]);

		$con = DB::connection()->getPdo();
    	$stmt = $con->prepare('INSERT INTO professors (name, username, email, mobile_number, password, field, address, created_at, updated_at) VALUES(:name, :username, :email, :mobile_number, :password, :field, :address, :created_at, :updated_at)');
    	$stmt->execute(array(
    		':name' => $request->name,
    		':username' => $request->username,
    		':email' => $request->email,
    		':mobile_number' => $request->mobile,
    		':password' => Hash::make($request->password),
    		':field' => $request->field,
    		':address' => $request->address,
    		'created_at' => \Carbon\Carbon::now(), 
    		'updated_at' => \Carbon\Carbon::now(),
    	));
    	if ($stmt) {
	        return redirect('admin/professors')->with('status', 'Added Successfully');
    	} else {
    		return back()->with('error', 'There is Some Errors');
    	}
	}

}
