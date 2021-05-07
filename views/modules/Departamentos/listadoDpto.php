<div class="tablas-listado" id="contenido">
    <div class="new-flotante">
        <a href="index.php?action=Departamentos/registro_dpto">
            <img src="/views/img/new_Flotante.png" alt="">
        </a>
    </div>
    <h1>Listado Departamentos</h1>
	<table class="tabla-listado">
		<thead>
			<tr>
				<th class="listado-th">Id Dpto</th>
				<th class="listado-th">Nombre</th>
				<th class="listado-th">Descripcion</th>
				<th class="listado-th">Modificar</th>
				<th class="listado-th">Eliiminar</th>
			</tr>
		</thead>
		<tbody>			
			<?php
			    $vistaUsuario = new MvcController();
			    $vistaUsuario -> vistaDepartamentosTablaController();
			    $vistaUsuario -> borrarDepartamentoController();
			?>
		</tbody>
	</table>
</div>