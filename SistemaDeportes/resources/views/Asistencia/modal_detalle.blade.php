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
        <form>
          <input type="hidden" name="chequear" id="chequear"> 
          <button type="button" class="btn btn-outline-info btn-lg btn-block" onclick="habilitar();" id="boton" style="display: inline;">Click para ver detalles</button>
        </form>
        
        <div id="detalle" style="display: none;">
          <h1>N° de Carnet: <font color="blue"><label for="Carnet_modal"></label></font> </h1>
          <h3>Detalles de Documentación</h3>
          <div class="container">
            <div>
               <label for= "tipo_documento"></label>
                                      <input type="text" name="fecha_tipo" id="fecha_tipo" style="border: 0;" disabled>
            </div>
            <div>
              Fecha de Vencimiento del CERTIFICADO MÉDICO: <input type="text" name="fecha_certificado_medico" id="fecha_certificado_medico" style="border: 0;" disabled> 
            </div>
            <div>
              Fecha de Vencimiento de ÚLTIMO PAGO: <input type="text" name="fecha_ultimo_arancel" id="fecha_ultimo_arancel" style="border: 0;" disabled> 
            </div>
          </div>
        </div>
        <div id="registrar_asistencia" style="display: none;">
          <h1>N° de Carnet: <font color="blue"><label for="Carnet_modal_registrar"></label></font> </h1>
          <h3>Detalles de Documentación</h3>
          <div class="container">
            <div>
              <input type="hidden" name="idficha" id="idficha">
              <input type="hidden" name="idasistencia" id="idasistencia">
              <p>Estado de ÚLTIMO PAGO: <input type="text" name="fecha_ultimo_arancel_registrar" id="fecha_ultimo_arancel_registrar" style="border: 0;" disabled> </p>
              <p>
                ¿Está seguro de registrar al Usuario? De ser así, queda bajo su responsabilidad el acceso y permanencia ante cualquier eventualidad que pueda ocurrir con el mismo.
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer" id="footer-detalle" style="display: none;">
        <button class="btn btn-primary" onclick="registrar_sin_arancel()" style="display: none;" id="footer-registrar"> Registrar </button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="location.reload(true)">Cerrar</button>
      </div>
  </div>
</div>

<script type="text/javascript">
  function registrar_sin_arancel(){
    var id=document.getElementById('idficha').value;
    var as=document.getElementById('idasistencia').value;
    $.ajax({
      type:"get",
      url:"crear_asistencia_sin_arancel/"+as+"/"+id,
      success:function(resultado){
        location.reload();
      }, fail: function(){
        console.log("error");
      }
    });
  }
</script>


<script type="text/javascript">
  function habilitar(){
    var ok=document.getElementById('chequear').value;
    if (ok=="detalle") {
      $('#detalle').show();
      $('#footer-detalle').show();
      document.getElementById('boton').style.display="none";
    }
    if(ok=="registrar"){
      $('#registrar_asistencia').show();
      $('#footer-detalle').show();
      document.getElementById('boton').style.display="none";
      document.getElementById('footer-registrar').style.display="inline";
    }
  } 
</script>