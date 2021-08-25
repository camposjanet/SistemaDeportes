<div class="modal fade" data-backdrop="static" data-keyboard="false" aria-hidden="true" role="dialog" tabindex="-1" id="modal-pago-arancel-{{$ficha->id}}">
    {{Form::Open(array('action'=>array('ArancelController@store',auth()->user()->id,$ficha->id),'method'=>'post','autocomplete'=>'off'))}}
    <div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
			</div>
			<div class="modal-body ">
                <h2 class="text-center">REGISTRAR ARANCEL </h2>
                <div class="row">
                    <div class="col-lg-12 m-2">
                        @if(Session::has('error_en_pago_arancel'))
                            <small  class="form-text text-danger">{{session('error_en_pago_arancel')}}</small>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mt-1">
                        <div class="alert alert-info alert-dismissible fade show" role="alert" >
                            <ul id="mensaje-{{$ficha->id}}"></ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Fecha de Inicio</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-pago"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type ="date" name="fecha_de_inicio" id="fecha_de_inicio" aria-describedby="basic-pago"value="<?php echo date('Y-m-d');?>" class="form-control">
                            </div>
                        </div>   
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Vencimiento del pago</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-vencimiento"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type ="date"  name="fecha_de_vencimiento" id="fecha_de_vencimiento" aria-describedby="basic-vencimiento"value="<?php echo date('Y-m-d', strtotime(now(). ' + 30 days'));?>" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="cantidad_meses">Cantidad de meses a pagar *</label>
                                <input type="numeric"  class="form-control" name="cantidad_meses" id="cantidad_meses" value="1" onchange="calcular_importe({{$ficha->id}})">
                            </div>
                            
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nro_recibo">Nro Recibo *</label>
                                <input type="text" class="form-control" name="nro_recibo" id="nro_recibo">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label >Importe</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-importe"><b>$</b></span>
                                </div>
                                <input type="numeric" readonly class="form-control" placeholder="0.00" aria-label="importe" aria-describedby="basic-importe" name="importe" id="importe-{{$ficha->id}}" value="{{old('importe')}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <input type="hidden" name="importe_arancel_hidden" id="importe_arancel_hidden-{{$ficha->id}}">
                        </div>
                    </div>
			</div>
			<div class="modal-footer">
				<div class=" form-group mx-auto" >
                    <a class="btn btn-danger" data-dismiss="modal" name="cancelar">Cancelar</a>
                    <button type="button " id="btn_guardar_arancel" class="btn btn-primary" type="submit" hidden> <i class="fa fa-save"></i> Guardar</button>
                </div>
			</div>
		</div>	
	</div>
    {{Form::close()}}
</div>

<script type="text/javascript">
    function calcular_importe(id){
        console.log(id);
        var importe = $('#importe_arancel_hidden-'+id).val();
        var meses = $('#cantidad_meses').val();
        var importe_total = importe * meses; 
        document.getElementById('importe-'+id).value=importe_total;
    }
</script>
