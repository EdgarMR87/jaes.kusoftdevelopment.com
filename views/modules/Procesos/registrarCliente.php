<div class="tablas-listado" id="contenido">
    <h1>Registrar Cliente</h1>  
    <form method="post">
        <table class="tabla-alta">
            <tr>
                <td class="derecha"><p>Razón Social : </p></td>
                <td>
	                <input class="mayusculas" type="text" placeholder="Razon social cliente . . . " name="razon_social_cliente" required>
                </td>
            </tr>
            <tr> 
                <td class="derecha"><p>Codigo Proyectos Cliente : </p></td>
                <td>
                    <input class="mayusculas" type="text" maxlength="3" placeholder="XXXX ... " name="codigo_proyecto_cliente" required>
                </td>
            </tr>
        </table>
        <input class="btn-registrar" type="submit" value="REGISTRAR">
    </form>
</div>
<?php
    $registro = new MvcController();
    $registro -> registrarClienteController();
?>