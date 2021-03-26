<div class="tablas-listado" id="contenido">
    <h1>REGISTRO SERVICIO ATR</h1>  
    <form method="post">
        <table class="tabla-alta">
            <tr>
                <td class="derecha"><p>Codigo Servicio ATR : </p></td>
                <td>
	                <input class="mayusculas" type="text" placeholder="Codigo Servicio ATR" name="codigo_atr_serv" required>
                </td>
            </tr>
            <tr>
                <td class="derecha"><p>Nombre Servicio : </p></td>
                <td>
                    <input class="mayusculas" type="text" placeholder="Nombre de Servicio" name="descripcion_serv" required>
                </td>
            </tr>
            <tr> 
                <td class="derecha"><p>Comentarios Servicio : </p></td>
                <td>
                    <textarea placeholder="Comentarios sobre el servicio..." cols="30" rows="10" name="comentarios_serv" ></textarea>
                </td>
            </tr>
        </table>
        <input class="btn-registrar" type="submit" value="REGISTRAR">
    </form>
</div>

<?php

$registro = new MvcController();
$registro -> registroServicioAtrController();

?>
