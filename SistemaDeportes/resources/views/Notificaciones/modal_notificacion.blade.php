<div class="modal" tabindex="-1" role="dialog" id="ModalNotificar">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> ENVIAR MAIL DE NOTIFICACION DE ARANCEL</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p> ¡Atención! <b> {{Auth::user()->name}} </b> ¿Desea notificar por correo electrónico a todos los usuarios que al día de la fecha adeudan Arancel?
        </p>
        <span class="border border-white"></span>

        <div style="display: flex; align-items:center; justify-content: center;">
          {!! Form::open(['route'=>['Notificaciones.store', Auth::user()->id],'method'=>'POST'])!!}
          {{Form::token()}}
            <div class="form-group mx-auto">
              <button type="button " class="btn btn-primary btn-lg" type="submit"> <i class="fa fa-save"></i> Notificar</button>
              <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Cerrar</button>
            </div> 
          {!!Form::close()!!}
    </div>  
  </div>
</div>

