<script>
//EVENTO PARA ABRIR MODAL Y ASIGNAR USUARIOS 
function clickactionAsignar( b ){
    document.getElementById('id_partida_os_asignar').value = b.id;
    var id_dpto_serv = b.dataset.dptoserv;
    $.ajax({
        type: 'POST',
        url: '/views/modules/OrdenesServicio/obtenerTrabajador',
        data: {'id_dpto_serv' : id_dpto_serv},
        dataType: "html",
        success: function(resp){
            $('#usuariosAsignar').html(resp);
        }
    });
}


//EVENTO DEL BOTON AGREGAR PARTIDA 
function clickaction( b ){
    document.getElementById('id_partida_os_i').value = b.id; 
    document.getElementById('num_orden_iniciar').value = b.dataset.os;    
    $('#usuarios').val();
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

function clickactionFinalizar(b){
    document.getElementById('id_partida_os_f').value = b.id;
    document.getElementById('num_orden_finalizar').value = b.dataset.os; 
}

$(document).ready(function(){

    //AGREGAR USUARIOS A LA TABLA ASIGNAR 
    
    $("#agregar-user-asignar").click(function(){
        var id_usuario = $("#usuariosAsignar").val();
        var nombre_usuario = $("#usuariosAsignar option:selected").text();
        var htmlTags = '<tr>'+
            '<td>' + id_usuario  + '<input type="hidden" name="usuariosAsignados[]" value="' + id_usuario + '"></td>'+
            '<td>' + nombre_usuario +'</td>'+
            '<td><a class="borrar"><img src="/views/img/eliminar.png" class="img25"></img></a></td>'+
            '</tr>';
        $('#tabla-user-pre-asignar tbody').append(htmlTags);
    });


$("#agregar-user").click(function(){
    var id_usuario = $("#usuarios").val();
    var nombre_usuario = $("#usuarios option:selected").text();
    var htmlTags = '<tr>'+
        '<td>' + id_usuario  + '<input type="hidden" name="usuariosAsignadosInicio[]" value="' + id_usuario + '"></td>'+
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

//EVENTO CUANDO DEN CLICK EN UN PENDIENTE Y OBTENER SU IDA

});

</script>


<?PHP
    echo "<script> window.document.title = 'DETALLE ORDEN SERVICIO'</script>";
?>
<div class="tablas-listado" id="contenido">
    <div class="new-flotante">
        <a href="index.php?action=OrdenesServicio/historialOS">
            <img src="/views/img/busqueda.png" alt="">
        </a>
    </div>
    <h1>DETALLES DE LA ORDEN DE SERVICIO : <?php echO $_GET['id_os_editar']; ?></h1>
        <form method="post" class="form-alta-serv">
            <table class="tabla-alta-serv">
                <?php 
    		        $vistaUsuario = new MvcController();
    		        $datos_OS = $vistaUsuario -> editarOSAtrController();
		        ?>
                <tr>
                    <td class="titulo"><p class="derecha">Orden de Servicio : </p></td>
                    <td class=input>
                        <input type="number" value="<?php echo $datos_OS['num_orden']; ?>" name="num_orden" disabled>
                    </td>
                    <td class="titulo"><p class="derecha">Unidad : </p></td>
                    <td class=input>
                        <select name="id_unidad_servicio" id="id_unidad_servicio" disabled>
                            <?php 
                                $vistaUsuario -> vistaUnidadesSelectedController($datos_OS['id_unidad_servicio']);
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="titulo"><p class="derecha">Operador : </p></td>
                    <td class=input>
                        <input type="text" value="<?php echo $datos_OS['operador']; ?>" name="operador" disabled>
                    </td>
                    <td class="titulo"><p class="derecha">Capturo : </p></td>
                    <td class=input>
                        <input type="text" value="<?php echo $datos_OS['captura']; ?>" name="captura" disabled>
                    </td>
                </tr>
                <tr> 
                    <td class="titulo"><p class="derecha">Fecha Orden : </p></td>
                    <td class=input>
                        <input type="text" value="<?php echo $datos_OS['fecha_orden']; ?>" name="fecha_orden" disabled>
                    </td>
                    <td class="titulo"><p class="derecha">Kilometraje : </p></td>
                    <td class=input>
                        <input type="number" value="<?php echo $datos_OS['kilometraje']; ?>" name="kilometraje" disabled>
                    </td>
                </tr>
                <tr>
                    <td class="titulo"><p class="derecha">Servicio : </p></td>
                    <td class=input>
                        <?php 
                            $array_serv = $vistaUsuario -> obtenerServiciosOSController();
                            $array_tipo_serv = $vistaUsuario -> obtenerTipoServOSController();
                        ?>
                        <select name="servicio" id="servicio" disabled>
                        <?php 
                        foreach($array_serv as $valor => $servicio){
                            if($servicio == $datos_OS['servicio'])
                                echo "<option value='$servicio' selected>$servicio</option>";
                                else
                                echo "<option value='$servicio'>$servicio</option>";
                        }
                        ?>
                        </select>
                    </td>
                    <td class="titulo"><p class="derecha">Tipo de Servicio : </p></td>
                    <td class=input>
                        <select name="tipo_servicio" id="tipo_servicio" disabled>
                            <?php 
                            foreach($array_tipo_serv as $valor => $tipo_servicio){
                                if($tipo_servicio == $datos_OS['tipo_servicio'])
                                    echo "<option value='$tipo_servicio' selected>$tipo_servicio</option>";
                                else
                                    echo "<option value='$tipo_servicio'>$tipo_servicio</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>   
            </table>
            <table class="listado-previo" id="tabla-servicios-pre">
                <thead>
                    <th class="listado-th">Consec.</th>
                    <th class="listado-th">Codigo</th>
                    <th class="listado-th">Comentarios Iniciales</th>
                    <th class="listado-th">Comentarios Finales</th>
                    <th class="listado-th">Observaciones</th>
                    <th class="listado-th">Fecha Creación</th>
                    <th class="listado-th">Fecha Inicio</th>
                    <th class="listado-th">Fecha Termino </th>
                    <th class="listado-th">Estado</th>
                    <th class="listado-th">Accion</th>
                    <th class="listado-th">Asignar</th>
                    <th class="listado-th">Asignado a</th>                   
                </thead>
                <tbody>
                <?php 
    		        $vistaUsuario = new MvcController();
    		        $respuesta = $vistaUsuario -> editarPartidasOSController();
                    foreach($respuesta as $row => $campo){
                    echo "<tr> 
                       <td>".
                            $campo['consec_partida_os']
                       ."</td>
                       <td>".
                            $campo['codigo_partida_os']
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
                       <td>".
                            $campo['fecha_termino_partida_os']
                       ."</td>
                       <td class='". $campo['estado_partida_os']."'>".
                            $campo['estado_partida_os']
                        ."</td>";
                        switch($campo['estado_partida_os']){
                            case "PENDIENTE";
                             echo   "<td>
                                        <a onclick=clickaction(this) href='#openModalIniciar' id='". $campo['id_partida_os'] ."' data-os='". $campo['num_orden_partida_os']."' data-dptoserv='". $campo['id_dpto_serv'] ."'>
                                            <img class='ico-partida' src='/views/img/iniciar.png'>
                                        </a>
                                    </td><td></td>";
                            break;
                            case "ENPROCESO";
                            echo   "<td><a onclick=clickactionFinalizar(this) href='#openModalFinalizar' id='". $campo['id_partida_os'] ."' data-os='". $campo['num_orden_partida_os']."'><img class='ico-partida' src='/views/img/stop.png'></td>
                                    <td>
                                        <a onclick=clickactionAsignar(this) href='#openModalAsignar' id='". $campo['id_partida_os'] ."' data-os='". $campo['num_orden_partida_os']."' data-dptoServ='".$campo['id_dpto_serv']."'>
                                            <img class='ico-partida' src='/views/img/asignar.png'>
                                        </a>
                                    </td>";
                            break;
                            case "TERMINADO";
                            echo   "<td><img class='ico-partida' src='/views/img/listo.png'></td><td></td>";                       
                            break;
                        }
                        echo    "<td><a href='index.php?action=OrdenesServicio/usuariosAsignados&id_partida_os=".$campo['id_partida_os']."&OS=".$campo['num_orden_partida_os']."'>".
                        👥
                        ."</a></td>
                        </tr>";
                    }
		        ?>
                </tbody>
            </table>
        <div id="openModalIniciar" class="modalDialog">
	        <div>
    		    <a href="#close" title="Close" class="close">X</a>
                <h1>INICIAR SERVICIO </h1>
                <form class="form-alta-serv" method="post">
                <table>
                    <input type="hidden" name="id_partida_os_i" id="id_partida_os_i">
                    <input type="hidden" name="num_orden_iniciar" id="num_orden_iniciar">
                    <tr>
                        <td class="titulo"><p class="derecha">Comentarios : </p></td>
                        <td class="input" colspan="2">
                            <input id="comentarios_os" type="text" name="comentarios_os">
                        </td>
                    </tr>
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
                <input class="btn-registrar" type="submit" value="INICIAR">
                <?php  
                    $vistaUsuario -> iniciarServicioModalController();//AGREGAMOS LA VARIABLE DE INCIAR SERVICIO.
                ?>
                </form>
	        </div>
        </div>

        <!-- MODAL PARA FINALIZAR SERVICIO -->
        <div id="openModalFinalizar" class="modalDialog">
    	    <div>
	    	    <a href="#close" title="Close" class="close">X</a>
                <h1>FINALIZAR SERVICIO </h1>
                <form method="post">
                <table>                  
                    <input type="hidden" name="id_partida_os_f" id="id_partida_os_f">
                    <input type="hidden" name="num_orden_finalizar" id="num_orden_finalizar">
                    <tr>
                        <td class="titulo"><p class="derecha">Comentarios Finales: </p></td>
                        <td class="input" colspan="2">
                            <input id="comentarios_os" type="text" name="observacion_final_os_f">
                        </td>
                    </tr>
                </table>
                <input class="btn-registrar" type="submit" value="FINALIZAR">
                <?php
                    $vistaUsuario -> finalizarServicioModalController();//AGREGAMOS LA VARIABLE DE FINALIZAR SERVICIO.
                ?>
                </form>
	        </div>
        </div>
        <!-- TERMINA EL MODAL PARA FINALIZAR SERVICIO -->

        <!-- MODAL PARA ASIGNAR USUARIO -->

        <div id="openModalAsignar" class="modalDialog">
    	    <div>
            	<a href="#close" title="Close" class="close">X</a>
                <h1>ASIGNAR USUARIO(S)</h1>
                <form method="post">
                <table>
                    <input type="hidden" name="id_partida_os" id="id_partida_os">
                    <input type="hidden" name="id_partida_os_asignar" id="id_partida_os_asignar">
                    <tr>
                        <td class="titulo"><p class="derecha">Asignar a : </p></td>
                        <td>
                            <select name="usuariosAsignar" id="usuariosAsignar">                   
                            </select>
                        </td>
                        <td>
                            <input class="btn-agregar-serv" type="button" value="Añadir" name="agregar-user" id="agregar-user-asignar">
                        </td>
                    </tr>
                </table>
                <table class="listado-previo" id="tabla-user-pre-asignar">
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
                <?php
                    $vistaUsuario -> asignarUsuariosServicioListadoController();
                ?>
	        </div>
        </div>
    </form>
</div>