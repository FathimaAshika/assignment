<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	public $timestamps = false;
	
    protected $fillable = [
        'name', 'cource_id', 'dob','city'
    ];

  

     public function cource()
    {
    	 return $this->belongsTo('App\Cource');
    }
}
