<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\RoleUser;
use App\Student;
use Carbon\Carbon;
use App\Parent1;




class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   public function __construct()
  {
    $this->middleware('auth');
  }
  public function index(Request $request)
  {
    $data = $request->user()->authorizeRoles(["admin", "user"]);
    $userId =$request->user()->id;
    $roleId =RoleUser::where('user_id',$userId)->value('role_id');
     $role= ($roleId=='1') ? "admin" : "user";

     $students = Student::all();
    
    $minimumYear18 = Carbon::now()->subYears(18)->toDateString();
    $minimumYear16 = Carbon::now()->subYears(16)->toDateString();
    $minimumYear50 = Carbon::now()->subYears(50)->toDateString();

    $studentsOlderthan18 = Student::whereDate('dob','< ', $minimumYear18 )->get();
    $studentsOlderthan16 = Student::whereDate('dob','< ', $minimumYear16 )->get();
    $parentsOlderthan50 = Parent1::whereDate('dob','< ', $minimumYear50 )->get();

    // -show students who are older than 16 and who have parents older than 50.

$finalArray =[];

 foreach ($studentsOlderthan16 as $s) {

   $parentId= $s->parent_id;
   // check their parents whether age more than 50 
    $parentsOlderthan50 = Parent1::whereDate('dob','< ', $minimumYear50 )->whereId($parentId)->get();
    if( $parentsOlderthan50){
      array_push($finalArray, $s);

    }

 }


// -show the class and the parents for given student id 

 $studentId = "1";
 $student =Student::find($studentId);

 $dob =$student->dob;

 $age = Carbon::parse($dob)->age;
 $grade = $age - 5 ;
 if($grade > 13 ){
    $grade = "not in primary/secondary  education ";

 }
 else if($grade <= 0){
    $grade = "no grade ";

 }
 else{
  
    $grade =  $grade;
 }














    return view("home",compact('role'));
  }
  public function someAdminStuff(Request $request)
  {
    $request->user()->authorizeRoles("admin");
    return view("some.view");


  }

//   -show all the students\

 public function allStudents(Request $request)
  {
    $request->user()->authorizeRoles("admin");
    return view("some.view");


  }



// -show all the students in class 8 in 2010



public function findClass($dob){



}


}
