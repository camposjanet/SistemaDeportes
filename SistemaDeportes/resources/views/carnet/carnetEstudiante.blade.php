<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Carnet de {{$ficha->apellido}}, {{$ficha->nombre}}</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin: 0px;
        }
        table th,
        table td {
                   
            font-weight: normal;
            border: 1px solid;
            border-left: none;
            border-right: none;
            border-top: none;
            border-bottom: none;
            padding: 2px;
        }
        
        .table-bordered {
            color: black;
            border: 1px solid;
        }
        
        .table-bordered1 {
            color: black;
            
            border: 1px solid;
        }
        .table-bordered2 {
            color: black;
            border: 1px solid;
            border-top: none;
            padding: 2px;
        }
        .img-redonda {
            width:60px;
            height:70px;
            vertical-align: middle;
            margin: 0px 0px 0px 0px;
            float: left;
        }
        @page {
        margin-top: 5mm;
        margin-bottom: 5mm;
        margin-left: 10mm;
        margin-right: 5mm;
        }
    </style>
  </head>
  <body >
    <main>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tbody>
                <tr>
                    <td style="width: 50%; vertical-align: top;">
                        <table class="table-bordered1" style="border-bottom:2px; width:340px;height: 45px;float: left;">
                            <tbody >
                                <tr >
                                    <td style="width:60px;height: 45px;" rowspan="3">
                                        <img class="img-redonda" src="./img/logounsa.png" id="img" alt="Logo">
                                    </td>
                                    <td style="height: 35px;">
                                        <h6>UNIVERSIDAD NACIONAL DE SALTA</h6>
                                        <h6>DIRECCIÓN DE DEPORTES</h6>
                                    </td> 
                                </tr>
                                <tr>
                                    <td style="height: 10px;vertical-align: bottom; text-align: right;">
                                        <h4>Nº {{$ficha->id}}</4>
                                    </td>
                                </tr>
                                <tr style="text-align: center;" >
                                    <td style="text-align: center;" ><h4><u>SALA DE MUSCULACIÓN</u></h4></td>
                                </tr>
                                <tr >
                                    <td colspan="3" style="height: 20px;">  Categoría: ESTUDIANTE</td>
                                </tr>
                            </tbody>
                        </table> 
                        <table class="table-bordered2" style="border-bottom:2px; width:340px;height: 183px;">
                            <tbody >
                                <tr >
                                    <td style="width:100px;border-bottom: 1px solid;vertical-align: top;" rowspan="5">
                                    <img width="90" height="100" src="../public/img/usuarios/{{$ficha->foto}}"/>
                                    </td>
                                    <td style="font-size: 0.8em;height: 35px;vertical-align: top;">Apellido y Nombre: {{$ficha->apellido}}, {{$ficha->nombre}}</td>
                                    
                                </tr>
                                <tr>
                                    <td style=" font-size: 0.8em;" >
                                    DNI: {{$ficha->dni}}
                                    </td>
                                </tr>
                                <tr><td style="font-size: 0.8em;" > LU: {{$ficha->lu}}
                                    </td>
                                </tr>
                                <tr><td style="font-size: 0.8em;">Facultad: {{$ficha->unidad}}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 30px; font-size: 0.5em; vertical-align: bottom; text-align: center; border-bottom: 1px solid;"> Resp. de Deportes
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td style="width: 50%; vertical-align: top;">
                        <table style="border: 1px solid; width:340px;">
                            <tbody >
                                <tr>
                                    <td style="width:58px;height: 75px; font-size: 0.9em;border: 1px solid;">
                                    Pago:
                                    ..../..../....
                                    Vence:
                                    ..../..../....</td>
                                    <td style="width:58px;height: 75px; font-size: 0.9em;border: 1px solid;">
                                    Pago:
                                    ..../..../....
                                    Vence:
                                    ..../..../....</td>
                                    <td style="width:58x;height: 75px; font-size: 0.9em;border: 1px solid;">
                                    Pago:
                                    ..../..../....
                                    Vence:
                                    ..../..../....</td>
                                    <td style="width:58px;height: 75px; font-size: 0.9em;border: 1px solid;">
                                    Pago:
                                    ..../..../....
                                    Vence:
                                    ..../..../....</td>
                                </tr>
                                <tr>
                                    <td style="width:58px;height: 75px; font-size: 0.9em;border: 1px solid;">
                                    Pago:
                                    ..../..../....
                                    Vence:
                                    ..../..../....</td>
                                    <td style="width:58px;height: 75px; font-size: 0.9em;border: 1px solid;">
                                    Pago:
                                    ..../..../....
                                    Vence:
                                    ..../..../....</td>
                                    <td style="width:58x;height: 75px; font-size: 0.9em;border: 1px solid;">
                                    Pago:
                                    ..../..../....
                                    Vence:
                                    ..../..../....</td>
                                    <td style="width:58px;height: 75px; font-size: 0.9em;border: 1px solid;">
                                    Pago:
                                    ..../..../....
                                    Vence:
                                    ..../..../....</td>
                                </tr>
                                <tr>
                                    <td style="width:58px;height: 75px; font-size: 0.9em;border: 1px solid;">
                                    Pago:
                                    ..../..../....
                                    Vence:
                                    ..../..../....</td>
                                    <td style="width:58px;height: 75px; font-size: 0.9em;border: 1px solid;">
                                    Pago:
                                    ..../..../....
                                    Vence:
                                    ..../..../....</td>
                                    <td style="width:58x;height: 75px; font-size: 0.9em;border: 1px solid;">
                                    Pago:
                                    ..../..../....
                                    Vence:
                                    ..../..../....</td>
                                    <td style="width:58px;height: 75px; font-size: 0.9em;border: 1px solid;">
                                    Pago:
                                    ..../..../....
                                    Vence:
                                    ..../..../....</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>  
  </body>
</html>