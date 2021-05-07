<div class="tablas-listado" id="contenido">
    <h1>Registro Proceso</h1>  
    <form method="post">
        <table class="tabla-alta">
            <tr>
                <td class="derecha"><p>Descripción : </p></td>
                <td>
	                <input class="mayusculas" type="text" placeholder="Descripcion Proceso General ... " name="descripcion_proceso" required>
                </td>
            </tr>
            <tr> 
                <td class="derecha"><p>Codigo Proceso : </p></td>
                <td>
                    <input class="mayusculas" type="text" placeholder="XXXX99 ... " name="codigo_proceso" required>
                </td>
            </tr>
            <tr>
                <td class="derecha"><p>Proceso General : </p></td>
                <td>
                    <select name="id_proceso_general_pp" id="id_proceso_general_pp">
                    <?php
                        $registro = new MvcController();
                        $registro -> vistaSelectProcesosGeneralController();
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="derecha"><p>Comentarios Proceso : </p></td>
                <td>
                    <textarea class="mayusculas" placeholder="Comentarios sobre el Proceso ..." cols="30" rows="10" name="comentarios_proceso" ></textarea>
                </td>
            </tr>
            <tr>
                <td class="derecha"><p>Tiempo Promedio : </p></td>
                <td>
                    <input step="1" value="0" type="number" name="tiempo_promedio_proceso" id="tiempo_promedio_proceso">
                </td>
            </tr>
        </table>
        <input class="btn-registrar" type="submit" value="REGISTRAR">
    </form>
</div>
<?php
    $registro = new MvcController();
    $registro -> registroProcesoController();
?>