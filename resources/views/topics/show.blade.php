@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{$topic->name}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection