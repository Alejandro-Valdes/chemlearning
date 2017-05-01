@extends('layouts.app')

@section('content')

<div class="container" id="imagenDiv">
	<img src="{{ asset('img/chem2.png') }}" id="imagen">
</div>

<div class="container">
@if ( !$topics->count() )
	No hay temas registrados. Crea un nuevo tema!
	<div>
		<a href="{{ url('/new-topic') }}">Añadir nuevo tema</a>
	</div>

@else
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">
					{{$title}}
				</div>
				@foreach( $topics as $topic )
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-6">
								{{$topic->name}}
							</div>
							<div class="col-sm-2">
								<a class="btn btn-small btn-success" href="{{ URL::to('topic/' . $topic->id) }}">Mostrar</a>
							</div>

							@permission('can_modify_topic')
							<div class="col-sm-2">
								<a class="btn btn-small btn-info" href="{{ URL::to('topic/' . $topic->id . '/edit') }}">Editar</a>
							</div>
							@endpermission
							@permission('can_delete_topic')
							<div class="col-sm-2">
								<form method="POST" action="{{ URL::to('topic/' . $topic->id . '/delete') }}" onSubmit="if(!confirm('¿Seguro que quieres borrar el tema?')){return false;}">
									{{ method_field('DELETE') }}
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<button type="submit" class="btn btn-small btn-danger">Borrar</button>
								</form>
							</div>
							@endpermission
						</div>
					</div>
				@endforeach

				<div class="panel-footer">
					@permission('can_add_topic')
					<a href="{{ url('/new-topic') }}">Añadir nuevo tema</a>
					@endpermission
					@permission('can_modify_user')
						<a href="{{ url('/admin/usuarios') }}" style="float: right;">Modificar usuarios</a>
					@endpermission
				</div>
			</div>
			</div>
		</div>
	</div>
@endif
</div>
@endsection
