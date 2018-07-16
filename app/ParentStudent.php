<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParentStudent extends Model
{
	public $timestamps = false;
	
    protected $fillable = [
        'student_id', 'parent_id'
    ];

        public function students()
    {
        return $this->belongsTo('App\Student');
    }

        public function parents()
    {
        return $this->belongsTo('App\Parent1');
    }

    
}


