@extends('layouts.home')
@section('content')
<div class="container">
    <div class="row d-flex justify-content-center mt-4">
        <h1 class="media-heading">REGISTRAR BIEN PATRIMONIAL</h1>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
        <div class="col-lg-12 mt-1">
            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="mensaje-bp" style="display: none;">
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-start">
        <div class="col-md-6">
            <div class="form-group">
                {!! Field::text('nombrebp',null, ['class'=>'form-control','value'=>'old(nombrebp)'])!!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {!! Field::select('id_albergue', $albergues, ['class'=>'select-albergue','empty'=>'-Seleccione un albergue-'])!!} 
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Field::number('cantidad',null, ['class'=>'form-control'])!!}
            </div>
        </div>
        <div class="col-md-4 d-flex align-items-center">
            <button class="btn btn-primary" id="agregarfila"><i class="fa fa-plus"></i> Agregar</button>
        </div>
    </div>
    <div class="row ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!-- TABLE BIENES POR ALBERGUE -->
                <div class="table-responsive">
                    <table class="table table-borderless table-hover text-center" id="mytable">
                        <thead class="thead-dark">
                            <!-- <th>Nº</th> -->
                            <th>Albergue</th>
                            <th>Cantidad</th>
                            <th>Borrar</th>
                        </thead>
                    </table>
                </div>
            </div>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="form-group mx-auto">
            <!-- {!! Form::reset(' Limpiar datos',['class'=>'btn btn-danger btn-lg'])!!} -->
            <!-- <button type="button" class="btn btn-danger btn-lg" id="btn_cancelar"> <i class="fa fa-close"></i> Cancelar</button> -->
            <a class="btn btn-danger btn-lg" href="{{ URL::previous() }}"> <i class="fa fa-close"></i> Cancelar</a>
            <button type="button" class="btn btn-primary btn-lg" id="btn_guardar_bp" onclick="guardarBienPatrimonial()"> <i class="fa fa-save"></i> Guardar</button>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script >
    $(function(){ 
        $("#agregarfila").click(function(){
            id_albergue=document.getElementById('id_albergue').value;
            nombre_albergue=$("#id_albergue option:selected").text();
            cantidad = document.getElementById('cantidad').value;
            var band = false;
            var filas= $('#mytable').find("tr");
            for(i = 1; i < filas.length; i++){
                var celdas = $(filas[i]).find("td");
                var idAlbergue=celdas[0].getAttribute('id');
                if(idAlbergue == id_albergue){
                    band = true;
                }
            }
            // console.log("esta en tabla->",band);
            if (cantidad !="" && id_albergue!="" && !band){
                // var fila="<td>"+nrows+"</td><td>"+nombre_albergue+"</td><td>"+cantidad+"</td><td><button type='button' class='remove-item borrar btn btn-danger'><span class='fa fa-remove'></span></button></td>";
                var fila="<td id='"+id_albergue+"'>"+nombre_albergue+"</td><td>"+cantidad+"</td><td><button type='button' class='remove-item borrar btn btn-danger'><span class='fa fa-remove'></span></button></td>";
                $("#mytable").append("<tr id='albergue"+id_albergue+"'>"+fila+"</tr>");//agrega nueva fila a table
                $('.remove-item').off().click(function(e) {
                    $(this).parent('td').parent('tr').remove();//borra fila
                });
            }
        });
    });
</script>
<script type="text/javascript">
    function guardarBienPatrimonial(){ 
            console.log("btn_guardar_bp click");
            var nombre_bienpatrimonial=document.getElementById('nombrebp').value; //NOMBRE BIEN PATRIMONIAL
            //BIENES POR ALBERGUE
            var filas= $('#mytable').find("tr");
            var bienesporalbergue = [];
            var albergues = [];
            var cantidad = [];
            for(i = 1; i < filas.length; i++){
                var celdas = $(filas[i]).find("td");
                var idAlbergue=celdas[0].getAttribute('id');
                var cantidadTotal = celdas[1].innerHTML;
                albergues.push(idAlbergue);
                cantidad.push(cantidadTotal);
                // bienesporalbergue.push({idAlbergue:idAlbergue,cantidadTotal:cantidadTotal});
            }
            // console.log(bienesporalbergue);
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                type: "post",
                data: {
                    nombre_bienpatrimonial: nombre_bienpatrimonial,
                    // bienesporalbergue:bienesporalbergue
                    albergues: albergues,
                    cantidad:cantidad
                },
                success: function(response){
                    console.log(response);
                    if (response.mensaje == "error"){
                        var obj = jQuery.parseJSON( response.error );
                        console.log(obj["nombre_bienpatrimonial"][0]);
                        document.getElementById('mensaje-bp').innerHTML=obj["nombre_bienpatrimonial"][0];
                        $('#mensaje-bp').attr("style","display: block");

                    } else {
                        $(location).attr('href',"/bienespatrimoniales");
                    }
                    
                }, fail: function(){
                    console.log("error stored bienes patrimoniales");
                }
            });
    };
</script>
<!-- <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        $(function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
                });
            }, false);
        })();
</script> -->
@endpush