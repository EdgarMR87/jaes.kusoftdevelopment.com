<script>

$(document).ready(function(){
    $("#campo_buscado").on('change', function(){
        let td = document.getElementById("valor_buscado");
        var campo = $(this).val();
        switch (campo){
            case "id_unidad_servicio":
                td.innerHTML = "<input name='valor_buscado_text' type='text' placeholder='Indica la unidad a buscar ... '>"; 
            break;
            case "fecha_orden":
                td.innerHTML = "<input name='valor_buscado_text' type='date'>"; 
            break;
            case "estado":
                td.innerHTML = "<select name='valor_buscado_text'>"+
                                    "<option value='0' disabled selected>Selecciona un Estado ... </option>" +
                                    "<option value='PENDIENTE'>PENDIENTE</option>" +
                                    "<option value='ENPROCESO'>EN PROCESO</option>" +
                                    "<option value='TERMINADO'>TERMINADO</option>" +
                                    "<option value='LIBERADO'>LIBERADO</option>" +
                                    "<option value='CANCELADO'>CANCELADO</option>" +
                                "</select>"; 
            break;
        }
    });
})

</script>

<div class="tablas-listado" id="contenido">
    <div class="new-flotante">
        <a href="index.php?action=OrdenesServicio/altaOrdenS">
            <img src="/views/img/new_Flotante.png" alt="">
        </a>
    </div>
    <h1>Historial Ordenes de Servicio</h1>
        <form class="form-busqueda" action="" method="post">
        <table class="busqueda">    
            <tr>
                <td class="titulo">
                    <span>Criterio Busqueda :</span>
                </td>
                <td class="input">    
                    <select name="campo_buscado" id="campo_buscado">
                        <option value="0">Selecciona un criterio de busqueda ... </option>
                        <option value="id_unidad_servicio">Unidad</option>
                        <option value="fecha_orden">Fecha Orden</option>
                        <option value="estado">Estado</option>
                    </select>
                </td>
                <td class="titulo">
                    <span>Valor buscado :</span>
                </td>
                <td class="input" id="valor_buscado">
                </td>
                <td>
                    <input type="submit" name="btn-buscar" value="Buscar" class="btn-buscar">
                </td>
            </tr>
        </table>
       

        <table class="tabla-listado" id="listado-os">	
		<thead>	
			<tr>
				<th class="num_orden"># ORDEN</th>
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
                <th class="listado-th">Imprimir</th>
			</tr>
		</thead>
		<tbody>

			<?php
              ini_set('display_errors', '1');
              ini_set('error_reporting', E_ALL);
			$vistaUsuario = new MvcController();
			$respuesta = $vistaUsuario -> vistaOSAtrTablaBusquedaController();
            foreach($respuesta as $row => $item){
                echo'<tr>
                        <td class="num_orden">'.$item["num_orden"].'</td>
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
    </form>

</div>