<?php

namespace App\Http\Controllers;

use App\Question;
use App\Answer;
use App\Topic;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($topic_id)
    {  
        return view('questions.create')->withTopic_id($topic_id); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $topic_id)
    {
        $topic = Topic::find($topic_id);

        $question = new Question();
        $question->question_body = $request->get('question_body');
        $question->topic()->associate($topic);
        $question->save();

        $answers = $request->answers;

        foreach($answers as $option) {
            if(!empty($option['body'])) {
                $answer = new Answer([ 'text' => $option['body'] ]);
                if(isset($option['is_correct'])) 
                {
                    $answer->is_correct = (bool) $option['is_correct'];
                }
                else
                {
                    $answer->is_correct = False;
                }
                
                $answer->question()->associate($question);
                $answer->save();
            }
        }

        $questions = $topic->questions;
        return view('topics.show')->withTopic($topic)->withQuestions($questions);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
