<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RoleUser;
use App\User;
use Auth;
use App\Student;
use App\Cource;
use App\Parent1;


class StudentController extends Controller
{
    public function index(Request $request)
  {
        //$data = User::orderBy('id','DESC')->paginate(5);
        $userId =$request->user()->id;
    $roleId =RoleUser::where('user_id',$userId)->value('role_id');
     $role= ($roleId=='1') ? "admin" : "user";

        $students = Student::orderBy('id','DESC')->paginate(5);
        // $cources = Cource::orderBy('id','desc')->paginate(5);

        return view('students.index',compact('students','role'))
            ->with('i', ($request->input('page', 1) - 1) * 5);


  }
}
