<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$id}}">
	{{Form::Open(array('action'=>array('UsuarioController@deleteUsuario',$id),'method'=>'delete'))}}
    <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header text-center">
				
				<h4 class="modal-title">Dar de baja a usuario</h4>
			</div>
			<div class="modal-body">
				<p>Confirme si desea dar de baja el usuario {{$id}}</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-danger">Confirmar</button>
			</div>
		</div>
	</div>
    {{Form::close()}}
</div>