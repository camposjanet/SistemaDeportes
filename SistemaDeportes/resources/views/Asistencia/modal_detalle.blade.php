<div class="modal" tabindex="-1" role="dialog" id="ModalDetalles">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h1>N° de Carnet: <font color="blue"><label for="Carnet_modal"></label></font> </h1>
        <h3>Detalles de Documentación</h3>
        <div class="container">
          <div>
              Fecha de Vencimiento de <label for= "tipo_documento"></label>
                        <!--<input type="text" name="tipo_documento" id="tipo_documento" disabled> :--> 
                                    <input type="text" name="fecha_tipo" id="fecha_tipo" style="border: 0;" disabled>
          </div>
          <div>
            Fecha de Vencimiento del CERTIFICADO MÉDICO: <input type="text" name="fecha_certificado_medico" id="fecha_certificado_medico" style="border: 0;" disabled> 
          </div>
          <div>
            Fecha de Vencimiento de ÚLTIMO PAGO: <input type="text" name="fecha_ultimo_arancel" id="fecha_ultimo_arancel" style="border: 0;" disabled> 
          </div>
      </div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="location.reload()">Cerrar</button>
      </div>
    </div>
  </div>
</div>