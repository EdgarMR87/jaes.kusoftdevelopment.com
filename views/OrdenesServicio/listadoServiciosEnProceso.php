<script>

//FUNCIONA PARA DETECTAR CUANDO DEN CLICK EN LA PARTIDA Y SABER A QUIEN ASIGANAR LOS USUARIOS
function clickaction( b ){
    document.getElementById('id_partida_os_asignar').value = b.id;
    var id_dpto_serv = b.dataset.dptoserv;
    $.ajax({
        type: 'POST',
        url: '/views/modules/OrdenesServicio/obtenerTrabajador',
        data: {'id_dpto_serv' : id_dpto_serv},
        dataType: "html",
        success: function(resp){
            $('#usuarios').html(resp);
        }
    });
}

$(document).ready(function(){
    //AGREGAR USUARIOS A LA TABLA DE USUARIOS QUE SE ASIGNARAN AL SERVICIO
    $("#agregar-user").click(function(){
        var id_usuario = $("#usuarios").val();
        var nombre_usuario = $("#usuarios option:selected").text();
        var htmlTags = '<tr>'+
                    '<td>' + id_usuario  + '<input type="hidden" name="usuariosAsignados[]" value="' + id_usuario + '"></td>'+
                    '<td>' + nombre_usuario +'</td>'+
                    '<td><a class="borrar"><img src="/views/img/eliminar.png" class="img25"></img></a></td>'+
                    '</tr>';
                    $('#tabla-user-pre tbody').append(htmlTags);
    });

    //EVENTO DEL BOTON ELIMINAR FILA
    $(document).on('click', '.borrar', function (event) {
        event.preventDefault();
        $(this).closest('tr').remove(); //ELIMINAS FILA
        actualizarFilas(); //REORDENAMOS LOS NUMEROS DE CONSECUTIVO
    });
});

</script>

<?PHP
    echo "<script> window.document.title = 'SERVICIOS EN PROCESO'</script>";
?>
<div class="tablas-listado" id="contenido">
    <h1>SERVICIOS EN PROCESO  : <?php echo date('Y-m-d'); ?></h1>
    <table class="listado-previo" id="tabla-servicios-pre">
        <thead>
            <th class="listado-th">OS</th>
            <th class="listado-th">Unidad</th>
            <th class="listado-th">Servicio</th>
            <th class="listado-th">Comentario Inicial</th>
            <th class="listado-th">Comentario Final</th>
            <th class="listado-th">Observaciones</th>
            <th class="listado-th">Fecha Creación</th>
            <th class="listado-th">Fecha Inicio</th>
            <th class="listado-th">Asignar</th>
            <th class="listado-th">Asignado a</th>
        </thead>
        <tbody>
            <?php 
                /*ini_set('display_errors', '1');
                ini_set('error_reporting', E_ALL);*/
    		    $vistaUsuario = new MvcController();
    		    $respuesta = $vistaUsuario -> vistaPartidasEnProcesoController();
                foreach($respuesta as $row => $campo){
                echo "<tr> 
                    <td>".
                        $campo[0]
                    ."</td>
                    <td>".
                        $campo['id_unidad_servicio']
                    ."</td>
                    <td>".
                        $campo['descripcion_serv']
                    ."</td>
                    <td>".
                        $campo['comentarios_os']
                    ."</td>
                    <td>".
                        $campo['comentario_final']
                    ."</td>
                    <td>".
                        $campo['observaciones_os']
                    ."</td>
                    <td>".
                        $campo['fecha_creacion_partida_os']
                    ."</td>
                    <td>".
                        $campo['fecha_inicio_partida_os']
                    ."</td>
                    <td><a onclick=clickaction(this) href='#openModalIniciar' id='". $campo['id_partida_os'] ."' data-os='". $campo['num_orden_partida_os']."' data-dptoServ='".$campo['id_dpto_serv']."'><img class='ico-partida' src='/views/img/asignar.png'></a></td>
                    </td>
                    <td>
                        <a href='index.php?action=OrdenesServicio/usuariosAsignados&id_partida_os=".$campo['id_partida_os']."&OS=".$campo['num_orden_partida_os']."'>".
                        👥
                        ."</a>
                    </td>
                    </tr>";
                }
		    ?>
        </tbody>
    </table>
</div>


<div id="openModalIniciar" class="modalDialog">
	<div>
    	<a href="#close" title="Close" class="close">X</a>
        <h1>ASIGNAR USUARIO(S)</h1>
        <form action="" method="post">
        <table>
            <input type="hidden" name="id_partida_os" id="id_partida_os">
            <input type="hidden" name="id_partida_os_asignar" id="id_partida_os_asignar">
            <tr>
                <td class="titulo"><p class="derecha">Asignar a : </p></td>
                    <td>
                       <select name="usuarios" id="usuarios">
                           <?php
                                $vistaUsuario = new MvcController();
                                $vistaUsuario -> obtenerTrabajadorController();   
                            ?>
                        </select>
                    </td>
                <td>
                    <input class="btn-agregar-serv" type="button" value="Añadir" name="agregar-user" id="agregar-user">
                </td>
            </tr>
        </table>
        <table class="listado-previo" id="tabla-user-pre">
            <thead>
                <th class="listado-th">Id Usuario</th>
                <th class="listado-th">Usuario - Nombre Completo</th>
                <th class="listado-th">Eliminar</th>
            </thead>
            <tbody>
            </tbody>
        </table>
        <input class="btn-registrar" type="submit" value="ASIGNAR USUARIO(S)">
        </form>
	</div>
</div>
<?php
    $vistaUsuario -> asignarUsuariosServicioListadoController();  
?> 