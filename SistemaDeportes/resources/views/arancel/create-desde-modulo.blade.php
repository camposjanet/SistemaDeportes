    <div id="verModalRegistrarArancel" class="modal fade modal-slide-in-right" data-backdrop="static" aria-hidden="true" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>      
                </div>
                <div class="modal-body">
                    <meta name="_token" content="{!! csrf_token() !!}"/>
                    <h2 class="text-center">REGISTRAR ARANCEL </h2>
                    <div class="ml-3 mr-2">
                        <div class="row">
                            <div class="col-6" >
                                <div class="form-group row">
                                    <label for="num_ficha_arancel" class="col-form-label "><b>Nº Ficha: </b></label>
                                    <div class="col">
                                        <input type="text" readonly class="form-control-plaintext" name="num_ficha_arancel" id="num_ficha_arancel">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label for="dni_familiar" class="col-form-label"><b>DNI: </b></label>
                                    <div class="col">
                                        <input type="text" readonly class="form-control-plaintext" name="dni_arancel" id="dni_arancel">
                                    </div>
                                </div>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group row">
                                    <label for="nombre_apellido_arancel" class="col-form-label"><b>Apellido y Nombre: </b></label>
                                    <div class="col">
                                        <input type="text" readonly class="form-control-plaintext" name="nombre_apellido_arancel" id="nombre_apellido_arancel">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group row">
                                    <label for="dni_arancel" class="col-form-label"><b>DNI: </b></label>
                                    <div class="col">
                                        <input type="text" readonly class="form-control-plaintext" name="dni_arancel_a" id="dni_arancel_a">
                                    </div>
                                </div>
                            </div>  
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
                                <input type="numeric" class="form-control" placeholder="0.00" aria-label="importe" aria-describedby="basic-importe" name="importe_arancel" id="importe_arancel" value="{{old('importe')}}">
                            </div>
                        </div>
                    </div>
			    </div>

                <div class="modal-footer">
                    <div class=" form-group mx-auto">
                        <a class="btn btn-danger" data-dismiss="modal" name="cancelar">Cancelar</a>
                        <button id="btnRegistrarArancel" name="btnRegistrarArancel" type="button " class="btn btn-primary"> <i class="fa fa-save"></i> Guardar</button>
                    </div>
			    </div>
            </div>
        </div>
        
    </div>