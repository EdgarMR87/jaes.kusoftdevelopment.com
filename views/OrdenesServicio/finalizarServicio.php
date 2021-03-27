<script>

$(document).ready(function(){

    //DETECTAMOS CUANDO SE SELECCIONA UNA UNIDAD DEL SELECT Y AGREGAMOS LA OS AL INPUT 
	$('#num_orden_finalizar').change(function(){
        var num_orden = $('#num_orden_finalizar').val();
		var estado_partida_os = "ENPROCESO";
        var orden_servicio = $(this).find("option:selected").attr('data-os');
		$("#observaciones_os_f").val('');
		$("#comentarios_os_f").val('');
        $("#id_partida_os_f").html();
        $('#orden_servicio').val(orden_servicio);
        $.ajax({
            type:'POST',
            url:  '/views/modules/OrdenesServicio/obtenerServiciosOS',
            data: {'num_orden' : num_orden, 'estado_partida_os' : estado_partida_os}, 
            dataType: "html",     
            success: function(resp){      
                $("#id_partida_os_f").html(resp);            
            }
        });
	    return false;   
    });

    //DETECTA CUANDO SELECCIONAMOS EL SERVICIO DEL SELECT Y AGREGAMOS LOS COMENTARIOS DE LA OS Y LAS OBSERVACIONES INICIALES
    $('#id_partida_os_f').change(function(){
		$('#observaciones_os_f').val();
		$('#comentarios_os_f').val();
		var observaciones = $(this).find("option:selected").attr('data-observaciones');
		var comentarios = $(this).find("option:selected").attr('data-comentarios');
		$('#observaciones_os_f').val(observaciones);
		$('#comentarios_os_f').val(comentarios);
	});

});

</script>

<?php
    echo "<script> window.document.title = 'FINALIZAR SERVICIO'</script>"; // TITULO DE LA VENTANA
    $vistaUsuario = new MvcController();
    $fila = $vistaUsuario -> obtenerPartidaOSFinalizarController();
    $vistaUsuario -> finalizarServicioController();            
?>

<div class="tablas-listado" id="contenido">
    <h1>FINALIZAR SERVICIO</h1>
    <form method="post" class="form-alta-serv">
        <table class="tabla-alta-serv"> 
            <tr>
                <td class="titulo">
                    <p class="derecha">Unidad de Servicio : </p>
                </td>
                <td class=input>
                    <select name="num_orden_finalizar" id="num_orden_finalizar">
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
                </td>
            </tr>
            <tr>
                <td class="titulo">
                    <p class="derecha">Codigo Servicio : </p>
                </td>
                <td class=input>
                    <select name="id_partida_os_f" id="id_partida_os_f" required>
                    </select>
                </td>
                <td class="titulo">
                    <p class="derecha">Observaciones Finales: </p>
                </td>
                <td class="input">
                    <input id="observacion_final_os_f" type="text" name="observacion_final_os_f">
                </td>
            </tr>
            <tr>
                <td class="titulo">
                    <p class="derecha">Observaciones Iniciales: </p>
                </td>
                <td class="input">
                    <input id="observaciones_os_f" type="text" name="observaciones_os" disabled>
                </td>
                <td class="titulo">
                    <p class="derecha">Comentarios : </p>
                </td>
                <td class="input">
                    <input id="comentarios_os_f" type="text" name="comentarios_os" disabled>
                </td>
            </tr>
        </table> 
        <input class="btn-registrar" type="submit" value="FINALIZAR">           
    </form>
</div>