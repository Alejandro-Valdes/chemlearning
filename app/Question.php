<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    //get all questions of this topic
    public function answers()
    {
    	return $this->hasMany('App\Answer', 'question_id');
    }
    
    //returns the instance of the topic
    public function topic()
    {
    	return $this->belongsTo('App\Topic', 'topic_id');
    }
}
