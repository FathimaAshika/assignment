<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RoleUser;
use App\User;
use Auth;
use App\Student;
use App\Cource;
use App\Parent1;




class CourceController extends Controller
{
    public function index(Request $request)
  {
        //$data = User::orderBy('id','DESC')->paginate(5);
        $userId =$request->user()->id;
    	$roleId =RoleUser::where('user_id',$userId)->value('role_id');
        $role= ($roleId=='1') ? "admin" : "user";

        $cources = Cource::orderBy('id','DESC')->paginate(5);
        // $cources = Cource::orderBy('id','desc')->paginate(5);

        return view('cources.index',compact('cources','role'))
            ->with('i', ($request->input('page', 1) - 1) * 5);


  }

}
