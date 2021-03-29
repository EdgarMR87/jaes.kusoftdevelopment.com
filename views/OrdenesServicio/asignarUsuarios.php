<script>

$(document).ready(function(){
    //DETECTAMOS CUANDO SE SELECCIONA UNA UNIDAD DEL SELECT Y AGREGAMOS LA OS AL INPUT 
	$('#num_orden_asignar').change(function(){
        var num_orden = $('#num_orden_asignar').val();
		var estado_partida_os = "ENPROCESO";
        var orden_servicio = $(this).find("option:selected").attr('data-os');
		$("#observaciones_os_f").val('');
		$("#comentarios_os_f").val('');
        $("#id_partida_os_asignar").html();
        $('#orden_servicio').val(orden_servicio);
        $.ajax({
            type:'POST',
            url:  '/views/modules/OrdenesServicio/obtenerServiciosOS',
            data: {'num_orden' : num_orden, 'estado_partida_os' : estado_partida_os}, 
            dataType: "html",     
            success: function(resp){      
                $("#id_partida_os_asignar").html(resp);            
            }
        });
	    return false;   
    });

    //DETECTA CUANDO SELECCIONAMOS EL SERVICIO DEL SELECT Y AGREGAMOS LOS COMENTARIOS DE LA OS Y LAS OBSERVACIONES INICIALES
    $('#id_partida_os_asignar').change(function(){
		$('#observaciones_os_f').val();
		$('#comentarios_os_f').val();
		var observaciones = $(this).find("option:selected").attr('data-observaciones');
		var comentarios = $(this).find("option:selected").attr('data-comentarios');
		$('#observaciones_os_f').val(observaciones);
		$('#comentarios_os_f').val(comentarios);
	});

     //EVENTO DEL BOTON AGREGAR USUARIO A LA TABLA
     $("#agregar-user").click(function(){
        var id_usuario = $("#usuarios").val();
        var nombre_usuario = $("#usuarios option:selected").text();
        var htmlTags = '<tr>'+
                        '<td>' + id_usuario  + '<input type="hidden" name="usuariosAsignados[]" value="' + id_usuario + '"></td>'+
                        '<td>' + nombre_usuario +'</td>'+
                        '<td><a herf="#" class="borrar"><img src="/views/img/eliminar.png" class="img25"></img></a></td>'+
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


<?php
    echo "<script> window.document.title = 'Asignar Usuario'</script>"; // TITULO DE LA VENTANA
    $vistaUsuario = new MvcController();
    $fila = $vistaUsuario -> obtenerPartidaOSFinalizarController();
    $vistaUsuario -> finalizarServicioController();            
?>

<div class="tablas-listado" id="contenido">
    <h1>ASIGNAR USUARIOS A SERVICIO</h1>
    <form method="post" class="form-alta-serv">
        <table class="tabla-alta-serv">
            <tr>
                <td class="titulo">
                    <p class="derecha">Unidad de Servicio : </p>
                </td>
                <td class=input>
                    <select name="num_orden_asignar" id="num_orden_asignar">
                        <?php
                            $vistaUsuario = new MvcController();
                            $vistaUsuario -> obtenerOSEnProcesoController();
                        ?>
                    </select>
                </td>
                <td class="titulo">
                    <p class="derecha">Orden de Servicio : </p>
                </td>
                <td class="input">
                    <input id="orden_servicio" type="text" name="orden_servicio" disabled>
                </td>
            </tr>
            <tr>
                <td class="titulo">
                    <p class="derecha">Codigo Servicio : </p>
                </td>
                <td class=input>
                    <select name="id_partida_os_asignar" id="id_partida_os_asignar" required>
                    </select>
                </td>
                <td class="titulo">
                    <p class="derecha">Observaciones Iniciales: </p>
                </td>
                <td class="input">
                    <input id="observaciones_os_f" type="text" name="observaciones_os" disabled>
                </td>
            </tr>
            <tr>
                <td class="titulo">
                    <p class="derecha">Comentarios : </p>
                </td>
                <td class="input">
                    <input id="comentarios_os_f" type="text" name="comentarios_os" disabled>
                </td>
                <td class="titulo">
                    <p class="derecha">Asignar a : </p>
                </td>
                <td class="input">
                    <select name="usuarios" id="usuarios">
                        <?php
                            $vistaUsuario = new MvcController();
                            $vistaUsuario -> obtenerTrabajadorController();   
                        ?>
                    </select>
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
<?php
    $vistaUsuario -> asignarUsuariosServicioController();  
?> 