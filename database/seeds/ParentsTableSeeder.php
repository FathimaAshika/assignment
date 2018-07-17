<?php

use Illuminate\Database\Seeder;
use App\Parent1;


class ParentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent = new Parent1();
    	$parent->name = "Naugka" ;
    	$parent->type = "F";
    	$parent->dob ="1960-01-03";
    	$parent->save();


    	$parent = new Parent1();
    	$parent->name = "Wasiy" ;
    	$parent->type = "F";
    	$parent->dob ="1971-05-03";
    	$parent->save();
    }
}
