<?php

namespace App\Http\Controllers;

use App\Question;
use App\Answer;
use App\Topic;
use Auth;

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
        $this->validate($request, [
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,'
        ]);

        $topic = Topic::find($topic_id);

        $photo = time().'.'.$request->photo->getClientOriginalExtension();

        $request->photo->move(public_path('images'), $photo);


        $question = new Question();
        $question->photo = $photo;
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
        return redirect('topic/' . $topic_id )->withTopic($topic)->withQuestions($questions);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($topic_id, $id)
    {
        $topic = Topic::find($topic_id);
        $question = Question::find($id);
        
        $answers = $question->answers;

        return view('questions.show')->withQuestion($question)->withAnswers($answers)->withTopic($topic);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function answer($topic_id, $id, Request $request)
    {
        $user = Auth::user();
        $topic = Topic::find($topic_id);
        $question = Question::find($id);

        $correctAnswers = $question->answers->where('is_correct', 1);
        $numExpectedAnswers = count($correctAnswers);
        $numActualAnswers = 0;
        
        $answers = $question->answers;
        $questions = $topic->questions;

        $userAnswers = $request->answers;

        if(count($userAnswers) == $numExpectedAnswers){
            foreach ($userAnswers as $key => $value) {
                $answer = Answer::find($key);
                if($answer->is_correct){
                    $numActualAnswers++;
                }
            }
        }
        #not expected num of answers
        else{
            $numActualAnswers = count($userAnswers);
        }

        #correct answer
        if($numExpectedAnswers == $numActualAnswers){
            $score = $user->score;
            $score += $numExpectedAnswers;

            $user->score = $score;
            $user->save();

            $message = 'Felicidades, te supiste todas! tu nuevo puntaje es: ' . $score;

            return view('topics.show')->withTopic($topic)->withQuestions($questions)->withMessage($message);
        }

        #incorrect
        else{   

            $message = '';

            if($numActualAnswers < $numExpectedAnswers){
                $message = 'Checa bien, te faltaron respuestas correctas';
            }
            else{
                $message = 'Mandaste respuestas incorrectas!';
            }

            return view('questions.show')->withQuestion($question)->withAnswers($answers)->withTopic($topic)->withError($message);
        }

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
