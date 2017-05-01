@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="panel panel-default">

				<div class="panel-heading">
					{{$title}}
				</div>

				<div class="panel-body">
					@foreach( $users as $user )
						<div class="row">
							<div class="col-sm-8">
								{{$user->name}} - {{$user->email}}
							</div>

							@permission('can_modify_user')
							<div class="col-sm-4">
								<div class="form-group">
									<div class="row">

										<form method="POST" action="{{ URL::to('admin/usuarios/' . $user->id . '/guardar') }}">

											<input type="hidden" name="_token" value="{{ csrf_token() }}">

											<div class="col-sm-6">
												<select class="form-control" required="" name="rol">
												    <option value="-1" disabled selected>Roles</option>

													@foreach( $roles as $role )
													<option value="{{$role->id}}">
														@if ($role->name == 'admin')
															Administrador
														@elseif ($role->name == 'teacher')
															Profesor
														@else
															Alumno
														@endif
													</option>
													@endforeach
												</select>
											</div>
											<div class="col-sm-4">
												<button type="submit" class="btn btn-small btn-success">Guardar</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							@endpermission

						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
