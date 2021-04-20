
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
				<th class="num_orden">ID CHECKLIST</th>
				<th class="listado-th">FECHA</th>
				<th class="listado-th">USUARIO</th>
				<th class="listado-th">UNIDAD</th>
				<th class="listado-th">KILOMETRAJE</th>
                <th class="listado-th">Kilometraje</th>
                <th class="listado-th">OBSERVACIONES</th>
                <th class="listado-th">Modificar</th>
				<th class="listado-th">Eliminar</th>
                <th class="listado-th">Imprimir</th>
			</tr>
		</thead>
		<tbody>
			<?php
              ini_set('display_errors', '1');
              ini_set('error_reporting', E_ALL);
			$vistaUsuario = new MvcController();
			$respuesta = $vistaUsuario -> vistaChecklistTablaController();
            foreach($respuesta as $row => $item){
                echo'<tr>
                        <td class="num_orden">'.$item["id_checklist"].'</td>
                        <td><a href="index.php?action=OrdenesServicio/detalleOS&id_os_editar='.$item["num_orden"].'">'.$item["id_unidad_servicio"].'</a></td>
                        <td>'.$item["fecha_checklist"].'</td>
                        <td>'.$item["nombreCompleto"].'</td>
                        <td>'.$item["unidad_mazda"].'</td>
                        <td>'.$item["kilometraje"].'</td>
                        <td>'.$item["observaciones"].'</td>
                        <td>'.$item["tipo_servicio"].'</td>
                        <td>'.$item["servicio_tiempo"].'</td>
                        <td>'.$item["fecha_creacion"].'</td>
                        <td>'.$item["nombre_completo"].'</td>
                        <td class='."'".$item["estado"]."'".'>'.$item["estado"].'</td>
                        <td>'.$item["avance_porcentaje"].'</td>
                        <td>
                            <a href="index.php?action=OrdenesServicio/editarOS&id_os_editar='.$item["num_orden"].'">
                                <img src="/views/img/editar.png" class="img-25"></img>
                            </a>
                        </td>
                        <td>
                            <a href="#openModalEliminar" onclick="clickactionEliminar(this)" id="'.$item["num_orden"].'">
                                <img src="/views/img/eliminar.png" class="img-25"></img>
                            </a>
                        </td>
                        <td>
                            <a href="#" onclick="" id="'.$item["impreso"].'">
                                <img src="/views/img/Imprimir.png" class="img-25"></img>
                            </a>
                        </td>
                    </tr>';
            }			
			?>
		</tbody>
	</table>