<script>
function clickactionEliminar( b ){
    document.getElementById('id_servicio_borrar').value = b.id; 
    document.getElementById('id_eliminar').innerHTML = b.dataset.name + "?";
}
</script>

<div class="tablas-listado" id="contenido">
    <div class="new-flotante">
        <a href="index.php?action=ServiciosAtr/altaServicioAtr">
            <img src="/views/img/new_Flotante.png" alt="">
        </a>
    </div>
    <h1>Listado Servicios ATR</h1>
	    <table class="tabla-listado">		
		    <thead>
			<tr>
				<th class="listado-th">Id Servicio</th>
				<th class="listado-th">Codigo ATR</th>
				<th class="listado-th">Descripción</th>
				<th class="listado-th">Comentarios</th>
                <th class="listado-th">Dpto. Realiza</th>
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
            $letra2 = "";

            foreach($respuesta as $row => $item){
                $letra1 = substr($item["codigo_atr_serv"], 0, 1);
                if($letra1 != $letra2){
                    switch($letra1){
                        case "C":
                            echo "<tr class='border-titulo'><td colspan='10' class='titulo-servicio'>CARROCERIA</td></tr>";
                            break;
                        case "D":
                            echo "<tr class='border-titulo'><td colspan='10' class='titulo-servicio'>CARROCERIA</td></tr>";
                        break;
                        case "E":
                            echo "<tr class='border-titulo'><td colspan='10' class='titulo-servicio'>ELECTRICA</td></tr>";
                        break;
                        case "F":
                            echo "<tr class='border-titulo'><td colspan='10' class='titulo-servicio'>MECANICA FRENOS</td></tr>";
                        break;
                        case "H":
                            echo "<tr class='border-titulo'><td colspan='10' class='titulo-servicio'>HIDRAULICO</td></tr>";
                        break;
                        case "L":
                            echo "<tr class='border-titulo'><td colspan='10' class='titulo-servicio'>MECANICA LIQUIDOS</td></tr>";
                        break;
                        case "M":
                            echo "<tr class='border-titulo'><td colspan='10' class='titulo-servicio'>MECANICA MOTOR</td></tr>";
                        break;
                        case "N":
                            echo "<tr class='border-titulo'><td colspan='10' class='titulo-servicio'>LONAS</td></tr>";
                        break;
                        case "Q":
                            echo "<tr class='border-titulo'><td colspan='10' class='titulo-servicio'>MECANICA TREN MOTRIZ</td></tr>";
                        break;
                        case "S":
                            echo "<tr class='border-titulo'><td colspan='10' class='titulo-servicio'>SUSPENSION</td></tr>";
                        break;
                        case "T":
                            echo "<tr class='border-titulo'><td colspan='10' class='titulo-servicio'>MECANICA TREN MOTRIZ</td></tr>";
                        break;
                        case "X":
                            echo "<tr class='border-titulo'><td colspan='10' class='titulo-servicio'>AUXILIO</td></tr>";
                        break;
                        case "Y":
                            echo "<tr class='border-titulo'><td colspan='10' class='titulo-servicio'>LLANTAS</td></tr>";
                        break;
                        case "Z":
                            echo "<tr class='border-titulo'><td colspan='10' class='titulo-servicio'>SOLDADURA</td></tr>";
                        break;
                    }
                }
                echo'<tr>
                        <td>'.$item["id_servicio"].'</td>
                        <td>'.$item["codigo_atr_serv"].'</td>
                        <td>'. utf8_encode($item["descripcion_serv"]) .'</td>
                        <td>'.$item["comentarios_serv"].'</td>
                        <td>'.$item["nombre_dpto"].'</td>
                        <td>'.$item["fecha_creacion_serv"].'</td>
                        <td>'.$item["usuario"].'</td>
                        <td>'.$item["estado_serv"].'</td>
                        <td><a href="index.php?action=ServiciosAtr/editarServicioAtr&id_servicio_editar='.$item["id_servicio"].'"><img src="/views/img/editar.png" class="img-25"></img></a></td>
                        <td>
                            <a href="#openModalEliminar" onclick="clickactionEliminar(this)" id="'.$item["id_servicio"].'" data-name="'.$item["descripcion_serv"].'">                                <img src="/views/img/eliminar.png" class="img-25"></img>
                            </a>
                        </td>
                    </tr>';
                $letra2 = substr($item["codigo_atr_serv"], 0, 1);
            }
            
			?>
		</tbody>
	</table>
</div>


<form action="" method="post">
<div id="openModalEliminar" class="modalDialog">
    	    <div class="preguntar">
                <a href="#close" title="Close" class="close">X</a>
                <input type="hidden" name="id_servicio_borrar" id="id_servicio_borrar">
                <h1>ELIMINAR SERVICIOS</h1>
                <img src="/views/img/warning.png">
                <table class="tabla-div-modal">
                <tr>
                    <td> 
                        <div class="en-linea">
                            <p>¿Deseas Eliminar el servicio : &nbsp;</p>
                        </div>
                    </td>
                    <td>
                        <h2 id="id_eliminar"></h2>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input class="btn-eliminar" type="submit" value="ELIMINAR">
                    </td>  
                </tr>
            </table>
	        </div>
        </div>
<?php	
$vistaUsuario = new MvcController();
$vistaUsuario -> borrarServicioAtrController();
?>
</form>