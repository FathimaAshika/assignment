<?php

use Illuminate\Database\Seeder;
use App\Cource;

class CourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cource = new Cource();
    	$cource->name = "Cambridge" ;
    	$cource->year = "7";
    	$cource->save();


    	$cource = new Cource();
    	$cource->name = "Edexcel" ;
    	$cource->year = "6";
    	$cource->save();
    }
}
