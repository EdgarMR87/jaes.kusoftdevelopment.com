<script>

function clickactionEliminar( b ){
    document.getElementById('id_os_borrar').value = b.id; 
    document.getElementById('os').innerHTML = b.id + "?";
}

$(document).ready(function(){
    $('.num_orden').toggle();
	$('#capturo').toggle();
	$('#atiempo').toggle();
	$('td:nth-child(4)').toggle();
	$('td:nth-child(9)').toggle();
});

</script>
<div class="tablas-listado" id="contenido">
    <div class="new-flotante">
        <a href="index.php?action=OrdenesServicio/altaOrdenS">
            <img src="/views/img/new_Flotante.png" alt="">
        </a>
    </div>
    <h1>Listado Ordenes de Servicio ATR</h1>
	<table class="tabla-listado" id="listado-os">	
		<thead>	
			<tr>
				<th class="num_orden"># ORDEN</th>
				<th class="listado-th">Unidad</th>
				<th class="listado-th">Operador</th>
				<th class="listado-th" id="capturo">Capturó</th>
				<th class="listado-th">Fecha Orden</th>
                <th class="listado-th">Kilometraje</th>
                <th class="listado-th">Servicio</th>
                <th class="listado-th">Tipo de Servicio</th>
                <th class="listado-th" id="atiempo">A tiempo</th>
                <th class="listado-th">Fecha Creación</th>
                <th class="listado-th">Creado Por</th>
                <th class="listado-th">Estado</th>
                <th class="listado-th">Avance %</th>
                <th class="listado-th">Modificar</th>
				<th class="listado-th">Eliminar</th>
			</tr>
		</thead>
		<tbody>

			<?php
              ini_set('display_errors', '1');
              ini_set('error_reporting', E_ALL);
			$vistaUsuario = new MvcController();
			$respuesta = $vistaUsuario -> vistaOSAtrTablaController();
            foreach($respuesta as $row => $item){
                echo'<tr>
                        <td class="num_orden">'.$item["num_orden"].'</td>
                        <td><a href="index.php?action=OrdenesServicio/detalleOS&id_os_editar='.$item["num_orden"].'">'.$item["id_unidad_servicio"].'</a></td>
                        <td>'.$item["operador"].'</td>
                        <td>'.$item["captura"].'</td>
                        <td>'.$item["fecha_orden"].'</td>
                        <td>'.$item["kilometraje"].'</td>
                        <td>'.$item["servicio"].'</td>
                        <td>'.$item["tipo_servicio"].'</td>
                        <td>'.$item["servicio_tiempo"].'</td>
                        <td>'.$item["fecha_creacion"].'</td>
                        <td>'.$item["nombre_completo"].'</td>
                        <td class='."'".$item["estado"]."'".'>'.$item["estado"].'</td>
                        <td>'.$item["avance_porcentaje"].'</td>
                        <td><a href="index.php?action=OrdenesServicio/editarOS&id_os_editar='.$item["num_orden"].'"><img src="/views/img/editar.png" class="img-25"></img></a></td>
                        <td><a href="#openModalEliminar" onclick="clickactionEliminar(this)" id="'.$item["num_orden"].'"><img src="/views/img/eliminar.png" class="img25"></img></a></td>
                    </tr>';
            }			
			?>
		</tbody>
	</table>
    <form action="" method="post">
    <!-- MODAL PARA FINALIZAR SERVICIO -->
    <div id="openModalEliminar" class="modalDialog">
    	    <div class="preguntar">
                <a href="#close" title="Close" class="close">X</a>
                <input type="hidden" name="id_os_borrar" id="id_os_borrar">
                <h1>ELIMINAR OS Y PARTIDAS</h1>
                <table>
                    <tr>
                        <td> 
                            <div class="en-linea">
                                <p>¿Deseas Eliminar las partidas de la OS : &nbsp;<h2 id="os"></h2></p>
                            </div>
                        </td>
                        <td>
                            <input class="btn-eliminar" type="submit" value="ELIMINAR">
                        </td>  
                    </tr>
                </table>
	        </div>
        </div>
        <!-- TERMINA EL MODAL PARA FINALIZAR SERVICIO -->
        <?php
        $vistaUsuario = new MvcController();
        $vistaUsuario -> borrarOSAtrController();
        ?>
    </form>
</div>

 