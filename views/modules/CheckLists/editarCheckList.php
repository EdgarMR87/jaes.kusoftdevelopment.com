<script>
    $(document).on('click', '.malos', function(evetn){
        $(this).closest('tr').find('td:nth-child(4)').css("display","block");
    });
    $(document).on('click', '.buenos', function(evetn){
        $(this).closest('tr').find('td:nth-child(4)').css("display","none");
        var id = $(this).closest('tr').find('input.observacion').val('');
    });

    $(document).ready(function(){
        $('.malos:checked').each(
        function() {
            $(this).closest('tr').find('td:nth-child(4)').css("display","block");
            
    }
);
    });
</script>

<div class="tablas-listado" id="contenido">
    <h1>EDITAR CHECKLIST MAZDA UNIDAD : <?php echo $_GET["id_checklist_editar"];?> </h1>

    <form method="post" class="form-alta-serv">
        <table class="tabla-alta-serv">
                <tr>
                <input type="hidden" name="id_checklist_editar" value="<?php echo $_GET["id_checklist_editar"];?>">
                    <td class="titulo"><p class="derecha">Fecha : </p></td>
                    <td class=input>
                        <?php
                            $vistaUsuario = new MvcController();
    		                $datos_checklist = $vistaUsuario -> editarChecklistController();
                            $fecha = date_create($datos_checklist['fecha_checklist']);
                            $fecha_formato =date_format($fecha, "Y-m-d H:i:s");
                         ?>
                        <input type="datetime-local" value="<?php echo $fecha_formato;?>" name="fecha_checklist">
                    </td>
                    <td class="titulo"><p class="derecha">Realizado Por : </p></td>
                    <td class=input>
                        <input type="text" name="usuario" value="<?php echo $datos_checklist['nombreCompleto']; ?>" readonly>
                        <input type="hidden" name="id_usuario" value="<?php echo $datos_checklist["id_usuario_realiza"]; ?>">
                    </td>
                </tr>
                <tr>
                    <td class="titulo"><p class="derecha">Kilometraje : </p></td>
                    <td class=input>
                        <input type="number" value="<?php echo $datos_checklist["kilometraje"]; ?>" name="kilometraje_checklist" required>
                    </td>
                    <td class="titulo"><p class="derecha">Unidad Mazda : </p></td>
                    <td class=input>
                        <select name="unidad_checklist" id="unidad_checklist" required> 
                            <?php 
                              $vistaUsuario->vistaUnidadesMazdaSelectedController($datos_checklist["unidad_mazda"]);
                            ?>
                        </select>
                    </td>
                </tr>
                <tr> 
                    <td class="titulo"><p class="derecha">Observaciones Finales : </p></td>
                    <td class=input colspan="3">
                        <input type="text" class="width-100" value="<?php echo $datos_checklist["observaciones"]; ?>" name="observaciones_checklist">
                    </td>
                </tr>
        </table>
        <div class="panel-checklist">
        <div>
            <table class="listado-previo" id="tabla-servicios-pre">
                <thead>
                    <th class="listado-th">Carroceria</th>
                    <th class="listado-th">Bueno</th>
                    <th class="listado-th">Malo</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                        <?php 
                            $vistaUsuario = new MvcController();
                            $datos_partidas_checklist = $vistaUsuario->vistaDetalleChecklistTablaController($_GET["id_checklist_editar"]);
                            foreach($datos_partidas_checklist as $row => $item){
                             
                                switch ($item['parte_revisada']){
                                    case 'CRISTALES':
                                        echo'<tr><td class="num_orden">'.$item["parte_revisada"].'</td>';    
                                    if($item["estado_general"] == "bueno"){
                                            echo '<td><input type="radio" class="buenos" name="cristales_estado" value="bueno" checked></td>
                                                <td><input type="radio" class="malos" name="cristales_estado" value="malo"></td>';
                                        }else{
                                            echo '<td><input type="radio" class="buenos" name="cristales_estado" value="bueno"></td>
                                                <td><input type="radio" class="malos" name="cristales_estado" value="malo" checked></td>';
                                        }
                                        echo '<td class="observaciones"><input class="observacion" type="text" name="cristales_observ" value="'.$item["observaciones_partida"].'"></td>
                                            <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                    break;
                                    case 'ESPEJOS':
                                        echo'<tr>
                                        <td class="num_orden">'.$item["parte_revisada"].'</td>';    
                                    if($item["estado_general"] == "bueno"){
                                            echo '<td>
                                                        <input type="radio" class="buenos" name="espejos_estado" value="bueno" checked>
                                                    </td>
                                                    <td>
                                                        <input type="radio" class="malos" name="espejos_estado" value="malo">
                                                    </td>';
                                        }else{
                                            echo '<td>
                                                        <input type="radio" class="buenos" name="espejos_estado" value="bueno">
                                                    </td>
                                                    <td>
                                                        <input type="radio" class="malos" name="espejos_estado" value="malo" checked>
                                                    </td>';
                                        }
                                        echo '<td class="observaciones"><input class="observacion" type="text" name="espejos_observ" value="'.$item["observaciones_partida"].'"></td>
                                        <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                    break;
                                    case 'PARABRISAS':
                                        echo'<tr>
                                        <td class="num_orden">'.$item["parte_revisada"].'</td>';    
                                    if($item["estado_general"] == "bueno"){
                                            echo '<td>
                                                        <input type="radio" class="buenos" name="parabrisas_estado" value="bueno" checked>
                                                    </td>
                                                    <td>
                                                        <input type="radio" class="malos" name="parabrisas_estado" value="malo">
                                                    </td>';
                                        }else{
                                            echo '<td>
                                                        <input type="radio" class="buenos" name="parabrisas_estado" value="bueno">
                                                    </td>
                                                    <td>
                                                        <input type="radio" class="malos" name="parabrisas_estado" value="malo" checked>
                                                    </td>';
                                        }
                                        echo '<td class="observaciones"><input class="observacion" type="text" name="parabrisas_observ" value="'.$item["observaciones_partida"].'"></td>
                                        <input type="hidden" name="partidas[]"  value="'.$item["id_partida"].'"></tr>';
                                    break;
                                    case 'BATERIAS': 
                                        echo'<tr>
                                        <td class="num_orden">'.$item["parte_revisada"].'</td>';    
                                    if($item["estado_general"] == "bueno"){
                                            echo '<td>
                                                        <input type="radio" class="buenos" name="baterias_estado" value="bueno" checked>
                                                    </td>
                                                    <td>
                                                        <input type="radio" class="malos" name="baterias_estado" value="malo">
                                                    </td>';
                                        }else{
                                            echo '<td>
                                                        <input type="radio" class="buenos" name="baterias_estado" value="bueno">
                                                    </td>
                                                    <td>
                                                        <input type="radio" class="malos" name="baterias_estado" value="malo" checked>
                                                    </td>';
                                        }
                                        echo '
                                        <td class="observaciones"><input class="observacion" type="text" name="baterias_observ" value="'.$item["observaciones_partida"].'"></td>
                                        <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                    break;
                                }
                            }			 
                        ?>
                </tbody>
            </table>
        </div>  

        <div>
            <table class="listado-previo" id="tabla-servicios-pre">
                <thead>
                    <th class="listado-th">Electrico</th>
                    <th class="listado-th">Bueno</th>
                    <th class="listado-th">Malo</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                    <?php
                    foreach($datos_partidas_checklist as $row => $item){
                        switch ($item['parte_revisada']){
                            case 'ENCENDIDO DE LUCES':
                                if($item["estado_general"] == "bueno"){
                                    echo '<tr><td>Encendido de Luces</td>
                                    <td><input type="radio" class="buenos" name="luces_estado" value="bueno" checked></td>
                                    <td><input type="radio" class="malos" name="luces_estado" value="malo"></td>';
                                }else{
                                    echo '<tr><td>Encendido de Luces</td>
                                            <td><input type="radio" class="buenos" name="luces_estado" value="bueno"></td>
                                            <td><input type="radio" class="malos" name="luces_estado" value="malo" checked></td>';
                                }
                                echo '<td class="observaciones"><input class="observacion" type="text" name="luces_observaciones" value="'.$item["observaciones_partida"].'"></td>
                                    <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                break;
                            case 'PLAFONES':
                                if($item["estado_general"] == "bueno"){
                                    echo '<tr><td>Plafones</td>
                                            <td><input type="radio" class="buenos" name="plafones_estado" value="bueno" checked></td>
                                            <td><input type="radio" class="malos" name="plafones_estado" value="malo"></td>';
                                }else{
                                    echo '<tr><td>Plafones</td>
                                        <td><input type="radio" class="buenos" name="plafones_estado" value="bueno"></td>
                                        <td><input type="radio" class="malos" name="plafones_estado" value="malo" checked></td>';
                                }
                                echo '<td class="observaciones"><input class="observacion" type="text" name="plafones_observ" value="'.$item["observaciones_partida"].'"></td>
                                    <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                break;
                            case 'LUZ DE TRABAJO':
                                if($item["estado_general"] == "bueno"){
                                    echo '<tr>
                                    <td>Luz de Trabajo</td>
                                    <td><input type="radio" class="buenos" name="luz_trabajo_estado" value="bueno" checked></td>
                                    <td><input type="radio" class="malos" name="luz_trabajo_estado" value="malo"></td>';
                                }else{
                                    echo '<tr>
                                    <td>Luz de Trabajo</td>
                                    <td><input type="radio" class="buenos" name="luz_trabajo_estado" value="bueno"></td>
                                    <td><input type="radio" class="malos" name="luz_trabajo_estado" value="malo" checked></td>';
                                }
                                echo '<td class="observaciones"><input class="observacion" type="text" name="luz_trabajo_estado_observ" value="'.$item["observaciones_partida"].'"></td>
                                    <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                break;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div>
            <table class="listado-previo" id="tabla-servicios-pre">
                <thead>
                    <th class="listado-th">Niveles</th>
                    <th class="listado-th">SI</th>
                    <th class="listado-th">NO</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                <?php
                    foreach($datos_partidas_checklist as $row => $item){
                        switch ($item['parte_revisada']){
                            case 'NIVEL DE MOTOR':
                                if($item["estado_general"] == "si"){
                                    echo '<tr><td>Motor</td>
                                    <td><input type="radio" class="buenos" name="motor_estado" value="si" checked></td>
                                    <td><input type="radio" class="malos" name="motor_estado" value="no"></td>';
                                }else{
                                    echo '<tr><td>Motor</td>
                                    <td><input type="radio" class="buenos" name="motor_estado" value="si"></td>
                                    <td><input type="radio" class="malos" name="motor_estado" value="no" checked></td>';
                                }
                                echo '<td class="observaciones"><input class="observacion" type="text" name="motor_observ" value="'.$item["observaciones_partida"].'"></td>
                                    <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                break;
                            case 'NIVEL DE ANTICONGELANTE':
                                if($item["estado_general"] == "si"){
                                    echo '<tr><td>Anticongelante</td>
                                    <td><input type="radio" class="buenos" name="anticongelante_estado" value="si" checked></td>
                                    <td><input type="radio" class="malos" name="anticongelante_estado" value="no"></td>';
                                }else{
                                    echo '<tr><td>Anticongelante</td>
                                    <td><input type="radio" class="buenos" name="anticongelante_estado" value="si"></td>
                                    <td><input type="radio" class="malos" name="anticongelante_estado" value="no" checked></td>';
                                }
                                echo '<td class="observaciones"><input class="observacion" type="text" name="anticongelante_observ" value="'.$item["observaciones_partida"].'"></td>
                                    <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                break;
                            case 'NIVEL DE DIRECCION HD':
                                if($item["estado_general"] == "si"){
                                    echo '<tr><td>Direccion HD</td>
                                    <td><input type="radio" class="buenos" name="direccion_estado" value="si" checked></td>
                                    <td><input type="radio" class="malos" name="direccion_estado" value="no"></td>';
                                }else{
                                    echo '<tr><td>Direccion HD</td>
                                    <td><input type="radio" class="buenos" name="direccion_estado" value="si"></td>
                                    <td><input type="radio" class="malos" name="direccion_estado" value="no" checked></td>';
                                }
                                echo '<td class="observaciones"><input class="observacion" type="text" name="direccion_observ" value="'.$item["observaciones_partida"].'"></td>
                                    <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                break;
                            case 'CLUTCH':
                                if($item["estado_general"] == "si"){
                                    echo '<tr><td>Clutch</td>
                                    <td><input type="radio" class="buenos" name="clutch_estado" value="si" checked></td>
                                    <td><input type="radio" class="malos" name="clutch_estado" value="no"></td>';
                                }else{
                                    echo '<tr><td>Clutch</td>
                                    <td><input type="radio" class="buenos" name="clutch_estado" value="si"></td>
                                    <td><input type="radio" class="malos" name="clutch_estado" value="no" checked></td>';
                                    }
                                    echo '<td class="observaciones"><input class="observacion" type="text" name="clutch_observ" value="'.$item["observaciones_partida"].'"></td>
                                        <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                break;
                        }
                    }
                    ?>          
                </tbody>
            </table>
        </div>
         <!-- INICIA TERCE PARTE -->
         <div>
            <table class="listado-previo" id="tabla-servicios-pre">
                <thead>
                    <th class="listado-th"></th>
                    <th class="listado-th">Bueno</th>
                    <th class="listado-th">Malo</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                <?php
                    foreach($datos_partidas_checklist as $row => $item){
                        switch ($item['parte_revisada']){
                            case 'ADMISION':
                                if($item["estado_general"] == "bueno"){
                                    echo '<tr><td>Admision</td>
                                    <td><input type="radio" class="buenos" name="admision_estado" value="bueno" checked></td>
                                    <td><input type="radio" class="malos" name="admision_estado" value="malo"></td>';
                                }else{
                                    echo '<tr><td>Admision</td>
                                    <td><input type="radio" class="buenos" name="admision_estado" value="bueno"></td>
                                    <td><input type="radio" class="malos" name="admision_estado" value="malo" checked></td>';
                                }
                                echo '<td class="observaciones"><input class="observacion" type="text" name="admision_observ" value="'.$item["observaciones_partida"].'"></td>
                                    <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                break;
                            case 'BANDAS':
                                if($item["estado_general"] == "bueno"){
                                    echo ' <tr><td>Bandas</td>
                                    <td><input type="radio" class="buenos" name="bandas_estado" value="bueno" checked></td>
                                    <td><input type="radio" class="malos" name="bandas_estado" value="malo"></td>';
                                }else{
                                    echo '<tr><td>Bandas</td>
                                    <td><input type="radio" class="buenos" name="bandas_estado" value="bueno"></td>
                                    <td><input type="radio" class="malos" name="bandas_estado" value="malo" checked></td>';
                                }
                                echo '<td class="observaciones"><input class="observacion" type="text" name="bandas_observ" value="'.$item["observaciones_partida"].'"></td>
                                    <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                break;
                        }
                    }
                    ?>     
                </tbody>
            </table>
        </div>  
        <!-- INICIA TERCE PARTE -->
        <div>
            <table class="listado-previo" id="tabla-servicios-pre">
                <thead>
                    <th class="listado-th">Fugas de Aceite</th>
                    <th class="listado-th">NO</th>
                    <th class="listado-th">SI</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                <?php
                    foreach($datos_partidas_checklist as $row => $item){
                        switch ($item['parte_revisada']){
                            case 'FUGA ACEITE MOTOR':
                                if($item["estado_general"] == "no"){
                                    echo '<tr><td>Motor</td>
                                    <td><input type="radio" class="buenos" name="f_motor_estado" value="no" checked></td>
                                    <td><input type="radio" class="malos" name="f_motor_estado" value="si"></td>';
                                }else{
                                    echo '<tr><td>Motor</td>
                                    <td><input type="radio" class="buenos" name="f_motor_estado" value="no"></td>
                                    <td><input type="radio" class="malos" name="f_motor_estado" value="si" checked></td>';
                                }
                                echo '<td class="observaciones"><input class="observacion" type="text" name="f_motor_observ" value="'.$item["observaciones_partida"].'"></td>
                                    <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                break;
                            case 'FUGA ACEITE TRANSMISION':
                                if($item["estado_general"] == "no"){
                                    echo '<tr><td>Transmisión</td>
                                    <td><input type="radio" class="buenos" name="transmision_estado" value="no" checked></td>
                                    <td><input type="radio" class="malos" name="transmision_estado" value="si"></td>';
                                }else{
                                    echo '<tr><td>Transmisión</td>
                                    <td><input type="radio" class="buenos" name="transmision_estado" value="no"></td>
                                    <td><input type="radio" class="malos" name="transmision_estado" value="si" checked></td>';
                                }
                                echo '<td class="observaciones"><input class="observacion" type="text" name="transmision_observ" value="'.$item["observaciones_partida"].'"></td>
                                    <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                break;
                            case 'FUGA ACEITE DIFERENCIAL':
                                if($item["estado_general"] == "no"){
                                    echo '<tr><td>Diferencial</td>
                                    <td><input type="radio" class="buenos" name="diferencial_estado" value="no" checked></td>
                                    <td><input type="radio" class="malos" name="diferencial_estado" value="si"></td>';
                                }else{
                                    echo '<tr><td>Diferencial</td>
                                    <td><input type="radio" class="buenos" name="diferencial_estado" value="no"></td>
                                    <td><input type="radio" class="malos" name="diferencial_estado" value="si" checked></td>';
                                }
                                echo '<td class="observaciones"><input class="observacion" type="text" name="diferencial_observ" value="'.$item["observaciones_partida"].'"></td>
                                    <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                break;
                        }
                    }
                    ?>                       
                </tbody>
            </table>
        </div>
         <!-- INICIA TERCE PARTE -->
         <div>
            <table class="listado-previo" id="tabla-servicios-pre">
                <thead>
                    <th class="listado-th">Revisión de Pasa Muros</th>
                    <th class="listado-th">BUENO</th>
                    <th class="listado-th">MAL</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                <?php
                    foreach($datos_partidas_checklist as $row => $item){
                        switch ($item['parte_revisada']){
                            case 'PASAMUROS ELECTRICO':
                                if($item["estado_general"] == "bueno"){
                                    echo '<tr><td>Eléctrico</td>
                                    <td><input type="radio" class="buenos" name="r_pasamuros_electrico_estado" value="bueno" checked></td>
                                    <td><input type="radio" class="malos" name="r_pasamuros_electrico_estado" value="malo"></td>';
                                }else{
                                    echo '<tr><td>Eléctrico</td>
                                    <td><input type="radio" class="buenos" name="r_pasamuros_electrico_estado" value="bueno"></td>
                                    <td><input type="radio" class="malos" name="r_pasamuros_electrico_estado" value="malo" checked></td>';
                                }
                                echo '<td class="observaciones"><input class="observacion" type="text" name="r_pasamuros_electrico_obser" value="'.$item["observaciones_partida"].'"></td>
                                    <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                break;
                            case 'PASAMUROS HIDRAULICO':
                                if($item["estado_general"] == "bueno"){
                                    echo '<tr><td>Hidráulico</td>
                                    <td><input type="radio" class="buenos" name="r_pasamuros_hidraulico_estado" value="bueno" checked></td>
                                    <td><input type="radio" class="malos" name="r_pasamuros_hidraulico_estado" value="malo"></td>';
                                }else{
                                    echo '<tr><td>Hidráulico</td>
                                    <td><input type="radio" class="buenos" name="r_pasamuros_hidraulico_estado" value="bueno"></td>
                                    <td><input type="radio" class="malos" name="r_pasamuros_hidraulico_estado" value="malo" checked></td>';
                                }
                                echo '<td class="observaciones"><input class="observacion" type="text" name="r_pasamuros_hidraulico_observ" value="'.$item["observaciones_partida"].'"></td>
                                    <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                break;
                            case 'PASAMUROS NEUMATICO':
                                if($item["estado_general"] == "bueno"){
                                    echo '<tr><td>Neumático</td>
                                    <td><input type="radio" class="buenos" name="r_pasamuros_neumatico_estado" value="bueno" checked></td>
                                    <td><input type="radio" class="malos" name="r_pasamuros_neumatico_estado" value="malo"></td>';
                                }else{
                                    echo '<tr><td>Neumático</td>
                                    <td><input type="radio" class="buenos" name="r_pasamuros_neumatico_estado" value="bueno"></td>
                                    <td><input type="radio" class="malos" name="r_pasamuros_neumatico_estado" value="malo" checked></td>';
                                }
                                echo '<td class="observaciones"><input class="observacion" type="text" name="r_pasamuros_neumatico_observ" value="'.$item["observaciones_partida"].'"></td>
                                    <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                break;
                        }
                    }
                    ?> 
                </tbody>
            </table>
        </div>
         <!-- INICIA TERCE PARTE -->
         <div>
            <table class="listado-previo" id="tabla-servicios-pre">
                <thead>
                    <th class="listado-th">TAPAS</th>
                    <th class="listado-th">SI</th>
                    <th class="listado-th">NO</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                <?php
                    foreach($datos_partidas_checklist as $row => $item){
                        for ($i=1; $i <= 9 ; $i+=2) {
                            switch ($item['parte_revisada']){
                                case ('TAPAS'.$i):
                                    if($item["estado_general"] == "si"){
                                        echo '<tr>
                                        <td>'.$i.'</td>
                                        <td><input type="radio" class="buenos" name="t'.$i.'_estado" value="si" checked></td>
                                        <td><input type="radio" class="malos" name="t'.$i.'_estado" value="no"></td>';
                                    }else{
                                        echo '<tr>
                                        <td>'.$i.'</td>
                                        <td><input type="radio" class="buenos" name="t'.$i.'_estado" value="si"></td>
                                        <td><input type="radio" class="malos" name="t'.$i.'_estado" value="no" checked></td>';
                                    }
                                    echo '<td class="observaciones"><input class="observacion" type="text" name="t'.$i.'_observ" value="'.$item["observaciones_partida"].'"></td>
                                        <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                    break;
                            }
                        }                        
                    }
                    ?>                         
                </tbody>
            </table>
        </div>
         <!-- INICIA TERCE PARTE -->
         <div>
            <table class="listado-previo" id="tabla-servicios-pre">
                <thead>
                    <th class="listado-th">TAPAS</th>
                    <th class="listado-th">SI</th>
                    <th class="listado-th">NO</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                <?php
                    foreach($datos_partidas_checklist as $row => $item){
                        for ($i=2; $i <=10 ; $i+=2) { 
                        switch ($item['parte_revisada']){
                            case ('TAPAS'.$i):
                                if($item["estado_general"] == "si"){
                                    echo '<tr>
                                    <td>'.$i.'</td>
                                    <td><input type="radio" class="buenos" name="t'.$i.'_estado" value="si" checked></td>
                                    <td><input type="radio" class="malos" name="t'.$i.'_estado" value="no"></td>';
                                }else{
                                    echo '<tr>
                                    <td>'.$i.'</td>
                                    <td><input type="radio" class="buenos" name="t'.$i.'_estado" value="si"></td>
                                    <td><input type="radio" class="malos" name="t'.$i.'_estado" value="no" checked></td>';
                                }
                                echo ' <td class="observaciones"><input class="observacion" type="text" name="t'.$i.'_observ" value="'.$item["observaciones_partida"].'"></td>
                                    <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                break;
                        }
                        }                        
                    }
                    ?>              
                </tbody>
            </table>
        </div>
        <!-- INICIA 1RA PARTE LLANTAS -->
        <div>
            <table class="listado-previo" id="tabla-servicios-pre">
                <thead>
                    <th class="listado-th">LLANTAS PONCHADAS</th>
                    <th class="listado-th">NO</th>
                    <th class="listado-th">SI</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                <?php
                    foreach($datos_partidas_checklist as $row => $item){
                        for ($i=1; $i <= 17 ; $i+=2){
                            switch ($item['parte_revisada']){
                                case ('LLANTAS'.$i):
                                    if($item["estado_general"] == "no"){
                                        echo '<tr>
                                        <td>'.$i.'</td>
                                        <td><input type="radio" class="buenos" name="llanta_'.$i.'_estado" value="no" checked></td>
                                        <td><input type="radio" class="malos" name="llanta_'.$i.'_estado" value="si"></td>';
                                    }else{
                                        echo '<tr>
                                        <td>'.$i.'</td>
                                        <td><input type="radio" class="buenos" name="llanta_'.$i.'_estado" value="no"></td>
                                        <td><input type="radio" class="malos" name="llanta_'.$i.'_estado" value="si" checked></td>';
                                    }
                                    echo '<td class="observaciones"><input class="observacion" type="text" name="llanta_'.$i.'_observ" value="'.$item["observaciones_partida"].'"></td>
                                        <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                    break;
                            } 
                        }
                    }                    
                  ?>
                </tbody>
            </table>
        </div>
         <!-- INICIA 2DA PARTE LLANTAS -->
         <div>
            <table class="listado-previo" id="tabla-servicios-pre">
                <thead>
                    <th class="listado-th">LLANTAS PONCHADAS</th>
                    <th class="listado-th">NO</th>
                    <th class="listado-th">SI</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                <?php
                    foreach($datos_partidas_checklist as $row => $item){
                        for ($i=2; $i <= 18 ; $i+=2){
                            switch ($item['parte_revisada']){
                                case ('LLANTAS'.$i):
                                    if($item["estado_general"] == "no"){
                                        echo '<tr>
                                        <td>'.$i.'</td>
                                        <td><input type="radio" class="buenos" name="llanta_'.$i.'_estado" value="no" checked></td>
                                        <td><input type="radio" class="malos" name="llanta_'.$i.'_estado" value="si"></td>';
                                    }else{
                                        echo '<tr>
                                        <td>'.$i.'</td>
                                        <td><input type="radio" class="buenos" name="llanta_'.$i.'_estado" value="no"></td>
                                        <td><input type="radio" class="malos" name="llanta_'.$i.'_estado" value="si" checked></td>';
                                    }
                                    echo '<td class="observaciones"><input class="observacion" type="text" name="llanta_'.$i.'_observ" value="'.$item["observaciones_partida"].'"></td>
                                        <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                break;
                            } 
                        }
                    }                    
                  ?>
                </tbody>
            </table>
        </div>
           <!-- INICIA TERCE PARTE -->
           <div>
            <table class="listado-previo" id="tabla-servicios-pre">
                <thead>
                    <th class="listado-th"></th>
                    <th class="listado-th">BUENO</th>
                    <th class="listado-th">MAL</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                <?php
                    foreach($datos_partidas_checklist as $row => $item){
                        switch ($item['parte_revisada']){
                            case 'ARRANQUE':
                                if($item["estado_general"] == "bueno"){
                                    echo '<tr><td>ARRANQUE</td>
                                    <td><input type="radio" class="buenos" name="arranque_estado" value="bueno" checked></td>
                                    <td><input type="radio" class="malos" name="arranque_estado" value="malo"></td>';
                                }else{
                                    echo '<tr><td>ARRANQUE</td>
                                    <td><input type="radio" class="buenos" name="arranque_estado" value="bueno"></td>
                                    <td><input type="radio" class="malos" name="arranque_estado" value="malo" checked></td>';
                                }
                                echo '<td class="observaciones"><input class="observacion" type="text" name="arranque_observaciones" value="'.$item["observaciones_partida"].'"></td>
                                    <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                break;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- INICIA TERCE PARTE -->
        <div>
            <table class="listado-previo" id="tabla-servicios-pre">
                <thead>
                    <th class="listado-th"></th>
                    <th class="listado-th">BUENO</th>
                    <th class="listado-th">MAL</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                <?php
                    foreach($datos_partidas_checklist as $row => $item){
                        switch ($item['parte_revisada']){
                            case 'TAKE OFF':
                                if($item["estado_general"] == "bueno"){
                                    echo '<tr><td>TAKE-OFF</td>
                                    <td><input type="radio" class="buenos" name="take_off_estado" value="bueno" checked></td>
                                    <td><input type="radio" class="malos" name="take_off_estado" value="malo"></td>';
                                }else{
                                    echo '<tr><td>TAKE-OFF</td>
                                    <td><input type="radio" class="buenos" name="take_off_estado" value="bueno"></td>
                                    <td><input type="radio" class="malos" name="take_off_estado" value="malo" checked></td>';
                                }
                                echo '<td class="observaciones"><input class="observacion" type="text" name="take_off_observ" value="'.$item["observaciones_partida"].'"></td>
                                <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                break;
                        }
                    }
                    ?>                        
                </tbody>
            </table>
        </div>
        <!-- INICIA TERCE PARTE -->
        <div>
            <table class="listado-previo" id="tabla-servicios-pre">
                <thead>
                    <th class="listado-th"></th>
                    <th class="listado-th">BUENO</th>
                    <th class="listado-th">MAL</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                <?php
                    foreach($datos_partidas_checklist as $row => $item){
                        switch ($item['parte_revisada']){
                            case 'PISO TRACTOR':
                                if($item["estado_general"] == "bueno"){
                                    echo '<tr><td>PISO TRACTOR</td>
                                    <td><input type="radio" class="buenos" name="piso_tractor_estado" value="bueno" checked></td>
                                    <td><input type="radio" class="malos" name="piso_tractor_estado" value="malo"></td>';
                                }else{
                                    echo '<tr><td>PISO TRACTOR</td>
                                    <td><input type="radio" class="buenos" name="piso_tractor_estado" value="bueno"></td>
                                    <td><input type="radio" class="malos" name="piso_tractor_estado" value="malo" checked></td>';
                                }
                                echo '<td class="observaciones"><input class="observacion" type="text" name="piso_tractor_observ" value="'.$item["observaciones_partida"].'"></td>
                                    <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                break;
                                case 'PISO REMOLQUE':
                                    if($item["estado_general"] == "bueno"){
                                        echo '<tr><td>PISO REMOLQUE</td>
                                        <td><input type="radio" class="buenos" name="piso_remolque_estado" value="bueno" checked></td>
                                        <td><input type="radio" class="malos" name="piso_remolque_estado" value="malo"></td>';
                                    }else{
                                        echo '<tr><td>PISO REMOLQUE</td>
                                        <td><input type="radio" class="buenos" name="piso_remolque_estado" value="bueno"></td>
                                        <td><input type="radio" class="malos" name="piso_remolque_estado" value="malo" checked></td>';
                                    }
                                    echo '<td class="observaciones"><input class="observacion" type="text" name="piso_remolque_observ" value="'.$item["observaciones_partida"].'"></td>
                                        <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                    break;                                
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- INICIA TERCE PARTE -->
        <div>
            <table class="listado-previo" id="tabla-servicios-pre">
                <thead>
                    <th class="listado-th"></th>
                    <th class="listado-th">SI</th>
                    <th class="listado-th">NO</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                <?php
                    foreach($datos_partidas_checklist as $row => $item){
                        switch ($item['parte_revisada']){
                            case 'BLOQUE HD TRACTOR':
                                if($item["estado_general"] == "si"){
                                    echo '<tr><td>BLOQUE HD TRACTOR</td>
                                    <td><input type="radio" class="buenos" name="bloque_hd_tractor_estado" value="si" checked></td>
                                    <td><input type="radio" class="malos" name="bloque_hd_tractor_estado" value="no"></td>';
                                }else{
                                    echo '<tr><td>BLOQUE HD TRACTOR</td>
                                    <td><input type="radio" class="buenos" name="bloque_hd_tractor_estado" value="si"></td>
                                    <td><input type="radio" class="malos" name="bloque_hd_tractor_estado" value="no" checked></td>';
                                }
                                echo '<td class="observaciones"><input class="observacion" type="text" name="bloque_hd_tractor_observ" value="'.$item["observaciones_partida"].'"></td>
                                    <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                break;
                                case 'BLOQUE HD REMOLQUE':
                                    if($item["estado_general"] == "si"){
                                        echo '<tr><td>BLOQUE HD REMOLQUE</td>
                                        <td><input type="radio" class="buenos" name="bloque_hd_remolque_estado" value="si" checked></td>
                                        <td><input type="radio" class="malos" name="bloque_hd_remolque_estado" value="no"></td>';
                                    }else{
                                        echo '<tr><td>BLOQUE HD REMOLQUE</td>
                                        <td><input type="radio" class="buenos" name="bloque_hd_remolque_estado" value="si"></td>
                                        <td><input type="radio" class="malos" name="bloque_hd_remolque_estado" value="no" checked></td>';
                                    }
                                    echo '<td class="observaciones"><input class="observacion" type="text" name="bloque_hd_remolque_observ" value="'.$item["observaciones_partida"].'"></td>
                                        <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                    break;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
         <!-- INICIA PARTE DE RAMPAS -->
         <div>
            <table class="listado-previo" id="tabla-servicios-pre">
                <thead>
                    <th class="listado-th">RAMPAS</th>
                    <th class="listado-th">BUENO</th>
                    <th class="listado-th">MAL</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                    <?php                   
                     foreach($datos_partidas_checklist as $row => $item){
                         for ($i=1; $i <= 30 ; $i++){
                             switch ($item['parte_revisada']){
                                 case ('RAMPAS'.$i):
                                     if($item["estado_general"] == "bueno"){
                                         echo '<tr><td>'.$i.'</td>
                                                <td><input type="radio" class="buenos" name="rampa_'.$i.'_estado" value="bueno" checked></td>
                                                <td><input type="radio" class="malos" name="rampa_'.$i.'_estado" value="malo"></td>';
                                     }else{
                                         echo '<tr><td>'.$i.'</td>
                                                <td><input type="radio" class="buenos" name="rampa_'.$i.'_estado" value="bueno"></td>
                                                <td><input type="radio" class="malos" name="rampa_'.$i.'_estado" value="malo" checked></td>';
                                     }
                                     echo '<td class="observaciones"><input class="observacion" type="text" name="rampa_'.$i.'_observ" value="'.$item["observaciones_partida"].'"></td>
                                        <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                 break;
                             } 
                         }
                     }                    
                    ?>
                </tbody>
            </table>
        </div>
          <!-- INICIA PARTE DE PISTONES -->
        <div>
            <table class="listado-previo" id="tabla-servicios-pre">
                <thead>
                    <th class="listado-th">PISTONES</th>
                    <th class="listado-th">BUENO</th>
                    <th class="listado-th">MAL</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                    <?php 
                     foreach($datos_partidas_checklist as $row => $item){
                        for ($i=1; $i <= 30 ; $i++){
                            switch ($item['parte_revisada']){
                                case ('PISTONES'.$i):
                                    if($item["estado_general"] == "bueno"){
                                        echo '<tr><td>'.$i.'</td>
                                               <td><input type="radio" class="buenos" name="piston_'.$i.'_estado" value="bueno" checked></td>
                                               <td><input type="radio" class="malos" name="piston_'.$i.'_estado" value="malo"></td>';
                                    }else{
                                        echo '<tr><td>'.$i.'</td>
                                               <td><input type="radio" class="buenos" name="piston_'.$i.'_estado" value="bueno"></td>
                                               <td><input type="radio" class="malos" name="piston_'.$i.'_estado" value="malo" checked></td>';
                                    }
                                    echo '<td class="observaciones"><input class="observacion" type="text" name="piston_'.$i.'_observ" value="'.$item["observaciones_partida"].'"></td>
                                        <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                break;
                            } 
                        }
                    }                    
                    ?>
                </tbody>
            </table>
        </div>
        <!-- ULTIMA PARTE EQUIPAMIENTO -->
        <div>
            <table class="listado-previo" id="tabla-servicios-pre">
                <thead>
                    <th class="listado-th">EL EQUIPO CUENTA CON </th>
                    <th class="listado-th">SI</th>
                    <th class="listado-th">NO</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                <?php
                    foreach($datos_partidas_checklist as $row => $item){
                        switch ($item['parte_revisada']){
                            case 'CINCHOS DE TRINCADO':
                                if($item["estado_general"] == "si"){
                                    echo '<tr><td>28.-CINCHOS DE TRINCADO</td>
                                    <td><input type="radio" class="buenos" name="cinchos_trincado_estado" value="si" checked></td>
                                    <td><input type="radio" class="malos" name="cinchos_trincado_estado" value="no"></td>';
                                }else{
                                    echo '<tr><td>28.-CINCHOS DE TRINCADO</td>
                                    <td><input type="radio" class="buenos" name="cinchos_trincado_estado" value="si"></td>
                                    <td><input type="radio" class="malos" name="cinchos_trincado_estado" value="no" checked></td>';
                                }
                                echo '<td class="observaciones"><input class="observacion" type="text" name="cinchos_trincado_observ" value="'.$item["observaciones_partida"].'"></td>
                                    <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                break;
                                case 'TENDEDEROS':
                                    if($item["estado_general"] == "si"){
                                        echo '<tr><td>29 TENDEDEROS</td>
                                        <td><input type="radio" class="buenos" name="tendederos_estado" value="si" checked></td>
                                        <td><input type="radio" class="malos" name="tendederos_estado" value="no"></td>';
                                    }else{
                                        echo '<tr><td>29 TENDEDEROS</td>
                                        <td><input type="radio" class="buenos" name="tendederos_estado" value="si"></td>
                                        <td><input type="radio" class="malos" name="tendederos_estado" value="no" checked></td>';
                                    }
                                    echo '<td class="observaciones"><input class="observacion" type="text" name="tendederos_observ" value="'.$item["observaciones_partida"].'"></td>
                                        <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                    break;
                                case 'MALLA CUBRE AL 100':
                                    if($item["estado_general"] == "si"){
                                        echo ' <tr><td>30.- MALLA CUBRE AL 100%</td>
                                        <td><input type="radio" class="buenos" name="malla_estado" value="bueno" checked></td>
                                        <td><input type="radio" class="malos" name="malla_estado" value="malo"></td>';
                                    }else{
                                        echo '<tr><td>30.- MALLA CUBRE AL 100%</td>
                                        <td><input type="radio" class="buenos" name="malla_estado" value="bueno"></td>
                                        <td><input type="radio" class="malos" name="malla_estado" value="malo" checked></td>';
                                    }
                                    echo '<td class="observaciones"><input class="observacion" type="text" name="malla_observ" value="'.$item["observaciones_partida"].'"></td>
                                        <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                    break;
                                case 'MARCA EN PTR':
                                    if($item["estado_general"] == "si"){
                                        echo '<tr><td>31.- MARCA EN PTR</td>
                                        <td><input type="radio" class="buenos" name="ptr_estado" value="bueno" checked></td>
                                        <td><input type="radio" class="malos" name="ptr_estado" value="malo"></td>';
                                      }else{
                                        echo '<tr><td>31.- MARCA EN PTR</td>
                                        <td><input type="radio" class="buenos" name="ptr_estado" value="bueno"></td>
                                        <td><input type="radio" class="malos" name="ptr_estado" value="malo" checked></td>';
                                    }
                                    echo '<td class="observaciones"><input class="observacion" type="text" name="ptr_observ" value="'.$item["observaciones_partida"].'"></td>
                                        <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                    break;
                                case 'CADENA DE TRINCADO':
                                    if($item["estado_general"] == "si"){
                                        echo '<tr><td>32.- CADENA DE TRINCADO</td>
                                        <td><input type="radio" class="buenos" name="cadena_trincado_estado" value="bueno" checked></td>
                                        <td><input type="radio" class="malos" name="cadena_trincado_estado" value="malo"></td>';
                                    }else{
                                        echo '<tr><td>32.- CADENA DE TRINCADO</td>
                                        <td><input type="radio" class="buenos" name="cadena_trincado_estado" value="bueno"></td>
                                        <td><input type="radio" class="malos" name="cadena_trincado_estado" value="malo" checked></td>';
                                    }
                                    echo '<td class="observaciones"><input class="observacion" type="text" name="cadena_trincado_observ" value="'.$item["observaciones_partida"].'"></td>
                                        <input type="hidden" name="partidas[]" value="'.$item["id_partida"].'"></tr>';
                                    break;
                        }
                    }
                    ?>
                </tbody>
                </table>
            </div>
        </div>
        <input class="btn-actualizar" type="submit" value="ACTUALIZAR">
    </form>
</div>
<?php
ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);
$vistaUsuario->actualizarChecklistController();
?>