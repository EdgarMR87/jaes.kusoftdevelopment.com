<div class="tablas-listado" id="contenido">
    <h1>FINALIZAR ORDEN DE SERVICIO</h1>
    <form method="post" class="form-alta-serv">
        <table class="tabla-alta-serv" id="encabezado-finailzaros"> 
            <tr>
                <td class="">
                    <p class="">Orden de Servicio : </p>
                </td>
                <td class="">
                    <input id="orden_servicio" type="text" name="orden_servicio">
                </td>
                <td class="">
                    <p class="">Fecha/Hora Termino : </p>
                </td>
                <td class="">
                   <input type="datetime-local" name="fecha_termino">
                </td>
                <td class="">
                    <p class="">Fecha/Hora Liberación : </p>
                </td>
                <td class="">
                   <input type="datetime-local" name="fecha_liberacion">
                </td>
            </tr>
        </table> 
        <input class="btn-registrar" type="submit" value="FINALIZAR">           
    </form>
</div>
<?php 
    ini_set('display_errors', '1');
    ini_set('error_reporting', E_ALL);
    $vistaUsuario = new MvcController();
    $vistaUsuario -> finalizarOSController();
?>