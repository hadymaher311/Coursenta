<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminsController extends Controller
{
    // middleware of admin
     // * not access any functionality of this controller for not auth as admin
    public function  __construct()
	{
		$this->middleware('auth:admin');
	}

    // preview admins data to admin
	public function index()
	{
		$con = DB::connection()->getPdo();
    	$stmt = $con->prepare('SELECT * FROM admins ORDER BY admins.id DESC');
    	$stmt->execute();
    	$admins = $stmt->fetchAll();
    	return view('admin.admins.admins', compact('admins'));
	}

    // get page to add new professor
	public function show()
	{
		return view('admin.admins.new');
	}

	 // add new admin  data
	public function store(Request $request)
	{
		$this->validate($request, [
            'username'=> [
                'string',
                'required',
                'max:30',
                Rule::unique('admins'),
            ],
            'email'=> [
                'email',
                'required',
                'max:100',
                Rule::unique('admins'),
            ],
            'mobile'=> 'numeric|required',
            'password'=> 'string|required|confirmed',
        ]);

		$con = DB::connection()->getPdo();
    	$stmt = $con->prepare('INSERT INTO admins (username, email, mobile_number, password, created_at, updated_at) VALUES(:username, :email, :mobile_number, :password, :created_at, :updated_at)');
    	$stmt->execute(array(
    		':username' => $request->username,
    		':email' => $request->email,
    		':mobile_number' => $request->mobile,
    		':password' => Hash::make($request->password),
    		'created_at' => \Carbon\Carbon::now(), 
    		'updated_at' => \Carbon\Carbon::now(),
    	));
    	if ($stmt) {
	        return redirect('admin/admins')->with('status', 'Added Successfully');
    	} else {
    		return back()->with('error', 'There is Some Errors');
    	}
	}

}
