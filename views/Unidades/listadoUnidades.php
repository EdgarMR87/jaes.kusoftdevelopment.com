<div class="tablas-listado" id="contenido">
<h1>Listado Unidades</h1>
	<table class="tabla-listado">
		<thead>
			<tr>
				<th class="listado-th">Id Unidad</th>
				<th class="listado-th"># Unidad</th>
				<th class="listado-th">Modelo</th>
				<th class="listado-th">Fecha Creación</th>
				<th class="listado-th">Creado Por : </th>
                <th class="listado-th">Estado</th>
                <th class="listado-th">Modificar</th>
				<th class="listado-th">Eliminar</th>
			</tr>
		</thead>
		<tbody>
			<?php

            ini_set('display_errors', '1');
            ini_set('error_reporting', E_ALL);
			$vistaUsuario = new MvcController();
			$respuesta =  $vistaUsuario -> vistaUnidadesTablaController();
            foreach($respuesta as $row => $item){
                echo'<tr>
                        <td>'.$item["id_unidad"].'</td>
                        <td>'.$item["num_unidad"].'</td>
                        <td>'.$item["modelo"].'</td>
                        <td>'.$item["fecha_creacion"].'</td>
                        <td>'.$item["usuario"].'</td>
                        <td>'.$item["estado"].'</td>
                        <td><a href="index.php?action=Unidades/editarUnidad&id_unidad_editar='.$item["id_unidad"].'"><img src="/views/img/editar.png" class="img-25"></img></a></td>
                        <td><a href="index.php?action=Unidades/listadoUnidades&id_unidad_borrar='.$item["id_unidad"].'"><img src="/views/img/eliminar.png" class="img25"></img></a></td>
                    </tr>';
            }
			$vistaUsuario -> borrarUnidadController();
            
			?>
		</tbody>

	</table>
</div>