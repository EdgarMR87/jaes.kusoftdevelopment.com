<?php 
    		$vistaUsuario = new MvcController();
    		$respuesta = $vistaUsuario -> editarUsuarioController();
	    	$date = date_create($respuesta["fecha_creacion_usuario"]);
    		$fecha = date_format($date, 'Y-m-d');
?>
<div class="tablas-listado" id="contenido">
    <h1>EDITAR USUARIO : <?php echo $respuesta['id_usuario']; ?></h1>
    <form method="post">
		<table class="tabla-alta">		
			<tr>
	            <td class="derecha"><p>Nombre(s) : </p></td>
    	        <td>
				<input type="hidden" name="id_usuario_m" value="<?php echo $respuesta['id_usuario']; ?>">
					<input type="text" value="<?php echo $respuesta['nombre_u']; ?>" name="nombre_u_m" required>
				</td>
			</tr>
			<tr>
	            <td class="derecha"><p>Apellido Paterno : </p></td>
    	        <td>
					<input type="text" value="<?php echo $respuesta['ape_pat_u']; ?>" name="ape_pat_u_m" required>
				</td>
			</tr>
			<tr>
        	    <td class="derecha"><p>Apellido Materno : </p></td>
            	<td>
					<input type="text" value="<?php echo $respuesta['ape_mat_u']; ?>" name="ape_mat_u_m" required>
				</td>
			</tr>
			<tr>
            	<td class="derecha"><p>Usuario : </p></td>
            	<td>
					<input type="text" value="<?php echo $respuesta['usuario']; ?>" name="usuario_m" required>
				</td>
			</tr>	
			<tr>
    	        <td class="derecha"><p>Contraseña : </p></td>
        	    <td>
					<input type="password" value="<?php echo $respuesta['contrasena']; ?>" name="contrasena_m" required>
				</td>
			</tr>
			<tr>
				<td class="derecha"><p>Departamento : </p></td>
            	<td>
					<select name="departamento_m" id="departamento" required>
						<option value="" selected disabled>Selecciona un Departamento ... </option>
						<?php
							$vistaUsuario = new MvcController();
							$vistaUsuario -> vistaDepartamentosSelectedController($respuesta['id_dpto_u']);
						?>
					</select>
				</td>
			</tr>
			<tr>
	            <td class="derecha"><p>Puesto : </p></td>
    	        <td>
					<select name="puesto_m" id="puesto" required>
						<option value="" selected disabled>Selecciona un Puesto ... </option>
						<?php
							$vistaUsuario = new MvcController();
							$vistaUsuario -> vistaPuestosSelectedController($respuesta['id_dpto_u'], $respuesta['id_puesto_u']);
						?>
					</select>
				</td>
			</tr>
			<tr>
	            <td class="derecha"><p>Puesto : </p></td>
    	        <td>
					<select name="estado_m" id="estado" required>
						<option value="" selected disabled>Selecciona un status ... </option>
						<?php
							if($respuesta['estado_u'] == "activo"){
								echo "<option value='activo' selected>Activo</option>
										<option value='baja'>Baja</option>";
							} else if($respuesta['estado_u'] == "baja"){
								echo "<option value='activo'>Activo</option>
										<option value='baja' selected>Baja</option>";
							}
						?>
					</select>
				</td>
			</tr>
            <tr>
                <td class="derecha"><p>Salario : </p></td>
                <td>
					<input type="number" step=".10" placeholder="0000.00" value="<?php echo $respuesta['salario_usuario']; ?>" name="salario_usuario">
			    </td>
            </tr>
            <tr>
                <td class="derecha"><p>Lugar de Trabajo : </p></td>
                <td>
                    <select name="lugar_trabajo" id="lugar_trabajo">
                        <?php 
                        if($respuesta['lugar_trabajo'] == "ATR"){
                            echo "<option value='ATR' SELECTED>ATR</option>
                                    <option value='JAES'>JAES</option>";
                        }elseif($respuesta['lugar_trabajo'] == "JAES"){
                            echo "<option value='ATR'>ATR</option>
                            <option value='JAES' SELECTED>JAES</option>";
                        }else{
                            echo "<option value='0'>Selecciona un lugar de trabajo ... </option>
                            <option value='ATR'>ATR</option>
                            <option value='JAES'>JAES</option>";
                        }                     
                        ?>
                    </select>
			    </td>
            </tr>
		</table>
		<input class="btn-actualizar" type="submit" value="Actualizar">
	</form>
	<?php  $vistaUsuario -> actualizarUsuarioController(); ?>
</div>