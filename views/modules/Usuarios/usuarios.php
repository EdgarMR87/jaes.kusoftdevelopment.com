<script>
    	$(document).ready(function(){
    $("#buscarTabla").keyup(function(){
            _this = this;
            // Show only matching TR, hide rest of them
            $.each($("#tabla-listado tbody tr"), function() {
                if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                $(this).hide();
                else
                $(this).show();
            });
        });
        });
</script>

<div class="tablas-listado" id="contenido">
    <h1>Listado Usuarios</h1>
    <table class="tabla-alta">
		<tr>
            <td class="derecha"><p>Buscar : </p></td>
            <td>
                <input type="search" name="buscarTabla" id="buscarTabla">
			</td>
		</tr>
    </table>
	<table class="tabla-listado" id="tabla-listado">
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
                <th class="listado-th">Salario</th>
                <th class="listado-th">Lugar Trabajo</th>
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
    
<div class="new-flotante">
        <a href="index.php?action=Usuarios/registro">
            <img src="/views/img/new_Flotante.png" alt="">
        </a>
</div>
</div>