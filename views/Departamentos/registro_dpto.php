<div class="tablas-listado" id="contenido">
	<h1>REGISTRO DEPARTAMENTO</h1>
	<form method="post">
    <table class="tabla-alta">
		<tr>
            <td class="derecha"><p>Nombre : </p></td>
            <td>
                <input class="mayusculas" type="text" placeholder="Nombre del departamento" name="nombre_dpto" required>
            </td>
        </tr>
        <tr>
            <td class="derecha"><p>Descripción  : </p></td>
            <td>
                <input class="mayusculas" type="text" placeholder="Descripcion del departamento" name="descripcion_dpto">
            </td>
        </tr>
        </table>
	<input class="btn-registrar" type="submit" value="Enviar">
    
</form>

<?php

$registro = new MvcController();
$registro -> registroDepartamentoController();

if(isset($_GET["action"])){

	if($_GET["action"] == "dpto_ok"){

		echo "<span class='registro-ok'>Registro Exitoso</span>";
	
	}

}

?>
</div>