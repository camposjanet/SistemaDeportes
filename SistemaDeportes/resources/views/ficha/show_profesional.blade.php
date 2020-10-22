<div id="verModal" class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    
                </div>
                <div class="modal-body">
                    <div class="col" >
                        <div class="form-group row">
                            <label for="num_ficha" class="col-form-label "><b>Nº Ficha: </b></label>
                            <div class="col">
                                <input type="text" readonly class="form-control-plaintext" name="num_ficha" id="num_ficha">
                            </div>
                        </div>
                    </div> 
                    <div class="row d-flex justify-content-center">
                        <div class="col" >
                            <div class="media">
                                <div class="media-body" align="center">
                                    <h2 class="text-center">SALA DE MUSCULACIÓN</h2>
                                    <h2 class="text-center">FICHA INDIVIDUAL</h2>
                                    <input type="text" readonly class="form-control-plaintext form-control-lg text-center text-uppercase font-weight-bold" name="categoria_ficha" id="categoria_ficha">
                                </div>
                                <div class="media-right">
                                    <img class="media-object" src="{{asset('img/usuarios/'.$usuario->foto)}}" style="border:1px solid #b0b8b9;" height="120px" width="130px">
                                </div>
                            </div>
                        </div>  
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <label for="nombre_apellido" class="col-form-label"><b>Apellido y Nombre: </b></label>
                            <div class="col">
                            <input type="text" readonly class="form-control-plaintext" name="nombre_apellido" id="nombre_apellido">
                            </div>
                        </div>
                    </div>
                    <div class="ml-3 mr-2">
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group row">
                                    <label for="fecha_de_nacimiento" class="col-form-label"><b>Fecha de Nacimiento: </b></label>
                                    <div class="col">
                                    <input type="text" readonly class="form-control-plaintext" name="fecha_de_nacimiento" id="fecha_de_nacimiento">
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group row">
                                    <label for="dni" class="col-form-label"><b>DNI: </b></label>
                                    <div class="col">
                                        <input type="text" readonly class="form-control-plaintext" name="dni" id="dni">
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group row">
                                    <label for="lu_legajo" class="col-form-label"><b>Legajo: </b></label>
                                    <div class="col">
                                        <input type="text" readonly class="form-control-plaintext" name="lu_legajo" id="lu_legajo">
                                    </div>
                                </div>
                            </div>        
                        
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="domicilio" class="col-form-label"><b>Domicilio: </b></label>
                                    <div class="col">
                                        <input type="text"  readonly class="form-control-plaintext" id="domicilio" name="domicilio">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="email_usuario" class="col-form-label"><b>Email: </b></label>
                                    <div class="col">
                                        <input type="text"  readonly class="form-control-plaintext" id="email_usuario" name="email_usuario">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3">
                                <div class="form-group row">
                                    <label for="telefono" class="col-form-label"><b>Teléfono: </b></label>
                                    <div class="col">
                                    <input type="text" readonly class="form-control-plaintext" name="telefono" id="telefono">
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group row">
                                    <label for="linea_telefono" class="col-form-label"><b>Línea: </b></label>
                                    <div class="col">
                                        <input type="text" readonly class="form-control-plaintext" name="linea_telefono" id="linea_telefono">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group row">
                                    <label for="telefono_emergencia" class="col-form-label"><b>Tel. Emergencia: </b></label>
                                    <div class="col">
                                        <input type="text" readonly class="form-control-plaintext" name="telefono_emergencia" id="telefono_emergencia">
                                    </div>
                                </div>
                            </div>        
                            <div class="col-2">
                                <div class="form-group row">
                                    <label for="linea_emergencia" class="col-form-label"><b>Línea: </b></label>
                                    <div class="col">
                                    <input type="text" readonly class="form-control-plaintext" name="linea_emergencia" id="linea_emergencia">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="lugar_de_trabajo" class="col-form-label"><b>Lugar de trabajo: </b></label>
                                    <div class="col">
                                        <input type="text" readonly class="form-control-plaintext" name="lugar_de_trabajo" id="lugar_de_trabajo">
                                    </div>
                                </div>
                            </div> 
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="vencimiento_cm" class="col-form-label"><b>Vencimiento Certificado Médico: </b></label>
                                    <div class="col">
                                    <input type="text" readonly class="form-control-plaintext" name="vencimiento_cm" id="vencimiento_cm">
                                    </div>
                                </div>
                            </div> 
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="vencimiento_arancel" class="col-form-label"><b>Vencimiento Último Arancel: </b></label>
                                    <div class="col">
                                        <input type="text" readonly class="form-control-plaintext" name="vencimiento_arancel" id="vencimiento_arancel">
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