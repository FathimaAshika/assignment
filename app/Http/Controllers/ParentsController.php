<?php

namespace App\Http\Controllers;
use App\Role;
use App\RoleUser;
use App\Student;
use Carbon\Carbon;
use App\Parent1;
use App\ParentStudent;
use Auth;
use App\Cource;




use Illuminate\Http\Request;

class ParentsController extends Controller
{
     public function index(Request $request)
  {
        //$data = User::orderBy('id','DESC')->paginate(5);
        $userId =$request->user()->id;
    	$roleId =RoleUser::where('user_id',$userId)->value('role_id');
        $role= ($roleId=='1') ? "admin" : "user";

        $parents = Parent1::orderBy('id','DESC')->paginate(5);
        // $cources = Cource::orderBy('id','desc')->paginate(5);

        return view('parents.index',compact('parents','role'))
            ->with('i', ($request->input('page', 1) - 1) * 5);


  }
public function create()
    {
       Auth::user()->authorizeRoles("admin");


        return view('parents.create');
    }
     public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'dob' => 'required',
            'type' => 'required'
        ]);


        $input = $request->all();

        $parent = Parent1::create($input);




        return redirect()->route('parents.index')
                        ->with('success','Parent created successfully');
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
        $parent = Parent1::find($id);


        return view('parents.edit',compact('parent'));
    }

    public function update(Request $request, $id)
    {
       Auth::user()->authorizeRoles("admin");

        $this->validate($request, [
            'name' => 'required',
            'dob' => 'required',
            'type' => 'required',
          
        ]);


        $input = $request->all();
        $parent = Parent1::find($id);
        $parent->update($input);

      

        return redirect()->route('parents.index')
                        ->with('success','Parent updated successfully');
    }

    public function destroy($id)
    {
       Auth::user()->authorizeRoles("admin");
       

        Parent1::find($id)->delete();
       

        return redirect()->route('parents.index')
                        ->with('success','Parent deleted successfully');
    }


}
