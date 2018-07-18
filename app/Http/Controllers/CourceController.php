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

public function create()
    {
       Auth::user()->authorizeRoles("admin");

      

        return view('cources.create');
    }
     public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'year' => 'required'
        ]);


        $input = $request->all();

        $cource = Cource::create($input);
       



        return redirect()->route('cources.index')
                        ->with('success','Couce created successfully');
    }
    


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       Auth::user()->authorizeRoles("admin");

        $cource = Cource::find($id);
        return view('cources.edit',compact('cource'));

    }

    public function update(Request $request, $id)
    {
       Auth::user()->authorizeRoles("admin");

        $this->validate($request, [
            'name' => 'required',
            'year' => 'required'
        ]);


        $input = $request->all();
        $cource = Cource::find($id);
        $cource->update($input);


       


        return redirect()->route('cources.index')
                        ->with('success','Cource  updated successfully');
    }

    public function destroy($id)
    {
       Auth::user()->authorizeRoles("admin");
       

        Cource::find($id)->delete();
       

        return redirect()->route('cources.index')
                        ->with('success','Cource deleted successfully');
    }


}
