<div class="tablas-listado" id="contenido">
    <?php
        $vistaUsuario = new MvcController();
        $respuesta = $vistaUsuario -> editarProcesoGralController();
    ?>
    <h1>Editando <?php echo  $respuesta["descripcion_proceso_general"]; ?></h1>  
    <form method="post">
        <table class="tabla-alta">
            <tr>
                <input type="hidden" name="id_proceso_actualizar" value="<?php echo $respuesta["id_proceso_general"]; ?>">
                <td class="derecha"><p>Descripción : </p></td>
                <td>
	                <input class="mayusculas" type="text" value="<?php echo $respuesta["descripcion_proceso_general"]; ?>" name="descripcion_proceso" required>
                </td>
            </tr>
            <tr>
                <td class="derecha"><p>Comentarios Proceso : </p></td>
                <td>
                    <textarea class="mayusculas" cols="30" rows="10" name="comentarios_proceso"><?php echo $respuesta["comentarios_proceso_general"] ?></textarea>
                </td>
            </tr>
        </table>
        <input class="btn-actualizar" type="submit" value="ACTUALIZAR">
    </form>
</div>
<?php
    $registro = new MvcController();
    $registro -> actualizarProcesoGralController();
?>