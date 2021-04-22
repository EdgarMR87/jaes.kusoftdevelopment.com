
<div class="tablas-listado" id="contenido">
    <div class="new-flotante">
        <a href="index.php?action=OrdenesServicio/altaOrdenS">
            <img src="/views/img/new_Flotante.png" alt="">
        </a>
    </div>
    <h1>Costo Mano de Obra Directa</h1>
        <form class="form-busqueda" action="" method="post">
        <table class="busqueda">    
            <tr>
                <td class="titulo">
                    <p>Orden de Servicio a buscar : </p>
                </td>
                <td class="input" id="valor_buscado">
                    <input type="number" name="os_buscar" id="os_buscar" min="1">
                </td>
                <td>
                    <input type="submit" name="btn-buscar" value="Buscar" class="btn-buscar">
                </td>
            </tr>
        </table>
        </form>
        <table class="tabla-listado" id="listado-os">	
		<thead>	
			<tr>
				<th class="num_orden">Orden Servicio</th>
				<th class="listado-th">Descripcion Servicio</th>
				<th class="listado-th">Trabajo Realizado</th>
				<th class="listado-th">Fecha/Hora Inicio</th>
				<th class="listado-th">Fecha/Hora Termino</th>
                <th class="listado-th">Realizado Por</th>
                <th class="listado-th">Salario x Minuto</th>
                <th class="listado-th">Minutos Trabajados</th>
                <th class="listado-th">Precio Mano de Obra</th>
			</tr>
		</thead>
		<tbody>

			<?php
              ini_set('display_errors', '1');
              ini_set('error_reporting', E_ALL);
			$vistaUsuario = new MvcController();
			$respuesta = $vistaUsuario -> obtenerPartidaOSXOSController();
            if(isset($respuesta)){
                foreach($respuesta as $row => $item){
                    echo'<tr>
                        <td>'.$item["descripcion_serv"].'</td>
                        <td>'.$item["descripcion_serv"].'</td>
                        <td>'.$item["observaciones_os"].'</td>
                        <td>'.$item["fecha_asignacion"].'</td>
                        <td>'.$item["fecha_termino"].'</td>
                        <td>'.$item["nombre_u"].'</td>
                        <td>'.$item["salario_minuto"].'</td>
                        <td>'.$item["tiempo_diferencia"].'</td>
                    </tr>';
                }
            }			
			?>
		</tbody>
	</table>
</div>