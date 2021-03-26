<script>
$(document).ready(function(){
	$('#capturo').toggle();
	$('#atiempo').toggle();
	$('td:nth-child(4)').toggle();
	$('td:nth-child(9)').toggle();
});
</script>
<div class="tablas-listado" id="contenido">
    <h1>Listado Ordenes de Servicio ATR</h1>
	<table class="tabla-listado" id="listado-os">	
		<thead>	
			<tr>
				<th class="listado-th"># ORDEN</th>
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
                        <td>'.$item["num_orden"].'</td>
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
                        <td>'.$item["estado"].'</td>
                        <td>'.$item["avance_porcentaje"].'</td>
                        <td><a href="index.php?action=OrdenesServicio/detalleOS&id_os_editar='.$item["num_orden"].'"><img src="/views/img/editar.png" class="img-25"></img></a></td>
                        <td><a href="index.php?action=OrdenesServicio/listadoOS&id_os_borrar='.$item["num_orden"].'"><img src="/views/img/eliminar.png" class="img25"></img></a></td>
                    </tr>';
            }
			$vistaUsuario -> borrarOSAtrController();
			?>
		</tbody>
	</table>
</div>