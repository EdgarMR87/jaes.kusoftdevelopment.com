<div class="tablas-listado" id="contenido">
    <?php
        $vistaUsuario = new MvcController();
        $respuesta = $vistaUsuario -> editarProcesoController();
    ?>
    <h1>Editando <?php echo  $respuesta["descripcion_proceso"]; ?></h1>
    <form method="post">
        <table class="tabla-alta">
            <tr>
                <td class="derecha"><p>Descripción : </p></td>
                <td>
                    <input type="hidden" name="id_proceso_editar" value="<?php echo $respuesta["id_proceso_prod"]; ?>">
	                <input class="mayusculas" type="text" value="<?php echo $respuesta["descripcion_proceso"]; ?>" name="descripcion_proceso" required>
                </td>
            </tr>
            <tr> 
                <td class="derecha"><p>Codigo Proceso : </p></td>
                <td>
                    <input class="mayusculas" type="text" value="<?php echo $respuesta["codigo_proceso"]; ?>" name="codigo_proceso" required>
                </td>
            </tr>
            <tr>
                <td class="derecha"><p>Proceso General : </p></td>
                <td>
                    <select name="id_proceso_general_pp" id="id_proceso_general_pp">
                    <?php
                        $registro = new MvcController();
                        $registro -> vistaSelectProcesosGeneralSelectController($respuesta["id_proceso_general_pp"]);
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="derecha"><p>Comentarios Proceso : </p></td>
                <td>
                    <textarea class="mayusculas" cols="30" rows="10" name="comentarios_proceso" ><?php echo  $respuesta["comentarios_proceso"]; ?></textarea>
                </td>
            </tr>
            <tr>
                <td class="derecha"><p>Tiempo Promedio : </p></td>
                <td>
                    <input step="1" value="<?php echo $respuesta["tiempo_promedio_proceso"]; ?>" type="number" name="tiempo_promedio_proceso" id="tiempo_promedio_proceso">
                </td>
            </tr>
        </table>
        <input class="btn-actualizar" type="submit" value="ACTUALIZAR">
    </form>
</div>
<?php
    $registro = new MvcController();
    $registro -> actaulizarProcesoController();
?>