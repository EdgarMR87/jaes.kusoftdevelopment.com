<script>

function actualizarFilas(){
        var nFilas = $("#tabla-servicios-pre tr").length;
        var table = document.getElementById("tabla-servicios-pre");
        let valor =1;
        for(i=0; i<= nFilas ; i++){
            $("#tabla-servicios-pre tr:eq("+i+")").find("td:eq(0)").text(i);

        }

    }

//EVENTO DEL BOTON AGREGAR PARTIDA 
$(document).ready(function(){
$("#agregar-serv").click(function(){
    var nFilas = $("#tabla-servicios-pre tr").length;
    var htmlTags = '<tr><input type="hidden" name="consecutivos[]" value="' + nFilas + '">'+
        '<td>' + nFilas + '</td>'+
        '<td>' + $("#codigo_atr_serv").val() + '<input type="hidden" name="partidas[]" value="'+$("#codigo_atr_serv").val()+'"> </td>'+
        '<td>' + $("#codigo_atr_serv option:selected").attr('data-name') + '</td><td></td>'+
        '<td>' + $("#observaciones-serv").val() + '<input type="hidden" name="observacionesPartidas[]" value="'+$("#observaciones-serv").val()+'"></td>'+
        '<td></td><td></td><td></td><td></td><td></td>' +
        '<td><a class="borrar"><img src="/views/img/eliminar.png" class="img-25"></img></a></td>'+
       '</tr>';
   $('#tabla-servicios-pre tbody').append(htmlTags);
   $("#observaciones-serv").val('');
   $("#codigo_atr_serv").focus();
   actualizarFilas(); //REORDENAMOS LOS NUMEROS DE CONSECUTIVO
});
//EVENTO DEL BOTON ELIMINAR FILA
$(document).on('click', '.borrar', function (event) {
    var id = $(this).attr('id');
    if(id > 0){
        $.ajax({
            type:'POST',
            url:  '/views/modules/OrdenesServicio/eliminarPartidaOS',
            data: {'id_partida_os': id}, 
            dataType: "html",     
            success: function(resp){
                if(resp == "success"){
                    borrarpartidaOk();
                }
            }
        });
	    return false;  
    }
    event.preventDefault();
    $(this).closest('tr').remove(); //ELIMINAS FILA
    actualizarFilas(); //REORDENAMOS LOS NUMEROS DE CONSECUTIVO
});

});

</script>

<?PHP
    echo "<script> window.document.title = 'EDITAR ORDEN SERVICIO'</script>";
