<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
	
	<h2>¡Hola! {{$datos->usuario}} {{$datos->nusuario}} </h2>
	<p> Se le informa que su Arancel por el uso de las instalaciones de la DEFyD  <b> 
		<?php
			if ($datos->ultimo_arancel== NULL){
				echo "todavía no ha sido pagado.";
			}else{
				$fv = new DateTime($datos->ultimo_arancel); echo "se encuentra vencido desde: ". $fv->format('d-m-Y');
			}
		?>
		</b>

		<br>
	¡Gracias!
	</p>

	<small >Dirección de Educación Física y Deportes - UNSa.</small>
</body>
</html>