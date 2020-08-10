@extends('layouts.home')

@section('content')

		<h1 align="center">REGISTRAR PERSONAL DEFyD</h1> 
		<hr sytle="size: 0px; border: none;"> 
		<div style="display: flex; align-items:center; justify-content: center;"> 
			{!! Form::open(['route'=>'user.store','method'=>'POST', 'files'=>true])!!}
			{{Form::token()}}
					<table>
						<tr> 
							<td> {!! Field::text('name',null,['class'=>'form-control'])!!} </td>
						</tr>
				
						<tr> 
							<td> {!! Field::email('email')!!} </td>
						</tr>
				
						<tr> 
							<td> {!! Field::password('password', ['class'=>'awesone'])!!} </td>
						</tr>

						<tr> 
							<td> {!! Field::password('password_confirmation', ['class'=>'awesone'])!!} </td>
						</tr>
				
						<tr> 
							<td> <div class="form-group">
								<label for="role_id">Tipo de Operario* </label>
								<select name="role_id" class="form-control">
									<option value=0>Seleccione el tipo de Operario</option>
									@foreach ($roles as $rol)
										<option value="{{$rol->id}}"> {{$rol->nombre_rol}}</option>
									@endforeach
								</select> </div> 
							</td>
						</tr>

						<tr>
							<td> <div class="form-group mx-auto">
								{!! Form::reset(' Limpiar datos',['class'=>'btn btn-danger btn-lg'])!!}
								<button type="button " class="btn btn-primary btn-lg" type="submit"> <i class="fa fa-save"></i> Guardar</button>
							</div> 
						</td>
					</tr>
				</table>
			{!!Form::close()!!}
		</div>			
			
			

		<!--<h1 align="center">REGISTRAR PERSONAL DEFyD</h1> 
		<hr sytle="size: 0px; border: none;"> 
		<div style="display: flex; align-items:center; justify-content: center;"> 
			{!! Form::open(['route'=>'user.store','method'=>'POST', 'files'=>true])!!}
					{{Form::token()}}
						<table>
							<tr> 
								<td> {!! Form::label('Operario', 'Nombre de Usuario(de acceso al Sistema)* ') !!} </td>
							</tr>
							<tr>
								 <td>{!! Form::text('name') !!} </td>
							</tr>
				
							<tr> 
								<td> {!! Form::label('Correo', 'Correo* ') !!} </td>
							</tr>
							<tr>	
								</td> {!! Form::email('email')!!} </td>
							</tr>
				
							
							<tr>
								</td> {!! Form::password('contraseña*')!!} </td>
							</tr>

							<tr> 
								<td> {!! Form::label('pass_confirmation','Confirmación de Contraseña*')!!} </td>
							</tr>
							<tr>
								<td> {!! Form::password('password_confirmation')!!} </td>
							</tr>
				
							<tr> 
								<td> <div class="form-group">
									<label for="role_id">Rol de Personal*</label>
									<select name="role_id" class="form-control">
										<option value=0>Seleccione el Rol de Personal</option>
										@foreach ($roles as $rol)
											<option value="{{$rol->id}}"> {{$rol->nombre_rol}}</option>
										@endforeach
									</select> </div> 
								</td>
							</tr>

							<tr>
								<td> <div class="form-group mx-auto">
										{!! Form::reset(' Limpiar datos',['class'=>'btn btn-danger btn-lg'])!!}
										<button type="button " class="btn btn-primary btn-lg" type="submit"> <i class="fa fa-save"></i> Guardar</button>
									</div> 
								</td>
							</tr>
						</table>
					{!!Form::close()!!}
		</div> -->
@endsection
