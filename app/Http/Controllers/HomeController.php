<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\RoleUser;
use App\Student;
use Carbon\Carbon;
use App\Parent1;
use App\ParentStudent;




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
 // all students 
     $students = $this->allStudents();


    
    $minimumYear18 = Carbon::now()->subYears(18)->toDateString();
    $minimumYear16 = Carbon::now()->subYears(16)->toDateString();
    $minimumYear50 = Carbon::now()->subYears(50)->toDateString();
// students older than 18 
    $studentsOlderthan18 = $this->studentsOlderthan18($minimumYear18);
    // -show students who are older than 16 and who have parents older than 50.
    $parent50Student16 = $this->parent50Student16($minimumYear16,$minimumYear50);




// -show the class and the parents for given student id 

 $studentId = "1";
 $getClassandParent = $this->getClassandParent($studentId);



  $studentsInClassYear = $this->getStudentClassYear(8,2010);
  //dd($studentsOlderthan18);

    return view("home",compact('role','students','studentsOlderthan18','parent50Student16','getClassandParent','studentsInClassYear'));

  }
  

//   -show all the students\

 public function allStudents()
  {

     $students = Student::all();
     return $students;



  }

  public function studentsOlderthan18($minimumYear18){

      $studentsOlderthan18 = Student::whereDate('dob','< ', $minimumYear18 )->get();
      return $studentsOlderthan18;
  }

   public function parent50Student16($minimumYear16,$minimumYear50){

    $studentsOlderthan16 = Student::whereDate('dob','< ', $minimumYear16 )->get();
    $parentsOlderthan50 = Parent1::whereDate('dob','< ', $minimumYear50 )->get();

  $finalArray =[];

 foreach ($studentsOlderthan16 as $s) {

   $parentId= $s->parent_id;
   // check their parents whether age more than 50 
    $parentsOlderthan50 = Parent1::whereDate('dob','< ', $minimumYear50 )->whereId($parentId)->get();
    if( $parentsOlderthan50){
      array_push($finalArray, $s);

    }

  }
return $finalArray;



  }



// -show all the students in class 8 in 2010

  public function getStudentClassYear($class,$year){

// find the age of student 
$age =$this->findAge($class);
$year = $year."-01-01"; 
// find the born year using age 
$birthdayYear = Carbon::parse($year)->subYears($age)->year;

// 

 $result = Student::whereYear('dob' ,$birthdayYear)->get();
 return $result;





  }

  public function getClassandParent($studentId){
  $result=[];
  $student =Student::find($studentId);
 if($student){

  $dob =$student->dob;

 $age = Carbon::parse($dob)->age;
 $class = $this->findClass($age);

 $getParent = ParentStudent::where('student_id',$studentId)->first();
 $parentId  = $getParent->parent_id;
 $parentName = Parent1::whereId($parentId)->value('name');
$result = array('class'=>$class,'parentName'=>$parentName);

}

return $result;
}



public function findClass($age){
  $class = $age - 5 ;
 if($class > 13 ){
    $class = "not in primary/secondary  education ";

 }
 else if($class <= 0){
    $class = "no grade ";

 }
 else{
  
    $class =  $class;
 }
 return $class;


}

public function findAge($class){
   $age  = $class + 5  ;

  return $age;


}

public function someAdminStuff(Request $request)
  {
    $request->user()->authorizeRoles("admin");
    return view("some.view");


  }






}
