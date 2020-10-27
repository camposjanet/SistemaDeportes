<div id="verModalFamiliar" class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>      
                </div>
                <div class="modal-body">
                    <div class="col" >
                        <div class="form-group row">
                            <label for="num_ficha_familiar" class="col-form-label "><b>Nº Ficha: </b></label>
                            <div class="col">
                                <input type="text" readonly class="form-control-plaintext" name="num_ficha_familiar" id="num_ficha_familiar">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mt-2">
                        <div class="col" >
                            <div class="media">
                                <div class="media-body" align="center">
                                    <h2 class="text-center">SALA DE MUSCULACIÓN</h2>
                                    <h2 class="text-center">FICHA INDIVIDUAL</h2>
                                    <input type="text" readonly class="form-control-plaintext form-control-lg text-center text-uppercase font-weight-bold" name="categoria_ficha_familiar" id="categoria_ficha_familiar">
                                </div>
                                <div class="media-right">
                                    <img id="fotoFamiliar" class="media-object" src="{{asset('img/usuarios/'.$usuario->foto)}}" style="border:1px solid #b0b8b9;" height="120px" width="130px">
                                </div>
                            </div>
                        </div>  
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <label for="nombre_apellido_familiar" class="col-form-label"><b>Apellido y Nombre: </b></label>
                            <div class="col">
                            <input type="text" readonly class="form-control-plaintext" name="nombre_apellido_familiar" id="nombre_apellido_familiar">
                            </div>
                        </div>
                    </div>
                    <div class="ml-3 mr-2">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="fecha_de_nacimiento_familiar" class="col-form-label"><b>Fecha de Nacimiento: </b></label>
                                    <div class="col">
                                    <input type="text" readonly class="form-control-plaintext" name="fecha_de_nacimiento_familiar" id="fecha_de_nacimiento_familiar">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="dni_familiar" class="col-form-label"><b>DNI: </b></label>
                                    <div class="col">
                                        <input type="text" readonly class="form-control-plaintext" name="dni_familiar" id="dni_familiar">
                                    </div>
                                </div>
                            </div>       
                        
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="domicilio_familiar" class="col-form-label"><b>Domicilio: </b></label>
                                    <div class="col">
                                        <input type="text"  readonly class="form-control-plaintext" id="domicilio_familiar" name="domicilio_familiar">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="email_usuario_familiar" class="col-form-label"><b>Email: </b></label>
                                    <div class="col">
                                        <input type="text"  readonly class="form-control-plaintext" id="email_usuario_familiar" name="email_usuario_familiar">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3">
                                <div class="form-group row">
                                    <label for="telefono_familiar" class="col-form-label"><b>Teléfono: </b></label>
                                    <div class="col">
                                    <input type="text" readonly class="form-control-plaintext" name="telefono_familiar" id="telefono_familiar">
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group row">
                                    <label for="linea_familiar" class="col-form-label"><b>Línea: </b></label>
                                    <div class="col">
                                        <input type="text" readonly class="form-control-plaintext" name="linea_familiar" id="linea_familiar">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group row">
                                    <label for="telefono_emergencia_familiar" class="col-form-label"><b>Tel. Emergencia: </b></label>
                                    <div class="col">
                                        <input type="text" readonly class="form-control-plaintext" name="telefono_emergencia_familiar" id="telefono_emergencia_familiar">
                                    </div>
                                </div>
                            </div>        
                            <div class="col-2">
                                <div class="form-group row">
                                    <label for="linea_emergencia_familiar" class="col-form-label"><b>Línea: </b></label>
                                    <div class="col">
                                    <input type="text" readonly class="form-control-plaintext" name="linea_emergencia_familiar" id="linea_emergencia_familiar">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="vencimiento_cm_familiar" class="col-form-label"><b>Vencimiento Certificado Médico: </b></label>
                                    <div class="col">
                                    <input type="text" readonly class="form-control-plaintext" name="vencimiento_cm_familiar" id="vencimiento_cm_familiar">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="vencimiento_arancel_familiar" class="col-form-label"><b>Vencimiento Último Arancel: </b></label>
                                    <div class="col">
                                        <input type="text" readonly class="form-control-plaintext" name="vencimiento_arancel_familiar" id="vencimiento_arancel_familiar">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
			    </div>

                <div class="modal-footer">
                    <div class=" form-group mx-auto">
                    <a class="btn btn-danger text-white" data-dismiss="modal" name="cancelar"><i class="fa fa-times text-white"></i>  Cerrar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>