<script>
    $(document).on('click', '.malos', function(evetn){
        $(this).closest('tr').find('td:nth-child(4)').css("display","block");
    });
    $(document).on('click', '.buenos', function(evetn){
        $(this).closest('tr').find('td:nth-child(4)').css("display","none");
    });
</script>

<div class="tablas-listado" id="contenido">
<h1>REGISTRO CHECKLIST MAZDA</h1>

<form method="post" class="form-alta-serv">
    <table class="tabla-alta-serv">
            <tr>
                <td class="titulo"><p class="derecha">Fecha : </p></td>
                <td class=input>
                <?php
                    date_default_timezone_set('America/Mexico_City');
                 ?>
                    <input type="datetime-local" value="<?php echo date('Y-m-d\TH:i');?>" name="fecha_checklist" readonly>
                </td>
                <td class="titulo"><p class="derecha">Realizado Por : </p></td>
                <td class=input>
                   <input type="text" name="usuario" value="<?php echo $_SESSION['nombreCompleto']; ?>" readonly>
                   <input type="hidden" name="id_usuario" value="<?php echo $_SESSION["id_usuario"]; ?>">
                </td>
            </tr>
            <tr>
                <td class="titulo"><p class="derecha">Kilometraje : </p></td>
                <td class=input>
                    <input type="number" placeholder="999999" name="kilometraje_checklist" required>
                </td>
                <td class="titulo"><p class="derecha">Unidad Mazda : </p></td>
                <td class=input>
                    <select name="unidad_checklist" id="unidad_checklist" required> 
                        <?php 
                          $vistaUsuario = new MvcController();
                          $vistaUsuario->vistaUnidadesMazdaSelectController();
                        ?>
                    </select>
                </td>
            </tr>
            <tr> 
                <td class="titulo"><p class="derecha">Observaciones Finales : </p></td>
                <td class=input colspan="3">
                    <input type="text" class="width-100" placeholder="Escribe tus comentarios en general" name="observaciones_checklist">
                </td>
            </tr>
    </table>

    <div class="panel-checklist">
        <div>
            <table class="listado-checklist" id="carroceria">
                <thead>
                    <th class="listado-th">Carroceria</th>
                    <th class="listado-th">Bueno</th>
                    <th class="listado-th">Malo</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Cristales</td>
                        <td><input type="radio" class="buenos" name="cristales_estado" value="bueno" checked></td>
                        <td><input type="radio" class="malos" name="cristales_estado" value="malo"></td>
                        <td class="observaciones"><input type="text" name="cristales_observ"></td>
                    </tr>
                    <tr>
                        <td>Espejos</td>
                        <td><input type="radio" class="buenos" name="espejos_estado" value="bueno" checked></td>
                        <td><input type="radio" class="malos" name="espejos_estado" value="malo"></td>
                        <td class="observaciones"><input type="text" name="espejos_observ"></td>
                    </tr>
                    <tr>
                        <td>Parabrisas</td>
                        <td><input type="radio" class="buenos" name="parabrisas_estado" value="bueno" checked></td>
                        <td><input type="radio" class="malos" name="parabrisas_estado" value="malo"></td>
                        <td class="observaciones"><input type="text" name="parabrisas_observ"></td>
                    </tr>
                    <tr>
                        <td>Baterias</td>
                        <td><input type="radio" class="buenos" name="baterias_estado" value="bueno" checked></td>
                        <td><input type="radio" class="malos" name="baterias_estado" value="malo"></td>
                        <td class="observaciones"><input type="text" name="baterias_observ"></td>
                    </tr>
                </tbody>
            </table>
        </div>  
        
        <div>
            <table class="listado-checklist" id="carroceria">
                <thead>
                    <th class="listado-th">Electrico</th>
                    <th class="listado-th">Bueno</th>
                    <th class="listado-th">Malo</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Encendido de Luces</td>
                        <td><input type="radio" class="buenos" name="luces_estado" value="bueno" checked></td>
                        <td><input type="radio" class="malos" name="luces_estado" value="malo"></td>
                        <td class="observaciones"><input type="text" name="luces_observaciones"></td>
                    </tr>
                    <tr>
                        <td>Plafones</td>
                        <td><input type="radio" class="buenos" name="plafones_estado" value="bueno" checked></td>
                        <td><input type="radio" class="malos" name="plafones_estado" value="malo"></td>
                        <td class="observaciones"><input type="text" name="plafones_observ"></td>
                    </tr>
                    <tr>
                        <td>Luz de Trabajo</td>
                        <td><input type="radio" class="buenos" name="luz_trabajo_estado" value="bueno" checked></td>
                        <td><input type="radio" class="malos" name="luz_trabajo_estado" value="malo" ></td>
                        <td class="observaciones"><input type="text" name="luz_trabajo_estado_observ"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- INICIA TERCE PARTE -->
        <div>
            <table class="listado-checklist" id="carroceria">
                <thead>
                    <th class="listado-th">Niveles</th>
                    <th class="listado-th">SI</th>
                    <th class="listado-th">NO</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Motor</td>
                        <td><input type="radio" class="buenos" name="motor_estado" value="si" checked></td>
                        <td><input type="radio" class="malos" name="motor_estado" value="no"></td>
                        <td class="observaciones"><input type="text" name="motor_observ"></td>
                    </tr>
                    <tr>
                        <td>Anticongelante</td>
                        <td><input type="radio" class="buenos" name="anticongelante_estado" value="si" checked></td>
                        <td><input type="radio" class="malos" name="anticongelante_estado" value="no"></td>
                        <td class="observaciones"><input type="text" name="anticongelante_observ"></td>
                    </tr>
                    <tr>
                        <td>Direccion HD</td>
                        <td><input type="radio" class="buenos" name="direccion_estado" value="si" checked></td>
                        <td><input type="radio" class="malos" name="direccion_estado" value="no"></td>
                        <td class="observaciones"><input type="text" name="direccion_observ"></td>
                    </tr>
                    <tr>
                        <td>Clutch</td>
                        <td><input type="radio" class="buenos" name="clutch_estado" value="si" checked></td>
                        <td><input type="radio" class="malos" name="clutch_estado" value="no"></td>
                        <td class="observaciones"><input type="text" name="clutch_observ"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- INICIA TERCE PARTE -->
        <div>
            <table class="listado-checklist" id="carroceria">
                <thead>
                    <th class="listado-th"></th>
                    <th class="listado-th">Bueno</th>
                    <th class="listado-th">Malo</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Admision</td>
                        <td><input type="radio" class="buenos" name="admision_estado" value="bueno" checked></td>
                        <td><input type="radio" class="malos" name="admision_estado" value="malo"></td>
                        <td class="observaciones"><input type="text" name="admision_observ"></td>
                    </tr>
                    <tr>
                        <td>Bandas</td>
                        <td><input type="radio" class="buenos" name="bandas_estado" value="bueno" checked></td>
                        <td><input type="radio" class="malos" name="bandas_estado" value="malo"></td>
                        <td class="observaciones"><input type="text" name="bandas_observ"></td>
                    </tr>
                </tbody>
            </table>
        </div>  
        <!-- INICIA TERCE PARTE -->
        <div>
            <table class="listado-checklist" id="carroceria">
                <thead>
                    <th class="listado-th">Fugas de Aceite</th>
                    <th class="listado-th">NO</th>
                    <th class="listado-th">SI</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Motor</td>
                        <td><input type="radio" class="buenos" name="f_motor_estado" value="no" checked></td>
                        <td><input type="radio" class="malos" name="f_motor_estado" value="si"></td>
                        <td class="observaciones"><input type="text" name="f_motor_observ"></td>
                    </tr>
                    <tr>
                        <td>Transmisión</td>
                        <td><input type="radio" class="buenos" name="transmision_estado" value="no" checked></td>
                        <td><input type="radio" class="malos" name="transmision_estado" value="si"></td>
                        <td class="observaciones"><input type="text" name="transmision_observ"></td>
                    </tr>
                    <tr>
                        <td>Diferencial</td>
                        <td><input type="radio" class="buenos" name="diferencial_estado" value="no" checked></td>
                        <td><input type="radio" class="malos" name="diferencial_estado" value="si"></td>
                        <td class="observaciones"><input type="text" name="diferencial_observ"></td>
                    </tr>
                </tbody>
            </table>
        </div>
             <!-- INICIA TERCE PARTE -->
             <div>
            <table class="listado-checklist" id="carroceria">
                <thead>
                    <th class="listado-th">Revisión de Pasa Muros</th>
                    <th class="listado-th">BUENO</th>
                    <th class="listado-th">MAL</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Eléctrico</td>
                        <td><input type="radio" class="buenos" name="r_pasamuros_electrico_estado" value="bueno" checked></td>
                        <td><input type="radio" class="malos" name="r_pasamuros_electrico_estado" value="malo"></td>
                        <td class="observaciones"><input type="text" name="r_pasamuros_electrico_obser"></td>
                    </tr>
                    <tr>
                        <td>Hidráulico</td>
                        <td><input type="radio" class="buenos" name="r_pasamuros_hidraulico_estado" value="bueno" checked></td>
                        <td><input type="radio" class="malos" name="r_pasamuros_hidraulico_estado" value="malo"></td>
                        <td class="observaciones"><input type="text" name="r_pasamuros_hidraulico_observ"></td>
                    </tr>
                    <tr>
                        <td>Neumático</td>
                        <td><input type="radio" class="buenos" name="r_pasamuros_neumatico_estado" value="bueno" checked></td>
                        <td><input type="radio" class="malos" name="r_pasamuros_neumatico_estado" value="malo"></td>
                        <td class="observaciones"><input type="text" name="r_pasamuros_neumatico_observ"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- INICIA TERCE PARTE -->
        <div>
            <table class="listado-checklist" id="carroceria">
                <thead>
                    <th class="listado-th">TAPAS</th>
                    <th class="listado-th">SI</th>
                    <th class="listado-th">NO</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><input type="radio" class="buenos" name="t1_estado" value="si" checked></td>
                        <td><input type="radio" class="malos" name="t1_estado" value="no"></td>
                        <td class="observaciones"><input type="text" name="t1_observ"></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><input type="radio" class="buenos" name="t3_estado" value="si" checked></td>
                        <td><input type="radio" class="malos" name="t3_estado" value="no"></td>
                        <td class="observaciones"><input type="text" name="t3_observ"></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td><input type="radio" class="buenos" name="t5_estado" value="si" checked></td>
                        <td><input type="radio" class="malos" name="t5_estado" value="no"></td>
                        <td class="observaciones"><input type="text" name="t5_observ"></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td><input type="radio" class="buenos" name="t7_estado" value="si" checked></td>
                        <td><input type="radio" class="malos" name="t7_estado" value="no"></td>
                        <td class="observaciones"><input type="text" name="t7_observ"></td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td><input type="radio" class="buenos" name="t9_estado" value="si" checked></td>
                        <td><input type="radio" class="malos" name="t9_estado" value="no"></td>
                        <td class="observaciones"><input type="text" name="t9_observ"></td>
                    </tr>
                </tbody>
            </table>
        </div>    
        <!-- INICIA TERCE PARTE -->
        <div>
            <table class="listado-checklist" id="carroceria">
                <thead>
                    <th class="listado-th">TAPAS</th>
                    <th class="listado-th">SI</th>
                    <th class="listado-th">NO</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                    <tr>
                        <td>2</td>
                        <td><input type="radio" class="buenos" name="t2_estado" value="si" checked></td>
                        <td><input type="radio" class="malos" name="t2_estado" value="no"></td>
                        <td class="observaciones"><input type="text" name="t2_observ"></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td><input type="radio" class="buenos" name="t4_estado" value="si" checked></td>
                        <td><input type="radio" class="malos" name="t4_estado" value="no"></td>
                        <td class="observaciones"><input type="text" name="t4_observ"></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td><input type="radio" class="buenos" name="t6_estado" value="si" checked></td>
                        <td><input type="radio" class="malos" name="t6_estado" value="no"></td>
                        <td class="observaciones"><input type="text" name="t6_observ"></td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td><input type="radio" class="buenos" name="t8_estado" value="si" checked></td>
                        <td><input type="radio" class="malos" name="t8_estado" value="no"></td>
                        <td class="observaciones"><input type="text" name="t8_observ"></td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td><input type="radio" class="buenos" name="t10_estado" value="si" checked></td>
                        <td><input type="radio" class="malos" name="t10_estado" value="no"></td>
                        <td class="observaciones"><input type="text" name="t10_observ"></td>
                    </tr>
                </tbody>
            </table>
        </div>  
        <!-- INICIA 1RA PARTE LLANTAS -->
        <div>
            <table class="listado-checklist" id="carroceria">
                <thead>
                    <th class="listado-th">LLANTAS PONCHADAS</th>
                    <th class="listado-th">NO</th>
                    <th class="listado-th">SI</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                <?php 
                  for ($i=1; $i <= 17 ; $i+=2) { 
                    echo "<tr>
                              <td>$i</td>
                              <td>
                                  <input type='radio' class='buenos' name='llanta_".$i."_estado' value='no' checked>
                              </td>
                              <td>
                                  <input type='radio' class='malos' name='llanta_".$i."_estado' value='si'>
                              </td>
                              <td class='observaciones'>
                                  <input type='text' name='llanta_".$i."_observ' id='observaciones'>
                              </td>
                          </tr>";
                  }                    
                  ?>
                </tbody>
            </table>
        </div>  
        <!-- INICIA 2DA PARTE LLANTAS -->
        <div>
            <table class="listado-checklist" id="carroceria">
                <thead>
                    <th class="listado-th">LLANTAS PONCHADAS</th>
                    <th class="listado-th">NO</th>
                    <th class="listado-th">SI</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                <?php 
                  for ($i=2; $i <= 18 ; $i+=2) { 
                    echo "<tr>
                              <td>$i</td>
                              <td>
                                  <input type='radio' class='buenos' name='llanta_".$i."_estado' value='no' checked>
                              </td>
                              <td>
                                  <input type='radio' class='malos' name='llanta_".$i."_estado' value='si'>
                              </td>
                              <td class='observaciones'>
                                  <input type='text' name='llanta_".$i."_observ' id='observaciones'>
                              </td>
                          </tr>";
                  }                    
                  ?>
                </tbody>
            </table>
        </div>
          <!-- INICIA TERCE PARTE -->
        <div>
            <table class="listado-checklist" id="carroceria">
                <thead>
                    <th class="listado-th"></th>
                    <th class="listado-th">BUENO</th>
                    <th class="listado-th">MAL</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                    <tr>
                        <td>ARRANQUE</td>
                        <td><input type="radio" class="buenos" name="arranque_estado" value="bueno" checked></td>
                        <td><input type="radio" class="malos" name="arranque_estado" value="malo"></td>
                        <td class="observaciones"><input type="text" name="arranque_observaciones"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- INICIA TERCE PARTE -->
        <div>
            <table class="listado-checklist" id="carroceria">
                <thead>
                    <th class="listado-th"></th>
                    <th class="listado-th">BUENO</th>
                    <th class="listado-th">MAL</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                    <tr>
                        <td>TAKE-OFF</td>
                        <td><input type="radio" class="buenos" name="take_off_estado" value="bueno" checked></td>
                        <td><input type="radio" class="malos" name="take_off_estado" value="malo"></td>
                        <td class="observaciones"><input type="text" name="take_off_observ"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- INICIA TERCE PARTE -->
        <div>
            <table class="listado-checklist" id="carroceria">
                <thead>
                    <th class="listado-th"></th>
                    <th class="listado-th">BUENO</th>
                    <th class="listado-th">MAL</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                    <tr>
                        <td>PISO TRACTOR</td>
                        <td><input type="radio" class="buenos" name="piso_tractor_estado" value="bueno" checked></td>
                        <td><input type="radio" class="malos" name="piso_tractor_estado" value="malo"></td>
                        <td class="observaciones"><input type="text" name="piso_tractor_observ"></td>
                    </tr>
                    <tr>
                        <td>PISO REMOLQUE</td>
                        <td><input type="radio" class="buenos" name="piso_remolque_estado" value="bueno" checked></td>
                        <td><input type="radio" class="malos" name="piso_remolque_estado" value="malo"></td>
                        <td class="observaciones"><input type="text" name="piso_remolque_observ"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- INICIA TERCE PARTE -->
        <div>
            <table class="listado-checklist" id="carroceria">
                <thead>
                    <th class="listado-th"></th>
                    <th class="listado-th">SI</th>
                    <th class="listado-th">NO</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                    <tr>
                        <td>BLOQUE HD TRACTOR</td>
                        <td><input type="radio" class="buenos" name="bloque_hd_tractor_estado" value="si" checked></td>
                        <td><input type="radio" class="malos" name="bloque_hd_tractor_estado" value="no"></td>
                        <td class="observaciones"><input type="text" name="bloque_hd_tractor_observ"></td>
                    </tr>
                    <tr>
                        <td>BLOQUE HD REMOLQUE</td>
                        <td><input type="radio" class="buenos" name="bloque_hd_remolque_estado" value="si" checked></td>
                        <td><input type="radio" class="malos" name="bloque_hd_remolque_estado" value="no"></td>
                        <td class="observaciones"><input type="text" name="bloque_hd_remolque_observ"></td>
                    </tr>
                </tbody>
            </table>
        </div>
         <!-- INICIA PARTE DE RAMPAS -->
         <div>
            <table class="listado-checklist" id="carroceria">
                <thead>
                    <th class="listado-th">RAMPAS</th>
                    <th class="listado-th">BUENO</th>
                    <th class="listado-th">MAL</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                    <?php 
                  
                    for ($i=1; $i <= 30 ; $i++) { 
                      echo "<tr>
                                <td>$i</td>
                                <td>
                                    <input type='radio' class='buenos' name='rampa_".$i."_estado' value='bueno' checked>
                                </td>
                                <td>
                                    <input type='radio' class='malos' name='rampa_".$i."_estado' value='malo'>
                                </td>
                                <td class='observaciones'>
                                    <input type='text' name='rampa_".$i."_observ'>
                                </td>
                            </tr>";
                    }                    
                    ?>
                </tbody>
            </table>
        </div>
          <!-- INICIA PARTE DE PISTONES -->
        <div>
            <table class="listado-checklist" id="carroceria">
                <thead>
                    <th class="listado-th">PISTONES</th>
                    <th class="listado-th">BUENO</th>
                    <th class="listado-th">MAL</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                    <?php 
                  
                    for ($i=1; $i <= 30 ; $i++) { 
                      echo "<tr>
                                <td>$i</td>
                                <td>
                                    <input type='radio' class='buenos' name='piston_".$i."_estado' value='bueno' checked>
                                </td>
                                <td>
                                    <input type='radio' class='malos' name='piston_".$i."_estado' value='malo'>
                                </td>
                                <td class='observaciones'>
                                    <input type='text' name='piston_".$i."_observ'>
                                </td>
                            </tr>";
                    }                    
                    ?>
                </tbody>
            </table>
        </div>
         <!-- ULTIMA PARTE EQUIPAMIENTO -->
        <div>
            <table class="listado-checklist" id="carroceria">
                <thead>
                    <th class="listado-th">EL EQUIPO CUENTA CON </th>
                    <th class="listado-th">SI</th>
                    <th class="listado-th">NO</th>
                    <th class="listado-th">Observaciones</th>
                </thead>
                <tbody>
                    <tr>
                        <td>28.-CINCHOS DE TRINCADO</td>
                        <td><input type="radio" class="buenos" name="cinchos_trincado_estado" value="si" checked></td>
                        <td><input type="radio" class="malos" name="cinchos_trincado_estado" value="no"></td>
                        <td class="observaciones"><input type="text" name="cinchos_trincado_observ"></td>
                    </tr>
                    <tr>
                        <td>29 TENDEDEROS</td>
                        <td><input type="radio" class="buenos" name="tendederos_estado" value="si" checked></td>
                        <td><input type="radio" class="malos" name="tendederos_estado" value="no"></td>
                        <td class="observaciones"><input type="text" name="tendederos_observ"></td>
                    </tr>
                    <tr>
                        <td>30.- MALLA CUBRE AL 100%</td>
                        <td><input type="radio" class="buenos" name="malla_estado" value="si" checked></td>
                        <td><input type="radio" class="malos" name="malla_estado" value="no"></td>
                        <td class="observaciones"><input type="text" name="malla_observ"></td>
                    </tr>
                    <tr>
                        <td>31.- MARCA EN PTR</td>
                        <td><input type="radio" class="buenos" name="ptr_estado" value="si" checked></td>
                        <td><input type="radio" class="malos" name="ptr_estado" value="no"></td>
                        <td class="observaciones"><input type="text" name="ptr_observ"></td>
                    </tr>
                    <tr>
                        <td>32.- CADENA DE TRINCADO</td>
                        <td><input type="radio" class="buenos" name="cadena_trincado_estado" value="si" checked></td>
                        <td><input type="radio" class="malos" name="cadena_trincado_estado" value="no"></td>
                        <td class="observaciones"><input type="text" name="cadena_trincado_observ"></td>
                    </tr>
                </tbody>
            </table>
        </div>  
    </div>
    <input class="btn-registrar" type="submit" value="REGISTRAR">
</form>
</div>
<?php
/*ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);*/
$vistaUsuario->registroChecklistController();
?>