<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$id}}">
	{{Form::Open(array('action'=>array('UserController@delete',$id),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header text-center">
				<h4 class="modal-title">Confirmar Dar de Baja</h4>
			</div>
			<div class="modal-body">
				<p>¿Está seguro que desea Dar de Baja al Personal seleccionado?. Una vez dado de baja, ¡El usuario no podrá acceder al Sistema de Deportes! </p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary"> Confrimar</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			</div>
		</div>	
	</div>
	{{Form::close()}}
</div>
