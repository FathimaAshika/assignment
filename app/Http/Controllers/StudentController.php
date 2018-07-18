<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RoleUser;
use App\User;
use Auth;
use App\Student;
use App\Cource;
use App\Parent1;
use App\ParentStudent;



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

  public function create()
    {
       Auth::user()->authorizeRoles("admin");

       $cources = Cource::all();
        $parents = Parent1::all();

        return view('students.create',compact('cources','parents'));
    }
     public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'dob' => 'required',
            'city' => 'required',
            'cource_id' => 'required',
            'parent_id' => 'required',
        ]);


        $input = $request->all();

        $student = Student::create($input);
        $studentId = $student->id;
        $parentId = $request->parent_id;
        $createParentStudent =ParentStudent::create(['student_id'=>$studentId,'parent_id'=>$parentId]);



        return redirect()->route('students.index')
                        ->with('success','Student created successfully');
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

        $student = Student::find($id);
         $cources = Cource::all();
        $parents = Parent1::all();


        return view('students.edit',compact('student','cources','parents'));
    }

    public function update(Request $request, $id)
    {
       Auth::user()->authorizeRoles("admin");

        $this->validate($request, [
            'name' => 'required',
            'dob' => 'required',
            'city' => 'required',
            'cource_id' => 'required',
            'parent_id' => 'required',
        ]);


        $input = $request->all();
        $user = Student::find($id);
        $user->update($input);
        $parent_id = $request->parent_id;

        $parentStudent=ParentStudent::where('student_id',$id)->update(['parent_id'=>$parent_id]);

       


        return redirect()->route('students.index')
                        ->with('success','Student updated successfully');
    }

    public function destroy($id)
    {
       Auth::user()->authorizeRoles("admin");
       
       ParentStudent::where('student_id',$id)->delete();

        Student::find($id)->delete();
       

        return redirect()->route('students.index')
                        ->with('success','Student deleted successfully');
    }


}
