<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BranchesController extends Controller
{
    // middleware of admin
     // * not access any functionality of this controller for not auth as admin
    public function  __construct()
	{
		$this->middleware('auth:admin');
	}

	// preview branches data for admin
	public function index()
	{
		$con = DB::connection()->getPdo();
    	$stmt = $con->prepare('SELECT * FROM branches ORDER BY branches.code DESC');
    	$stmt->execute();
    	$branches = $stmt->fetchAll();
    	return view('admin.branches.branches', compact('branches'));
	}

	// get the page for the admin to add new branch
	public function create()
	{
		return view('admin.branches.new');
	}

	// adding new branch into database
	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|string',
			'address' => 'required|string',
			'mobile_number' => 'required|numeric',
			'room_number' => 'required|numeric',
		]);
		$con = DB::connection()->getPdo();
    	$stmt = $con->prepare('INSERT INTO branches (name, address, room_number, mobile_number, created_at, updated_at) VALUES (:name, :address, :room_number, :mobile_number, :created_at, :updated_at)');
    	$stmt->execute(array(
    		':name' => $request->name, 
    		':address' => $request->address, 
    		':room_number' => $request->room_number, 
    		':mobile_number' => $request->mobile_number, 
    		':created_at' => Carbon::now(),
    		':updated_at' => Carbon::now(),
    	));
    	if ($stmt) {
	        return redirect('admin/branches')->with('status', 'Added Successfully');
    	} else {
    		return back()->with('error', 'There is Some Errors');
    	}
	}

	public function edit($branch)
	{
		$con = DB::connection()->getPdo();
    	$stmt = $con->prepare('SELECT * FROM branches WHERE branches.code = ?');
    	$stmt->execute(array($branch));
    	$branch = $stmt->fetch();
    	if ($branch) {
    		$branch = (object)$branch;
			return view('admin.branches.update', compact('branch'));
    	}
    	return back();
	}

	public function update(Request $request, $branch)
	{
		$this->validate($request, [
			'name' => 'required|string',
			'address' => 'required|string',
			'mobile_number' => 'required|numeric',
			'room_number' => 'required|numeric',
		]);
		$con = DB::connection()->getPdo();
		$stmt = $con->prepare('UPDATE branches SET name = ?, address = ?, mobile_number = ?, room_number = ?, updated_at = ? WHERE branches.code = ?');
    	$stmt->execute(array($request->name, $request->address, $request->mobile_number, $request->room_number, Carbon::now(), $branch));
    	if ($stmt) {
	        return redirect('admin/branches')->with('status', 'Updated Successfully');
    	} else {
    		return back()->with('error', 'There is Some Errors');
    	}
	}

	public function destroy(Request $request, $branch)
	{
		Validator::make(array('branch' => $branch),[
            'branch' => 'exists:branches,branch_code',
        ]);

        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('DELETE FROM branches WHERE branches.code = ?');
        $stmt->execute(array($branch));
        if ($stmt) {
            return redirect('admin/branches')->with('status', 'Deleted Successfully');
        }
        return redirect('admin/branches')->with('error', 'There is Some Errors');
	}

}
