<script>
function clickactionEliminar( b ){
    document.getElementById('id_eliminar').value = b.id; 
    document.getElementById('dato_eliminar').innerHTML = b.dataset.name + "?";
}
</script>

<div class="tablas-listado" id="contenido">
    <div class="new-flotante">
        <a href="index.php?action=Procesos/registrarProceso">
            <img src="/views/img/new_Flotante.png" alt="">
        </a>
    </div>
    <h1>Listado Clientes</h1>
	    <table class="tabla-listado">		
		    <thead>
			<tr>
				<th class="listado-th">Id Cliente</th>
                <th class="listado-th">Razon Social</th>
				<th class="listado-th">Codigo Proyecto</th>
                <th class="listado-th">Estado</th>
                <th class="listado-th">Modificar</th>
				<th class="listado-th">Eliminar</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$vistaUsuario = new MvcController();
			$respuesta = $vistaUsuario -> vistaClientesController();
            foreach($respuesta as $row => $item){
                echo'<tr>
                <td>'. $item["id_cliente"] .'</td>
                <td>'. $item["razon_social_cliente"] .'</td>
                <td>'. $item["codigo_proyecto_cliente"] .'</td>               
                <td>'. $item["estado_cliente_proyecto"] .'</td>
                <td><a href="index.php?action=Procesos/editarProceso&id_proceso_editar='.$item["id_proceso_prod"].'"><img src="/views/img/editar.png" class="img-25"></img></a></td>
                <td>
                    <a href="#openModalEliminar" onclick="clickactionEliminar(this)" id="'.$item["id_proceso_prod"].'" data-name="'.$item["descripcion_proceso"].'">
                        <img src="/views/img/eliminar.png" class="img-25"></img>
                    </a>
                </td>
            </tr>';
            }
            ?>
            </tbody>
        </table> 
        
        <!-- MODAL PARA CONFIRMAR ELIMINAR -->
        <form action="" method="post">
        <div id="openModalEliminar" class="modalDialog">
    	    <div class="preguntar">
                <a href="#close" title="Close" class="close">X</a>
                <input type="hidden" name="id_proceso_eliminar" id="id_eliminar">
                <h1>ELIMINAR PROCESO</h1>
                <table>
                    <tr>
                        <td>
                            <div class="en-linea">
                                <p>¿Deseas Eliminar el Proceso : &nbsp;<h2 id="dato_eliminar"></h2></p>
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
            $vistaUsuario -> borrarProcesoController();
        ?>
        </form>
    </div>