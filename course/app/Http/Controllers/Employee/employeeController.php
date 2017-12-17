<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

}
