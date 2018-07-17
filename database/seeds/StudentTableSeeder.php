<?php

use Illuminate\Database\Seeder;
use App\Student;


class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $student = new Student();
    	$student->name = "Jowial" ;
    	$student->cource_id = "1";
    	$student->dob = "2000-12-12" ;
    	$student->city = "Colombo";
    	$student->save();


 		$student = new Student();
    	$student->name = "Tamanna" ;
    	$student->cource_id = "1";
    	$student->dob = "2001-12-12" ;
    	$student->city = "Kandy";
    	$student->save();

    }
}
