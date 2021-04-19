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
                        <td>'.$item["fecha_checklist"].'</td>
                        <td>'.$item["nombreCompleto"].'</td>
                        <td><a href="index.php?action=CheckLists/detalleCheckList&id_checklist_editar='.$item["id_checklist"].'">'.$item["unidad_mazda"].'</a></td>
                        <td>'.$item["kilometraje"].'</td>
                        <td>'.$item["observaciones"].'</td>
                        <td>
                            <a href="index.php?action=OrdenesServicio/editarOS&id_os_editar='.$item["id_checklist"].'">
                                <img src="/views/img/editar.png" class="img-25"></img>
                            </a>
                        </td>
                        <td>
                            <a href="#openModalEliminar" onclick="clickactionEliminar(this)" id="'.$item["id_checklist"].'">
                                <img src="/views/img/eliminar.png" class="img-25"></img>
                            </a>
                        </td>
                        <td>
                            <a href="#" onclick="" id="'.$item["id_checklist"].'">
                                <img src="/views/img/Imprimir.png" class="img-25"></img>
                            </a>
                        </td>
                    </tr>';
            }
			?>
		</tbody>
	</table>
</div>