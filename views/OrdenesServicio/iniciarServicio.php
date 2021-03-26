<script>
$(document).ready(function(){
	$('#num_orden').change(function(){
        var num_orden = $('#num_orden').val();
		var estado_partida_os = "PENDIENTE";
        var orden_servicio = $(this).find("option:selected").attr('data-os');
		$("#observaciones_os").val('');
		$("#comentarios_os").val('');
        $("#id_partida_os").html();
        $('#orden_servicio').val(orden_servicio);
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

    $('#id_partida_os').change(function(){
		$('#observaciones_os').val();
		$('#comentarios_os').val();
		var observaciones = $(this).find("option:selected").attr('data-observaciones');
		var comentarios = $(this).find("option:selected").attr('data-comentarios');
		$('#observaciones_os').val(observaciones);
		$('#comentarios_os').val(comentarios);
	});
});
</script>


<?php
    echo "<script> window.document.title = 'INICIAR SERVICIO'</script>";
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
                <td class="titulo"><p class="derecha">Orden de Servicio : </p></td>
                <td class="input"><input id="orden_servicio" type="text" name="orden_servicio" value="<?php echo $fila['comentarios_os'] ?>" disabled></td>
            </tr>
            <tr>
                <td class="titulo"><p class="derecha">Codigo Servicio : </p></td>
                <td class=input>
                    <select name="id_partida_os" id="id_partida_os" required></select>
                </td>
                <td class="titulo"><p class="derecha">Asignar a : </p></td>
                <td class="input">
                    <select name="usuarios" id="usuarios">
                        <?php
                            $vistaUsuario = new MvcController();
                            $vistaUsuario -> obtenerTrabajadorController();   
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="titulo"><p class="derecha">Observaciones : </p></td>
                <td class="input"><input id="observaciones_os" type="text" name="observaciones_os" value="<?php echo $fila['observaciones_os'] ?>" disabled></td>
                <td class="titulo"><p class="derecha">Comentarios : </p></td>
                <td class="input"><input id="comentarios_os" type="text" name="comentarios_os" value="<?php echo $fila['comentarios_os'] ?>"></td>
            </tr>
            <input class="btn-registrar" type="submit" value="INICIAR"> 
        </table>           
    </form>
   <?php
    $vistaUsuario -> iniciarServicioController();  
   ?>
       
</div>