<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parent1 extends Model
{
	public $timestamps = false;

	protected $table = "parents";
	 
    protected $fillable = [
        'name', 'type', 'dob'
    ];

}
