<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	
	<h2>¡Hola! {$datos->usuario} {$datos->nusuario} </h2>
	<p> Se le informa que su Arancel por el uso de las instalaciones de la DEFyD se encuentra vencido desde: <b> 
		<?php
			if ($datos->ultimo_arancel== NULL){
				echo "NO REGISTRA ARANCEL";
			}else{
				$fv = new DateTime($datos->ultimo_arancel); echo $fv->format('d-m-Y');
			}
		?>
		</b>

		<br>
	¡Gracias!
	</p>

	<small >Dirección de Educación Física y Deportes - UNSa.</small>
</body>
</html>