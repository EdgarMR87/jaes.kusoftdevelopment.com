<script>
function clickactionEliminar( b ){
    document.getElementById('id_eliminar').value = b.id; 
    document.getElementById('dato_eliminar').innerHTML = b.dataset.name + "?";
}
</script>

<div class="tablas-listado" id="contenido">
    <div class="new-flotante">
        <a href="index.php?action=Procesos/registrarProcesoGeneral">
            <img src="/views/img/new_Flotante.png" alt="">
        </a>
    </div>
    <h1>Listado Procesos General</h1>
	    <table class="tabla-listado">		
		    <thead>
			<tr>
				<th class="listado-th">Id Proceso General</th>
				<th class="listado-th">Descripción Proceso</th>
				<th class="listado-th">Comentarios</th>
                <th class="listado-th">Modificar</th>
				<th class="listado-th">Eliminar</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$vistaUsuario = new MvcController();
			$respuesta = $vistaUsuario -> vistaProcesosGeneralController();
            foreach($respuesta as $row => $item){
                echo'<tr>
                <td>'. $item["id_proceso_general"]. '</td>
                <td>'. utf8_encode($item["descripcion_proceso_general"]) .'</td>
                <td>'. utf8_encode($item["comentarios_proceso_general"]) .'</td>
                <td><a href="index.php?action=Procesos/editarProcesoGral&id_proceso_general=' .$item["id_proceso_general"].'"><img src="/views/img/editar.png" class="img-25"></img></a></td>
                <td>
                    <a href="#openModalEliminar" onclick="clickactionEliminar(this)" id="' .$item["id_proceso_general"].'" data-name="'.$item["descripcion_proceso_general"].'">
                        <img src="/views/img/eliminar.png" class="img-25"></img>
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
                <input type="hidden" name="id_proceso_gral_eliminar" id="id_eliminar">
                <h1>ELIMINAR PROCESO GRAL</h1>
                <table>
                    <tr>
                        <td>
                            <div class="en-linea">
                                <p>¿Deseas Eliminar el Proceso General  : &nbsp;<h2 id="dato_eliminar"></h2></p>
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
            $vistaUsuario -> borrarProcesoGeneralController();
        ?>
    </form>
    </div>
    