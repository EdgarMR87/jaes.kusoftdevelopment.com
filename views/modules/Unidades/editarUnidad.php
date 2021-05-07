<div class="tablas-listado" id="contenido">
    <h1>EDITAR UNIDAD</h1>

    <form method="post">
        <table class="tabla-alta">
            <?php 
 ini_set('display_errors', '1');
 ini_set('error_reporting', E_ALL);
	            $vistaUsuario = new MvcController();
                $respuesta = $vistaUsuario -> editarUnidadController();
                $date = date_create($respuesta["fecha_creacion"]);
                $fecha = date_format($date, 'Y-m-d H:m:s');
            ?>
        <tr>
            <input type="hidden" name="id_unidad_editar" value="<?php echo $respuesta['id_unidad']; ?>">
			<td class="derecha"><p>Numero Unidad : </p></td>
			<td>
				<input type="text" value="<?php echo $respuesta['num_unidad']; ?>" name="num_unidad_editar" required>
			</td>
		</tr>
		<tr>
			<td class="derecha"><p>Modelo Unidad :</p></td>
			<td>
    			<input class="mayusculas" type="text" value="<?php echo $respuesta['modelo']; ?>" name="modelo_unidad_editar">
			</td>
		</tr>
        <tr>
			<td class="derecha"><p>Fecha Creación :</p></td>
			<td>
    			<input type="text" value="<?php echo $fecha; ?>" name="fecha_creacion" disabled>
			</td>
		</tr>
        <tr>
			<td class="derecha"><p>Creado Por : </p></td>
			<td>
    			<input type="text" value="<?php echo $respuesta['usuario']; ?>" name="usuario" disabled>
			</td>
		</tr>
        <tr>
            <td class="derecha"><p>Estado Unidad : </p></td>
            <td>
                <select name="estado_unidad_editar">
                    <?php
                        switch($respuesta['estado']){
                        case "ACTIVO":
                            echo "<option value='ACTIVO' selected>ACTIVO</option>";
                            echo "<option value='BAJA'>BAJA</option>";
                            echo "<option value='ENREPARACION'>ENREPARACION</option>";
                            break;
                        case "BAJA":
                            echo "<option value='ACTIVO'>ACTIVO</option>";
                            echo "<option value='BAJA' selected>BAJA</option>";
                            echo "<option value='ENREPARACION'>ENREPARACION</option>";
                        break;
                        case "ENREPARACION":
                            echo "<option value='ACTIVO'>ACTIVO</option>";
                            echo "<option value='BAJA'>BAJA</option>";
                            echo "<option value='ENREPARACION' selected>ENREPARACION</option>";
                        break;
                        }
                    ?>
                </select>
            </td>
        </tr>




    </table>
    <input class="btn-actualizar" type="submit" value="Actualizar">
<?php
    $vistaUsuario -> actualizarUnidadController();
?>
</form>
</div>