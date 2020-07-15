@extends('layouts.home')

@section('content')


		
		{!! Form::open(['route'=>'user.store','method'=>'POST', 'files'=>true])!!}
		{{Form::token()}}
		<h1 align="center">REGISTRAR USUARIO</h1> 
		<hr sytle="size: 0px; border: none;"> 
		<table align="center">
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
				<td> <div class="form-group">
						<label for="id_tipo_socio">Tipo de Usuario</label>
						<select name="role_id" class="form-control">
							<option value=0>Seleccione el tipo de Usuario</option>
						    	@foreach ($roles as $rol)
						        	<option value="{{$rol->id}}">{{$rol->nombre_rol}}</option>
						        @endforeach
						</select>
		        	</div> </td>
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

@endsection
