<script>
function clickactionEliminar( b ){
    document.getElementById('id_unidad_borrar').value = b.id; 
    document.getElementById('id_eliminar').innerHTML = b.dataset.name + "?";
}
</script>

<div class="tablas-listado" id="contenido">
    <div class="new-flotante">
        <a href="index.php?action=Unidades/altaUnidad">
            <img src="/views/img/new_Flotante.png" alt="">
        </a>
    </div>
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
                        <td>
                            <a href="#openModalEliminar" onclick="clickactionEliminar(this)" id="'.$item["id_unidad"].'" data-name="'.$item["num_unidad"].'">
                                <img src="/views/img/eliminar.png" class="img-25"></img>
                            </a>
                        </td>
                    </tr>';
            }
			?>
		</tbody>
	</table>
</div>



<form action="" method="post">
    <div id="openModalEliminar" class="modalDialog">
    	<div class="preguntar">
            <a href="#close" title="Close" class="close">X</a>
            <input type="hidden" name="id_unidad_borrar" id="id_unidad_borrar">
            <h1>ELIMINAR UNIDAD</h1>
            <img src="/views/img/warning.png">
            <table class="tabla-div-modal">
                <tr>
                    <td> 
                        <div class="en-linea">
                            <p>¿Deseas Eliminar la unidad : &nbsp;</p>
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
    $vistaUsuario -> borrarUnidadController();
?>
</form>