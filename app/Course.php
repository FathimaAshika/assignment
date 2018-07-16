<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cource extends Model
{
	public $timestamps = false;
	
   protected $fillable = [
        'name', 'year'
    ];

    

}
