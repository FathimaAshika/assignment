<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
//use Spatie\Permission\Models\Role;
use DB;
use Mail;

use Hash;
use App\RoleUser;
use Auth;
use App\Student;
use App\Cource;
use App\Parent1;
use App\ParentStudent;


class UserController extends Controller
{
    public function index(Request $request)
    {


       $data = User::orderBy('id','DESC')->paginate(5);
        $students = Student::orderBy('id','DESC')->paginate(5);
        $cources = Cource::orderBy('id','desc')->paginate(5);
        $parents = Parent1::orderBy('id','DESC')->paginate();



    $userId =$request->user()->id;
    $roleId =RoleUser::where('user_id',$userId)->value('role_id');
     $role= ($roleId=='1') ? "admin" : "user";

        return view('users.index',compact('students','role','cources','data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }
     public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);


        $user = User::create($input);
        //$user->assignRole($request->input('roles'));


        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }
     public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();


        return view('users.edit',compact('user','roles','userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }


        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();


        $user->assignRole($request->input('roles'));


        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

     public function sendEmailStudentDetails($email)
    {

       $studentId = 1;
       $student =Student::find($studentId);
       $dob  = $student->dob;
       $studentName =$student->name ;

        $age = $this->getAge($dob);

        $courceId =$student->cource_id;
        $class = Cource::whereId($courceId)->value('year');

        $parentId = ParentStudent::where('student_id',$studentId)->value('parent_id');
        $parent =Parent1::find($parentId);
        $parentName =$parent->name;

        $sendMail = Mail::send('studentDetails', ['email' => $email ,  'studentName'=>$studentName,'age'=> $age ,'parentName'=> $parentName,
        'class'=>$class ], function ($message) use ($email, $studentName,$age ,$parentName,$class) {
                        $message->to($email)->subject('Student Details ');
        });
        return $sendMail;


    }
    public function getAge($dob){

         $start  = date_create($dob);
        $end    = date_create(); // Current time and date
        $diff   = date_diff( $start, $end );
        $age = $diff->y;
        return $age;


    }


    


     



}
