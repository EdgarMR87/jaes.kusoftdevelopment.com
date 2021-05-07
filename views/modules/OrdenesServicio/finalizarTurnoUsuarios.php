<script>

function clickaction(b){
    document.getElementById('id_os_borrar').value = b.id; 
    document.getElementById('os').innerHTML = b.dataset.user + "?";
}

</script>
<?php
    echo "<script> window.document.title = 'FINALIZAR TURNO DE TRABAJADOR'</script>"; // TITULO DE LA VENTANA
    $vistaUsuario = new MvcController();
    $fila = $vistaUsuario -> vistaPartidasFinalizarUsuariosController();         
?>

<div class="tablas-listado" id="contenido">
    <h1>FINALIZAR TURNO DE TRABAJADOR</h1>
    <table class="listado-previo" id="tabla-servicios-pre">
        <thead>
            <th class="listado-th">Unidad</th>
            <th class="listado-th">Servicio</th>
            <th class="listado-th">Trabajador</th>
            <th class="listado-th">Fecha de Inicio</th>
            <th class="listado-th">Terminar Turno</th>
        </thead>
        <tbody>
            <?php 
                ini_set('display_errors', '1');
                ini_set('error_reporting', E_ALL);
    		   
                foreach($fila as $row => $campo){
                echo "<tr>
                    <td>".
                        $campo['id_unidad_servicio']
                    ."</td>
                    <td>".
                    utf8_encode($campo['descripcion_serv'])
                    ."</td>
                    <td>".
                        $campo['nombreCompleto']
                    ."</td>
                    <td>".
                        $campo['fecha_asignacion']
                    ."</td>
                    <td>
                        <a onclick=clickaction(this) href='#openModalIniciar' id='". $campo['id_u_p_os'] ."' data-user='". $campo["nombreCompleto"]."'>
                            <img class='ico-partida' src='/views/img/stop.png'>
                        </a>
                    </td>
                    </tr>";
                }
		    ?>
        </tbody>
    </table>
    <form action="" method="post">
    <!-- MODAL PARA FINALIZAR SERVICIO -->
        <div id="openModalIniciar" class="modalDialog">
        	<div class="preguntar">
                <a href="#close" title="Close" class="close">X</a>
                <input type="hidden" name="id_partida_finalizar" id="id_os_borrar">
                <h1>FINALIZAR TURNO DE TRABAJADOR</h1>
                <table>
                    <tr>
                        <td> 
                            <div class="en-linea">
                                <p>¿Deseas finalizar el turno del trabajador : &nbsp;<h2 id="os"></h2></p>
                            </div>
                        </td>
                        <td>
                            <input class="btn-eliminar" type="submit" value="FINALIZAR">
                        </td>  
                    </tr>
                </table>
            </div>
        </div>
        <!-- TERMINA EL MODAL PARA FINALIZAR SERVICIO -->
        <?php
         $vistaUsuario = new MvcController();
         $vistaUsuario -> finalizarTurnoUsuarioController();
        ?>
    </form>
</div>