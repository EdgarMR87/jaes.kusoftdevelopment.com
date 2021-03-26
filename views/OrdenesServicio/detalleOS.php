<?PHP
    echo "<script> window.document.title = 'DETALLE ORDEN SERVICIO'</script>";
?>
<div class="tablas-listado" id="contenido">
    <h1>ORDEN DE SERVICIO : <?php echO $_GET['num_orden_detalle']; ?></h1>
    <form method="post" class="form-alta-serv">
        <table class="tabla-alta-serv">
            <?php 
    		    $vistaUsuario = new MvcController();
    		    $datos_OS = $vistaUsuario -> editarOSAtrController();
		    ?>
            <tr>
                <td class="titulo"><p class="derecha">Orden de Servicio : </p></td>
                <td class=input>
                    <input type="number" value="<?php echo $datos_OS['num_orden']; ?>" name="num_orden" required>
                </td>
                <td class="titulo"><p class="derecha">Unidad : </p></td>
                <td class=input>
                    <select name="id_unidad_servicio" id="id_unidad_servicio">
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
                    <input type="text" value="<?php echo $datos_OS['captura']; ?>" name="captura" required>
                </td>
            </tr>
            <tr> 
                <td class="titulo"><p class="derecha">Fecha Orden : </p></td>
                <td class=input>
                    <input type="text" value="<?php echo $datos_OS['fecha_orden']; ?>" name="fecha_orden" disabled>
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
    </table>
    <table class="listado-previo" id="tabla-servicios-pre">
        <thead>
            <th class="listado-th">Consec.</th>
            <th class="listado-th">Codigo</th>
            <th class="listado-th">Comentarios</th>
            <th class="listado-th">Observaciones</th>
            <th class="listado-th">Fecha Creación</th>
            <th class="listado-th">Fecha Inicio</th>
            <th class="listado-th">Fecha Termino </th>
            <th class="listado-th">Estado</th>
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
                </tr>";
            }
		?>
        </tbody>
    </table>
    <input class="btn-actualizar" type="submit" value="Actualizar">
</form>