?>
<div class="tablas-listado" id="contenido">
    <h1>ORDEN DE SERVICIO : <?php echO $_GET['num_orden_detalle']; ?></h1>
    <form method="post" class="form-alta-serv">
        <table class="tabla-alta-serv">
            <?php 
    		    $vistaUsuario = new MvcController();
    		    $datos_OS = $vistaUsuario -> editarOSAtrController();
                $fecha = date_create($datos_OS['fecha_orden']);
                $fecha_formato =date_format($fecha, "Y-m-d h:i:s");
		    ?>
            <tr>
                <td class="titulo"><p class="derecha">Orden de Servicio : </p></td>
                <td class=input>
                    <input type="number" value="<?php echo $datos_OS['num_orden']; ?>" name="num_orden_e" readonly>
                </td>
                <td class="titulo"><p class="derecha">Unidad : </p></td>
                <td class=input>
                    <select name="id_unidad_servicio" id="id_unidad_servicio" required>
                        <?php 
                        $vistaUsuario -> vistaUnidadesSelectedController($datos_OS['id_unidad_servicio']);
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="titulo"><p class="derecha">Operador : </p></td>
                <td class=input>
                    <input type="text" value="<?php echo $datos_OS['operador']; ?>" name="operador" required>
                </td>
                <td class="titulo"><p class="derecha">Capturo : </p></td>
                <td class=input>
                    <select name="captura" id="captura">
                        <?php 
                        switch($datos_OS['captura']){
                            case "ARMAC":
                                echo "  <option value='ERICK'>ERICK</option>
                                        <option value='ARMAC' SELECTED>ARMAC</option>    
                                        <option value='JAIR'>JAIR</option>";
                            break;
                            case "ERICK":
                                echo "  <option value='ERICK' SELECTED>ERICK</option>
                                        <option value='ARMAC'>ARMAC</option>    
                                        <option value='JAIR'>JAIR</option>";
                            break;
                            case "JAIR":
                                echo "  <option value='ERICK'>ERICK</option>
                                        <option value='ARMAC'>ARMAC</option>    
                                        <option value='JAIR' SELECTED>JAIR</option>";
                            break;
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr> 
                <td class="titulo"><p class="derecha">Fecha Orden : </p></td>
                <td class=input>
                    <input type="datetime" value="<?php echo $fecha_formato; ?>" name="fecha_orden">
                </td>
                <td class="titulo"><p class="derecha">Kilometraje : </p></td>
                <td class=input>
                    <input type="number" value="<?php echo $datos_OS['kilometraje']; ?>" name="kilometraje" required>
                </td>
            </tr>
            <tr>
                <td class="titulo"><p class="derecha">Servicio : </p></td>
                <td class=input>
                      <?php 
                       $array_serv = $vistaUsuario -> obtenerServiciosOSController();
                       $array_tipo_serv = $vistaUsuario -> obtenerTipoServOSController();
                        ?>
                    <select name="servicio" id="servicio" >
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
                    <select name="tipo_servicio" id="tipo_servicio">
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
            <tr>
                <td class="titulo"><p class="derecha">Observaciones Generales : </p></td>
                <td class="input" colspan="3">
                    <textarea class="mayusculas" name="observaciones_os" id="observaciones_os" cols="30" rows="5">
                        <?php echo $datos_OS['observaciones_os']; ?>
                    </textarea>
                </td>
            </tr>
    </table>

    <table class="tabla-alta-serv">
        <tr>
            <td class="titulo"><p class="derecha">Codigo Servicio : </p></td>
            <td>
                <select name="codigo_atr_serv" id="codigo_atr_serv">
                    <?php
                        $vistaUsuario = new MvcController();
                        $vistaUsuario -> vistaServiciosAtrSelectController();
                    ?>
                </select>
               
            </td>
            <td class="titulo"><p class="derecha">Comentarios : </p></td>
            <td>
                <input type="text" name="observaciones" id="observaciones-serv">
            </td>
            <td>
                <input class="btn-agregar-serv" type="button" value="Añadir" name="agregar-serv" id="agregar-serv">
            </td>
        </tr>
    </table>



    <table class="listado-previo" id="tabla-servicios-pre">
        <thead>
            <th class="listado-th">Consec.</th>
            <th class="listado-th">Codigo</th>
            <th class="listado-th">Descripción</th>
            <th class="listado-th">Comentarios</th>
            <th class="listado-th">Observaciones</th>
            <th class="listado-th">Fecha Creación</th>
            <th class="listado-th">Fecha Inicio</th>
            <th class="listado-th">Fecha Termino </th>
            <th class="listado-th">Estado</th>
            <th class="listado-th">Asignado a</th>
            <th class="listado-th">Eliminar</th>
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
                        utf8_encode($campo['descripcion_serv'])
                    ."</td>
                   <td>".
                        $campo['comentarios_os']
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
                    ."</td>
                    <td><a href='index.php?action=OrdenesServicio/usuariosAsignados&id_partida_os=".$campo['id_partida_os']."&OS=".$campo['num_orden_partida_os']."'>".
                    👥
                   ."</a></td>
                   <td>
                        <a class='borrar' id='".$campo['id_partida_os']."' click='return(this);' >
                            <img src='/views/img/eliminar.png' class='img-25'></img>
                        </a>
                    </td>
                </tr>";
            }
		?>
        </tbody>
    </table>
    <input class="btn-actualizar" type="submit" value="Actualizar">
</form>

<?php 
 $vistaUsuario -> actualizarOSAtrController();
?>