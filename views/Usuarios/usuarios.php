

<div class="tablas-listado" id="contenido">
<h1>Listado Usuarios</h1>

	<table class="tabla-listado">
		
		<thead>
			
			<tr>
				<th class="listado-th">Id Usuario</th>
				<th class="listado-th">Nombre</th>
				<th class="listado-th">Ape Paterno</th>
				<th class="listado-th">Ape Materno</th>
				<th class="listado-th">Usuario</th>
				<th class="listado-th">Contraseña</th>
				<th class="listado-th">Departamento</th>
				<th class="listado-th">Puesto</th>
				<th class="listado-th">Estado</th>
				<th class="listado-th">Fecha Creación</th>
				<th class="listado-th">Modificar</th>
				<th class="listado-th">Eliminar</th>

			</tr>

		</thead>

		<tbody>
			
			<?php
           
            date_default_timezone_set('America/Mexico_City');
            session_start();
            if(isset($_SESSION["id_usuario"])){
                $vistaUsuario = new MvcController();
			    $vistaUsuario -> vistaUsuariosController();
			    $vistaUsuario -> borrarUsuarioController();
            }else{
                header("location:index.php?action=salir");
            }
            

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


