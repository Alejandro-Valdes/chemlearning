<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $guarded = [];

    //get all questions of this topic
    public function is_correct()
    {
    	return $this->is_correct;
    }
    
    //returns the instance of the topic
    public function question()
    {
    	return $this->belongsTo('App/Question', 'question_id');
    }
}
