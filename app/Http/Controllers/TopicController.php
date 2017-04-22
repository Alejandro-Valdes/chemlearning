<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;


class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = DB::table('topics')->get();

        $title = 'Chemlearn current Topics';

        return view('topics.index')->withTopics($topics)->withTitle($title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('topics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array('name' => 'required', 'info' => 'required');
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) 
        {
            return Redirect::to('nerds/create')
                ->withErrors($validator)
                ->withInput(Input::all());
        } 
        else 
        {
            $topic = new Topic();
            $topic->name = $request->get('name');
            $topic->info = $request->get('info');

            $topic->save();

            return redirect('/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topic = Topic::find($id);
        $questions = $topic->questions;
        return view('topics.show')->withTopic($topic)->withQuestions($questions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $topic = Topic::find($id);

        return View('topics.edit')->withTopic($topic);
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
        $topic = Topic::find($id);
        $topic->update(['name' => $request->name]);
        $topic->update(['info' => $request->info]);

        $questions = $topic->questions;

        return view('topics.show')->withTopic($topic)->withQuestions($questions);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = Topic::find($id);

        if($topic)
        {
            $topic->delete();
            $data['message'] = 'Topic deleted successfully';
        }
        else
        {
            $data['errors'] = 'Invalid Operation';
        }

        return redirect('/')->with($data);
    }
}
