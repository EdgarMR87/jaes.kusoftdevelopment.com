<div class="tablas-listado" id="contenido">
	<h1>REGISTRO UNIDAD</h1>

<form method="post">
	<table class="tabla-alta">
		<tr>
			<td class="derecha"><p>Numero Unidad : </p></td>
			<td>
				<input type="text" placeholder="# Unidad" name="num_unidad" required>
			</td>
		</tr>
		<tr>
			<td class="derecha"><p>Modelo Unidad :</p></td>
			<td>
    			<input type="text" placeholder="Modelo Unidad" name="modelo">
			</td>
		</tr>
	</table>
	<input class="btn-registrar" type="submit" value="Enviar">
</form>
</div>
<?php

$registro = new MvcController();
$registro -> registroUnidadController();

if(isset($_GET["action"])){

	if($_GET["action"] == "Unidades/altaUnidadOk"){

		echo "<span class='registro-ok'>Registro de Unidad Exitoso</span>";
	
	}

}

?>
