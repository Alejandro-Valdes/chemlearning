<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    //get all questions of this topic
    public function questions()
    {
    	return $this->hasMany('App\Question');
    }
    
}
