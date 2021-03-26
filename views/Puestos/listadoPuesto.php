<div class="tablas-listado" id="contenido">
	<h1>Listado Puestos</h1>

	<table class="tabla-listado">
		
		<thead>
			
			<tr>
				<th class="listado-th">Id Puesto</th>
				<th class="listado-th">Nombre</th>
				<th class="listado-th">Descripcion</th>
				<th class="listado-th">Departamento</th>
				<th class="listado-th">Fecha Creación</th>
                <th class="listado-th">Modificar</th>
				<th class="listado-th">Eliminar</th>

			</tr>

		</thead>

		<tbody>
			
			<?php

			$vistaUsuario = new MvcController();
			$vistaUsuario -> vistaPuestoTablaController();
			$vistaUsuario -> borrarPuestoController();

			?>

		</tbody>

	</table>
</div>
<?php

if(isset($_GET["action"])){

	if($_GET["action"] == "cambio"){

		echo "Cambio Exitoso";
	
	}

}

?>


