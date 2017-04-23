@extends('layouts.app')

@section('content')

<div class="container" align="middle" style="margin-bottom:30px">
	<img src="{{ asset('img/chem.png') }}" style="width: 20%; height: 20%">
</div>

<div class="container">
@if ( !$topics->count() )
	There are no topics yet. Create a new topic to get started!
	<div>
		<a href="{{ url('/new-topic') }}">Add new topic</a>
	</div>

@else
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="panel panel-primary">
				@permission('can_add_topic')
				<div class="panel-heading">
					{{$title}}
				</div>
				@endpermission
				@foreach( $topics as $topic )
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-6">
								{{$topic->name}}
							</div>
							<div class="col-sm-2">
								<a class="btn btn-small btn-success" href="{{ URL::to('topic/' . $topic->id) }}">Show</a>
							</div>

							@permission('can_modify_topic')
							<div class="col-sm-2">
								<a class="btn btn-small btn-info" href="{{ URL::to('topic/' . $topic->id . '/edit') }}">Edit</a>
							</div>
							@endpermission
							@permission('can_delete_topic')
							<div class="col-sm-2">
								<form method="POST" action="{{ URL::to('topic/' . $topic->id . '/delete') }}">
									{{ method_field('DELETE') }}
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<button type="submit" class="btn btn-small btn-danger">Delete</button>
								</form>
							</div>
							@endpermission
						</div>
					</div>
				@endforeach

				@permission('can_modify_user')
				<div class="panel-footer">
					<a href="{{ url('/new-topic') }}">Add new topic</a>
					<a href="{{ url('/admin/usuarios') }}" style="float: right;">Modificar usuarios</a>
				</div>

				@endpermission
			</div>
			</div>
		</div>
	</div>
@endif
</div>
@endsection
