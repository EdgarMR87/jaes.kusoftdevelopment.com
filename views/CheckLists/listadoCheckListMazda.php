<script>
function clickactionEliminar( b ){
    document.getElementById('id_os_borrar').value = b.id; 
    document.getElementById('os').innerHTML = b.id + "?";
}

</script>
<div class="tablas-listado" id="contenido">
    <div class="new-flotante">
        <a href="index.php?action=CheckLists/altaCheckListMazda">
            <img src="/views/img/new_Flotante.png" alt="">
        </a>
    </div>
    <h1>Listado Checklist Mazda</h1>
	<table class="tabla-listado" id="listado-os">	
		<thead>	
			<tr>
				<th class="num_orden">Id Checklist</th>
				<th class="listado-th">Fecha</th>
				<th class="listado-th">Usuario</th>
				<th class="listado-th">Unidad</th>
				<th class="listado-th">Kilometraje</th>
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
                        <td>
                            <a href="index.php?action=CheckLists/editarCheckList&id_checklist_editar='.$item["id_checklist"].'">
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

    <form action="" method="post">
    <!-- MODAL PARA FINALIZAR SERVICIO -->
    <div id="openModalEliminar" class="modalDialog">
    	    <div class="preguntar">
                <a href="#close" title="Close" class="close">X</a>
                <input type="hidden" name="id_checklist_borrar" id="id_os_borrar">
                <h1>ELIMINAR CHECKLIST Y PARTIDAS</h1>
                <table>
                    <tr>
                        <td> 
                            <div class="en-linea">
                                <p>¿Deseas Eliminar el CheckList y sus partidas : &nbsp;<h2 id="os"></h2></p>
                            </div>
                        </td>
                        <td>
                            <input class="btn-eliminar" type="submit" value="ELIMINAR">
                        </td>  
                    </tr>
                </table>
	        </div>
        </div>
        <!-- TERMINA EL MODAL PARA ELIMINAR EL CHECKLIST -->
        <?php
        $vistaUsuario = new MvcController();
        $vistaUsuario -> borrarChecklistController();
        ?>
    </form>
</div>