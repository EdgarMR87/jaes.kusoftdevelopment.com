<script>

    function pregunta(){
        swal({
            title: "Registro Exitoso!",
            text: "Redireccionando en 2 segundos...",
            type: "success",
            timer: 2000,
            showConfirmButton: false
        }, function(){
            window.location = "index.php?action=Usuarios/registro";
            });
    } 

    function errorRegistro(texto){
        swal({
            title: texto,
            text: "Revisa que no se dupliquen los valores",
            type: "error",
            timer: 2000,
            showConfirmButton: false
        }, function(){
            window.location = "index.php?action=Usuarios/registro";
        });
    }


</script>

<?php 
	ob_start();  
    if($_SESSION["autentificado"]!="SI"){
    //si no está logueado lo envío a la página de autentificación
        echo "<script>
                    alert('No haz iniciado sesión');
                    window.location.href = 'https://jaes.kusoftdevelopment.com/'; 
              </script>";
    }else{
    ?>


<div class="tablas-listado" id="contenido">
<h1>REGISTRO DE USUARIO</h1>

<form method="post">
	<table class="tabla-alta">
		<tr>
            <td class="derecha"><p>Nombre(s) : </p></td>
            <td>
				<input class="mayusculas" type="text" placeholder="Nombre(s)" name="nombre_u" required>
			</td>
		</tr>
		<tr>
            <td class="derecha"><p>Apellido Paterno : </p></td>
            <td>
				<input class="mayusculas" type="text" placeholder="Apellido Paterno" name="ape_pat_u" required>
			</td>
		</tr>
		<tr>
            <td class="derecha"><p>Apellido Materno : </p></td>
            <td>
				<input class="mayusculas" type="text" placeholder="Apellido Paterno" name="ape_mat_u" required>
			</td>
		</tr>
		<tr>
            <td class="derecha"><p>Usuario : </p></td>
            <td>
				<input type="text" placeholder="Usuario" name="usuario" required>
			</td>
		</tr>	
		<tr>
            <td class="derecha"><p>Contraseña : </p></td>
            <td>
				<input type="password" placeholder="Contraseña" name="contrasena" maxlength="6" required>
			</td>
		</tr>
		<tr>
			<td class="derecha"><p>Departamento : </p></td>
            <td>
				<select name="departamento" id="departamento" required>
					<option value="" selected disabled>Selecciona un Departamento ... </option>
					<?php
						$vistaUsuario = new MvcController();
						$vistaUsuario -> vistaDEpartamentosController();
					?>
				</select>
			</td>
		</tr>
		<tr>
            <td class="derecha"><p>Puesto : </p></td>
            <td>
				<select name="puesto" id="puesto" required>
					<option value="" selected disabled>Selecciona un Puesto ... </option>
				</select>
			</td>
		</tr>
		</table>
		<input class="btn-registrar" type="submit" value="Registrar">
	</form>

<?php

$registro = new MvcController();
$resultado = $registro -> registroUsuarioController();
$error = str_replace("'", "", $resultado);

if(isset($resultado)){
    if($resultado == "success"){
        echo "<script>pregunta();</script>";
    }else{
        echo "<script>errorRegistro('".$error."');</script>";
    }
}else{}

?>
</div>
<?php
	}ob_end_flush();
	?>