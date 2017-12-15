<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RoomsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('SELECT rooms.*, branches.name as branch_name FROM rooms,branches WHERE rooms.branch_code = branches.code ORDER BY number DESC');
        $stmt->execute();
        $rooms = $stmt->fetchAll();
        return view('admin.rooms.rooms', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('SELECT branches.code, branches.name FROM branches');
        $stmt->execute();
        $branches = $stmt->fetchAll();
        return view('admin.rooms.new', compact('branches'));
    }

    private $branch = 0;
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->branch = $request->branch;
        $this->validate($request, [
            'branch' => 'required|numeric|exists:branches,code',
            'number' => [
                'required',
                'numeric',
                Rule::unique('rooms')->where(function ($query) {
                    return $query->where('branch_code', $this->branch);
                })
            ],
            'capacity' => 'required|numeric',
            'AC' => 'required|boolean',
            'projector' => 'required|boolean',
        ]);
        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('INSERT INTO rooms (number, branch_code, capacity, AC, projector, created_at, updated_at) VALUES (:number, :branch_code, :capacity, :AC, :projector, :created_at, :updated_at)');
        $stmt->execute(array(
            ':number' => $request->number, 
            ':branch_code' => $request->branch, 
            ':capacity' => $request->capacity, 
            ':AC' => $request->AC, 
            ':projector' => $request->projector, 
            ':created_at' => \Carbon\Carbon::now(), 
            ':updated_at' => \Carbon\Carbon::now(), 
        ));
        if ($stmt) {
            return redirect('admin/rooms')->with('status', 'Added Successfully');
        }
        return back()->with('error', 'There is Some Errors');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
