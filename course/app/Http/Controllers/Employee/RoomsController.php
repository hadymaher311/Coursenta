<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RoomsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:employee');
    }

    public function index()
    {
    	$con = DB::connection()->getPdo();
        $stmt = $con->prepare('SELECT rooms.*, branches.name as branch_name FROM rooms,branches WHERE rooms.branch_code = ? AND rooms.branch_code = branches.code ORDER BY number DESC');
        $stmt->execute(array(Auth::user()->branch_code));
        $rooms = $stmt->fetchAll();
        return view('employee.rooms.rooms', compact('rooms'));
    }


    // get page to edit room data
    public function edit($room)
    {
        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('SELECT * FROM rooms WHERE rooms.number = ? AND rooms.branch_code = ? LIMIT 1');
        $stmt->execute(array($room, Auth::user()->branch_code));
        $room = $stmt->fetch();
        if ($room) {
            $room = (object) $room;
            return view('employee.rooms.update', compact('room'));
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // update room data
    public function update(Request $request, $room)
    {
        $this->validate($request, [
            'number' => [
                'required',
                'numeric',
                // unique room number for same branch but ignore this room number
                Rule::unique('rooms')->where(function ($query) {
                    return $query->where('branch_code', Auth::user()->branch_code);
                })->ignore($room, 'number')
            ],
            'capacity' => 'required|numeric',
            'AC' => 'required|boolean',
            'projector' => 'required|boolean',
        ]);

        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('UPDATE rooms SET number = ?, capacity = ?, AC = ?, projector = ?, updated_at = ? WHERE number = ? AND branch_code = ?');
        $stmt->execute(array($request->number, $request->capacity, $request->AC, $request->projector, \Carbon\Carbon::now(), $room, Auth::user()->branch_code));
        if ($stmt) {
            return redirect('employee/rooms')->with('status', 'Updated Successfully');
        }
        return back()->with('error', 'There is Some Errors');
    }


    public function stats(Request $request)
    {
        $this->validate($request, [
            'room' => 'exists:rooms,number',
        ]);
        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('SELECT timetables.id, timetables.start_date, timetables.end_date, courses.name, rooms.number FROM timetables, rooms, courses WHERE  timetables.course_code = courses.code AND timetables.room_number = rooms.number AND  timetables.room_number = ? AND rooms.branch_code = ?');
        $stmt->execute(array($request->room, Auth::user()->branch_code));
        $timetables = $stmt->fetchAll();

        $stmt = $con->prepare('SELECT rooms.number FROM rooms WHERE rooms.branch_code = ? ');
        $stmt->execute(array(Auth::user()->branch_code));
        $rooms = $stmt->fetchAll();

        return view('employee.rooms.stats', compact('timetables', 'rooms'));
    }

}
