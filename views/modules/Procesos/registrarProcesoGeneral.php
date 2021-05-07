<div class="tablas-listado" id="contenido">
    <h1>Registro Proceso General</h1>  
    <form method="post">
        <table class="tabla-alta">
            <tr>
                <td class="derecha"><p>Proceso General : </p></td>
                <td>
	                <input class="mayusculas" type="text" placeholder="Descripcion Proceso General ... " name="descripcion_proceso_general" required>
                </td>
            </tr>
            <tr> 
                <td class="derecha"><p>Comentarios Proceso General : </p></td>
                <td>
                    <textarea class="mayusculas" placeholder="Comentarios sobre el Proceso ..." cols="30" rows="10" name="comentarios_proceso_general" ></textarea>
                </td>
            </tr>
        </table>
        <input class="btn-registrar" type="submit" value="REGISTRAR">
    </form>
</div>

<?php
    $registro = new MvcController();
    $registro -> registroProcesoGeneralController();
?>