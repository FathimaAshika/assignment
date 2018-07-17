<?php

use Illuminate\Database\Seeder;
use App\Student;
use App\Parent1;
use App\ParentStudent;



class ParentStudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $students = Student::all();
       $parent = Parent1::find(1);
       if($parent && $students){

       	foreach ($students as $s) {
       		
       		$isExistParent = ParentStudent::where('student_id',$s->id)->first();
       		if(!$isExistParent){
       			$ps = new ParentStudent();
       			$ps->student_id = $s->id;
       			$ps->parent_id = $parent->id;
       			$ps->save();
       			

       		}

       	}

       }

    }
}
