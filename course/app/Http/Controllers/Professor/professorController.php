<?php

namespace App\Http\Controllers\Professor;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class professorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:professor');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('professor.profile');
    }

    public function photo(Request $request)
    {
        $this->validate($request, [
            'profile_photo' => 'image|required',
        ]);
        $image = $request->profile_photo->store('public/professor/' . Auth::id());
        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('UPDATE professors SET image = ? WHERE id = ?');
        $stmt->execute(array($image, Auth::id()));
        return back();
    }

      public function update_info(Request $request)
    {
        $this->validate($request, [
            'username'=> [
                'string',
                'max:30',
                Rule::unique('professors')->ignore(Auth::id()),
            ],
            'email'=> [
                'email',
                'max:100',
                Rule::unique('professors')->ignore(Auth::id()),
            ],
            'mobile_number'=> 'numeric|required',
            'field'=> 'required'       
        ]);

        $con = DB::connection()->getPdo();
        $stmt = $con->prepare('UPDATE professors SET username = ?,name = ? , email = ?,mobile_number = ?,field = ?,address = ?,password = ? WHERE id = ? ');
        $stmt->execute(array($request->username, $request->name, $request->email,$request->mobile_number,$request->field,$request->address  ,Hash::make($request->password), Auth::id())); 
        $this->index();       
        return back();
    }
}
