<script>
$(document).ready(function(){
	//AL SELECCIONAR EL OPTION DE LA UNIDA AGREGUE LOS VALORES DE ORDEN DE SERVICIO
    $('#num_orden').change(function(){
        var num_orden = $('#num_orden').val();
		var estado_partida_os = "PENDIENTE";
        var orden_servicio = $(this).find("option:selected").attr('data-os');
		$("#observaciones_os").val('');
		$("#comentarios_os").val('');
        $("#id_partida_os").html();
        $('#orden_servicio').val(orden_servicio);
        $("#orden_servicio_a").val(num_orden); 
        $.ajax({
            type:'POST',
            url:  '/views/modules/OrdenesServicio/obtenerServiciosOS',
            data: {'num_orden' : num_orden, 'estado_partida_os' : estado_partida_os}, 
            dataType: "html",     
            success: function(resp){      
                $("#id_partida_os").html(resp);                
            }
        });
	    return false;   
    });
    //AL SELECCIONAR EL OPTION DE LA PARTIDA DE SERVICIO SE AGREGUE LOS VALORES DE OBSERVACIONES
    $('#id_partida_os').change(function(){
		$('#observaciones_os').val();
		$('#comentarios_os').val();
		var observaciones = $(this).find("option:selected").attr('data-observaciones');
		var comentarios = $(this).find("option:selected").attr('data-comentarios');
		$('#observaciones_os').val(observaciones);
		$('#comentarios_os').val(comentarios);
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
    echo "<script> window.document.title = 'INICIAR SERVICIO'</script>"; //TITULO DE LA VENTANA
    $vistaUsuario = new MvcController();
    $fila = $vistaUsuario -> obtenerPartidaOSController();          
?>

<div class="tablas-listado" id="contenido">
    <h1>INICIAR SERVICIO</h1>
    <form method="post" class="form-alta-serv">
        <table class="tabla-alta-serv"> 
            <tr>
                <td class="titulo"><p class="derecha">Unidad de Servicio : </p></td>
                <td class=input>
                    <select name="num_orden" id="num_orden" required>
                        <?php 
                            $vistaUsuario = new MvcController();
                            $vistaUsuario -> obtenerOSPendientesController();
                        ?>
                    </select>
                </td>
                <td class="titulo">
                    <p class="derecha">Orden de Servicio : </p>
                </td>
                <td class="input">
                    <input id="orden_servicio" type="text" name="orden_servicio" disabled>
                    <input type="hidden" name="orden_servicio_a" id="orden_servicio_a">
                </td>
            </tr>
            <tr>
                <td class="titulo">
                    <p class="derecha">Codigo Servicio : </p>
                </td>
                <td class=input>
                    <select name="id_partida_os" id="id_partida_os" required>
                    </select>
                </td>
                <td class="titulo">
                    <p class="derecha">Observaciones : </p>
                </td>
                <td class="input">
                    <input id="observaciones_os" type="text" name="observaciones_os" value="<?php echo $fila['observaciones_os'] ?>" disabled>
                </td>
            </tr>
            <tr>
                <td class="titulo">
                    <p class="derecha">Comentarios : </p>
                </td>
                <td class="input">
                    <input id="comentarios_os" type="text" name="comentarios_os" value="<?php echo $fila['comentarios_os'] ?>">
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
        <input class="btn-registrar" type="submit" value="INICIAR"> 
    </form>
</div>
<?php
    $vistaUsuario -> iniciarServicioController();  
?> 