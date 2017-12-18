<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class employeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Carbon::today();
        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('SELECT timetables.*, courses.name as course_name FROM timetables,courses WHERE timetables.branch_code = ? AND timetables.start_date > ? AND timetables.end_date < ? AND timetables.course_code = courses.code');
        $stmt->execute(array(Auth::user()->branch_code, Carbon::today(), Carbon::tomorrow()));
        $timetables = $stmt->fetchAll();
        $thisDate = Carbon::today();
        return view('employee.home', compact('timetables', 'thisDate'));
    }

    public function timetable(Request $request)
    {
        $date = Carbon::createFromTimestamp(strtotime($request->date));
        $nextDate = $date->addDay();
        $date = Carbon::createFromTimestamp(strtotime($request->date));
        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('SELECT timetables.*, courses.name as course_name FROM timetables,courses WHERE timetables.branch_code = ? AND timetables.start_date > ? AND timetables.end_date < ? AND timetables.course_code = courses.code');
        $stmt->execute(array(Auth::user()->branch_code, $date, $nextDate));
        $timetables = $stmt->fetchAll();
        $thisDate = $date;
        return view('employee.home', compact('timetables', 'thisDate'));
    }

    public function show()
    {
        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('SELECT courses.code, courses.name FROM courses');
        $stmt->execute();
        $courses = $stmt->fetchAll();
        $stmt = $con->prepare('SELECT rooms.number FROM rooms WHERE rooms.branch_code = ?');
        $stmt->execute(array(Auth::user()->branch_code));
        $rooms = $stmt->fetchAll();
        return view('employee.timetable.new', compact('courses', 'rooms'));
    }

    public function store(Request $request)
    {
        $start_date = Carbon::today()->setTime(intval(substr($request->start_time, 0, 2)), intval(substr($request->start_time, 3, 5)));
        $end_date = Carbon::today()->setTime(intval(substr($request->end_time, 0, 2)), intval(substr($request->end_time, 3, 5)));
        $request['start_date'] = $start_date;
        $request['end_date'] = $end_date;
        $this->validate($request, [
            'room' => [
                'required',
                'numeric',
                Rule::exists('rooms', 'number')->where(function ($query) {
                    return $query->where('branch_code', Auth::user()->branch_code);
                }),
            ],
            'course' => 'required|numeric|exists:courses,code',
            'date' => 'required|date|after_or_equal:' . Carbon::today(),
            'start_date' => 'before:end_date',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $start_date = \Carbon\Carbon::createFromTimestamp(strtotime($request->date))->setTime(intval(substr($request->start_time, 0, 2)), intval(substr($request->start_time, 3, 5)));
        $end_date = \Carbon\Carbon::createFromTimestamp(strtotime($request->date))->setTime(intval(substr($request->end_time, 0, 2)), intval(substr($request->end_time, 3, 5)));

        $con = DB::connection()->getPdo();

        // check on the inserted time not intersecting with any date for same room for the same branch
        $stmt = $con->prepare('SELECT start_date,end_date FROM timetables WHERE branch_code = ? AND room_number = ?AND (start_date BETWEEN ? AND ? OR end_date BETWEEN ? AND ?)');
        $stmt->execute(array(
            Auth::user()->branch_code,
            $request->room,
            $start_date,
            $end_date,
            $start_date,
            $end_date,
        ));
        $row = $stmt->fetch();
        if ($row) {
            return back()->with('error', 'This room is not avialable');
        }

        // check on the inserted time not intersecting with any date for same course
        $stmt = $con->prepare('SELECT start_date,end_date FROM timetables WHERE course_code = ? AND (start_date BETWEEN ? AND ? OR end_date BETWEEN ? AND ?)');
        $stmt->execute(array(
            $request->course,
            $start_date,
            $end_date,
            $start_date,
            $end_date,
        ));
        $row2 = $stmt->fetch();
        if ($row2) {
            return back()->with('error', 'This course has same time');
        }

        // finally insert the data in database 
        $stmt = $con->prepare('INSERT INTO timetables(room_number, branch_code, course_code, start_date, end_date, created_at, updated_at) VALUES(:room_number, :branch_code, :course_code, :start_date, :end_date, :created_at, :updated_at)');
        $stmt->execute(array(
            ':room_number' => $request->room, 
            ':branch_code' => Auth::user()->branch_code, 
            ':course_code' => $request->course, 
            ':start_date' => $start_date, 
            ':end_date' => $end_date, 
            ':created_at' => Carbon::now(),
            ':updated_at' => Carbon::now(),
        ));

        if ($stmt) {
            return redirect('employee/home')->with('status', 'Added Successfully');
        }
        return back()->with('error', 'There is Some Errors');
    }

    // get employee profile page
    public function profile()
    {
        return view('employee.profile');
    }

    // change employee photo
    public function photo(Request $request)
    {
        $image = $request->profile_photo->store('public/employees/' . Auth::id());
        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('UPDATE employees SET image = ?, updated_at = ? WHERE id = ?');
        $stmt->execute(array($image, Carbon::now(), Auth::id()));
        return back();
    }

    // update employee info
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'string|required',
            'username'=> [
                'string',
                'required',
                'max:30',
                // validate unique value for employee username except this employee
                Rule::unique('employees')->ignore(Auth::id()),
            ],
            'email'=> [
                'email',
                'required',
                'max:100',
                // validate unique value for employee email except this employee
                Rule::unique('employees')->ignore(Auth::id()),
            ],
            'mobile'=> 'numeric|required',
            'password'=> 'string|required|confirmed',
        ]);

        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('UPDATE employees SET name = ?, username = ?, email = ?, mobile_number = ?, password = ?, updated_at = ? WHERE id = ?');
        $stmt->execute(array($request->name, $request->username, $request->email, $request->mobile, Hash::make($request->password), Carbon::now(), Auth::id()));
        return back();
    }


    // get page to update reservation
    public function edit($timetable)
    {
        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('SELECT courses.code, courses.name FROM courses');
        $stmt->execute();
        $courses = $stmt->fetchAll();
        $stmt = $con->prepare('SELECT rooms.number FROM rooms WHERE rooms.branch_code = ?');
        $stmt->execute(array(Auth::user()->branch_code));
        $rooms = $stmt->fetchAll();
        $stmt = $con->prepare('SELECT * FROM timetables WHERE timetables.id = ?');
        $stmt->execute(array($timetable));
        $timetable = $stmt->fetch();
        if ($timetable) {
            $timetable = (object)$timetable;
            return view('employee.timetable.update', compact('timetable', 'rooms', 'courses'));
        }
        return back();
    }

    public function update_reservation(Request $request, $id)
    {
        $start_date = Carbon::today()->setTime(intval(substr($request->start_time, 0, 2)), intval(substr($request->start_time, 3, 5)));
        $end_date = Carbon::today()->setTime(intval(substr($request->end_time, 0, 2)), intval(substr($request->end_time, 3, 5)));
        $request['start_date'] = $start_date;
        $request['end_date'] = $end_date;
        $this->validate($request, [
            'room' => [
                'required',
                'numeric',
                Rule::exists('rooms', 'number')->where(function ($query) {
                    return $query->where('branch_code', Auth::user()->branch_code);
                }),
            ],
            'course' => 'required|numeric|exists:courses,code',
            'date' => 'required|date|after_or_equal:' . Carbon::today(),
            'start_date' => 'before:end_date',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $start_date = \Carbon\Carbon::createFromTimestamp(strtotime($request->date))->setTime(intval(substr($request->start_time, 0, 2)), intval(substr($request->start_time, 3, 5)));
        $end_date = \Carbon\Carbon::createFromTimestamp(strtotime($request->date))->setTime(intval(substr($request->end_time, 0, 2)), intval(substr($request->end_time, 3, 5)));

        $con = DB::connection()->getPdo();

        // check on the inserted time not intersecting with any date for same room for the same branch
        $stmt = $con->prepare('SELECT start_date,end_date FROM timetables WHERE branch_code = ? AND room_number = ? AND id <> ? AND (start_date BETWEEN ? AND ? OR end_date BETWEEN ? AND ?)');
        $stmt->execute(array(
            Auth::user()->branch_code,
            $request->room,
            $id,
            $start_date,
            $end_date,
            $start_date,
            $end_date,
        ));
        $row = $stmt->fetch();
        if ($row) {
            return back()->with('error', 'This room is not avialable');
        }

        // check on the inserted time not intersecting with any date for same course
        $stmt = $con->prepare('SELECT start_date,end_date FROM timetables WHERE course_code = ? AND id <> ? AND (start_date BETWEEN ? AND ? OR end_date BETWEEN ? AND ?)');
        $stmt->execute(array(
            $request->course,
            $id,
            $start_date,
            $end_date,
            $start_date,
            $end_date,
        ));
        $row2 = $stmt->fetch();
        if ($row2) {
            return back()->with('error', 'This course has same time');
        }

        // finally Update the data in database 
        $stmt = $con->prepare('UPDATE timetables SET room_number = ?, course_code = ?, start_date = ?, end_date = ?, updated_at = ? WHERE id = ?');
        $stmt->execute(array(
            $request->room, 
            $request->course, 
            $start_date, 
            $end_date, 
            Carbon::now(),
            $id,
        ));

        if ($stmt) {
            return redirect('employee/home')->with('status', 'Updated Successfully');
        }
        return back()->with('error', 'There is Some Errors');
    }

    public function destroy($id)
    {
        Validator::make(array('id' => $id),[
            'id' => 'exists:timetable,id',
        ]);

        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('DELETE FROM timetables WHERE timetables.id = ?');
        $stmt->execute(array($id));
        if ($stmt) {
            return redirect('employee/home')->with('status', 'Deleted Successfully');
        }
        return redirect('employee/home')->with('error', 'There is Some Errors');
    }

}
