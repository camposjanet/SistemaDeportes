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
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Fecha de pago</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-pago"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type ="date" name="fecha_pago" aria-describedby="basic-pago"value="<?php echo date('Y-m-d');?>" class="form-control" disabled="true">
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
                                <input type ="date" name="fecha_vencimiento" aria-describedby="basic-vencimiento"value="<?php echo date('Y-m-d', strtotime(now(). ' + 30 days'));?>" class="form-control" disabled="true">
                            </div>
                            <!-- {!! Field::date('fecha_de_vencimiento',now(), ['class'=>'form-control', 'disabled'=>'true'])!!} -->
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
                        <input type="numeric" class="form-control" placeholder="0.00" aria-label="importe" aria-describedby="basic-importe" name="importe" value="{{old('importe')}}">
                    </div>
                </div>
                
                </div>
			</div>
			<div class="modal-footer">
				<div class=" form-group mx-auto">
                    <a class="btn btn-danger" data-dismiss="modal" name="cancelar">Cancelar</a>
                    <button type="button " class="btn btn-primary" type="submit"> <i class="fa fa-save"></i> Guardar</button>
                </div>
			</div>
		</div>	
	</div>
    {{Form::close()}}
</div>