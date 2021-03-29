<div class="tablas-listado" id="contenido">
    <h1>REGISTRO PUESTO</h1>
    <form method="post">
        <table class="tabla-alta">
		    <tr>
                <td class="derecha"><p>Nombre : </p></td>
                <td>
	                <input class="mayusculas" type="text" placeholder="Nombre del Puesto" name="nombre_puesto" required>
                </td>
            </tr>
            <tr>
                <td class="derecha"><p>Descripción: </p></td>
                <td>
                    <input class="mayusculas" type="text" placeholder="Descripcion del Puesto" name="descripcion_puesto">
                </td>
            </tr>
		    <tr>
                <td class="derecha"><p>Departamento : </p></td>
                <td>
                    <select name="id_departamento_puesto" id="id_departamento_puesto">
	                <?php
	                    $vistaUsuario = new MvcController();
		                $vistaUsuario -> vistaDepartamentosController();		
	                ?>
	                </select>
                </td>
            </tr>
        </table>
	    <input class="btn-registrar" type="submit" value="Enviar">
    </form>
<?php

$registro = new MvcController();
$registro -> registroPuestoController();

?>
</div>