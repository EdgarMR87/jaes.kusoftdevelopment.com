<div class="tablas-listado" id="contenido">
<h1>Listado Servicios ATR</h1>

	<table class="tabla-listado">
		
		<thead>
			
			<tr>
				<th class="listado-th">Id Servicio</th>
				<th class="listado-th">Codigo ATR</th>
				<th class="listado-th">Descripción</th>
				<th class="listado-th">Comentarios</th>
				<th class="listado-th">Fecha Creación</th>
                <th class="listado-th">Creado Por</th>
                <th class="listado-th">Estado</th>
                <th class="listado-th">Modificar</th>
				<th class="listado-th">Eliminar</th>

			</tr>

		</thead>

		<tbody>
			
			<?php

			$vistaUsuario = new MvcController();
			$respuesta = $vistaUsuario -> vistaServiciosAtrTablaController();

            foreach($respuesta as $row => $item){
                echo'<tr>
                        <td>'.$item["id_servicio"].'</td>
                        <td>'.$item["codigo_atr_serv"].'</td>
                        <td>'.$item["descripcion_serv"].'</td>
                        <td>'.$item["comentarios_serv"].'</td>
                        <td>'.$item["fecha_creacion_serv"].'</td>
                        <td>'.$item["usuario"].'</td>
                        <td>'.$item["estado_serv"].'</td>
                        <td><a href="index.php?action=ServiciosAtr/editarServicioAtr&id_servicio_editar='.$item["id_servicio"].'"><img src="/views/img/editar.png" class="img-25"></img></a></td>
                        <td><a href="index.php?action=ServiciosAtr/listadoServiciosAtr&id_servicio_Borrar='.$item["id_servicio"].'"><img src="/views/img/eliminar.png" class="img25"></img></a></td>
                    </tr>';
                }
			$vistaUsuario -> borrarServicioAtrController();
            
			?>

		</tbody>

	</table>
    </div>