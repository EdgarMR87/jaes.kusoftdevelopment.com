<div class="tablas-listado" id="contenido">
    <h1>EDITAR SERVICIO ATR</h1>

    <form method="post">
        <table class="tabla-alta">
        <?php 

    	    $vistaUsuario = new MvcController();
            $respuesta = $vistaUsuario -> editarServicioAtrController();
            $date = date_create($respuesta["fecha_creacion_serv"]);
    		$fecha = date_format($date, 'Y-m-d H:m:s');
        ?>
	    <tr>
			<input type="hidden" name="id_servicio_editar" value="<?php echo $respuesta['id_servicio']; ?>">
			<td class="derecha"><p>Codigo Servicio ATR : </p></td>
            <td>
	            <input class="mayusculas" type="text" value="<?php echo $respuesta['codigo_atr_serv']; ?>" name="codigo_atr_serv_editar" required>
            </td>
        </tr>
        <tr>
            <td class="derecha"><p>Nombre Servicio : </p></td>
            <td>
                <input class="mayusculas" type="text" value="<?php echo $respuesta['descripcion_serv']; ?>" name="descripcion_serv_editar" required>
            </td>
        </tr>
        <tr> 
            <td class="derecha"><p>Comentarios Servicio : </p></td>
            <td>
                <textarea cols="30" rows="10" name="comentarios_serv_editar" ><?php echo $respuesta['descripcion_serv']; ?></textarea>
            </td>
        </tr>
        <tr>
            <td class="derecha"><p>Fecha Creación : </p></td>
            <td>
                <input class="mayusculas" type="text" value="<?php echo $fecha; ?>" name="fecha_creacion_serv" disabled>
            </td>
        </tr>
        <tr>
            <td class="derecha"><p>Estado Servicio : </p></td>
            <td>
                <select name="estado_serv_editar">
                    <?php
                        if($respuesta['estado_serv'] == "ACTIVO"){
                            echo "<option value='ACTIVO' selected>ACTIVO</option>";
                            echo "<option value='BAJA'>BAJA</option>";
                        } else{
                            echo "<option value='ACTIVO'>ACTIVO</option>";
                            echo "<option value='BAJA' selected>BAJA</option>";
                        }
                    ?>
                </select>
            </td>
        </tr>
    </table>
    <input class="btn-actualizar" type="submit" value="Actualizar">
	</form>
    <?php  $vistaUsuario -> actualizarServicioAtrController(); ?>
</div>