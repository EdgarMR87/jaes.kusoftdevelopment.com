<div class="tablas-listado" id="contenido">
    <h1>EDITAR PUESTO</h1>
    <form method="post">
    <?php 
    $vistaUsuario = new MvcController();
    $respuesta = $vistaUsuario -> editarPuestoController();
    $date = date_create($respuesta["fecha_creacion_puesto"]);
    $fecha = date_format($date, 'Y-m-d');
    echo "<form method='post'>
            <table class='tabla-alta'>
		        <tr>
                    <td class='derecha'><p>Nombre : </p></td>
                    <td>
                    <input type='hidden' name='id_puesto_modif' value='".$respuesta['id_puesto']."'>
                    <input type='text' value='".$respuesta["nombre_puesto"]."' name='nombre_puesto_modif' required>
                    </td>
                </tr>
                <tr>
                    <td class='derecha'><p>Descripción  : </p></td>
                    <td>
                        <input type='text' value='".$respuesta["descripcion_puesto"]."' name='descripcion_puesto_modif' required>
                    </td>
                </tr>
                <tr>
                    <td class='derecha'><p>Departamento : </p></td>
                        <td>
                        <select name='id_departamento_puesto_modif' id='id_departamento_puesto'>";
		                    $vistaUsuario -> vistaDepartamentosSelectedController($respuesta["id_departamento_puesto"]);	
    echo "              </select>
                     </td>
                </tr>
                <tr>
                    <td class='derecha'><p>Fecha Creación : </p></td>
                    <td><input type='date' value='". $fecha . "' name='fecha_creacion_dpto' disabled></td>
                <tr>
            </table>
	        <input class='btn-registrar' type='submit' value='Enviar'>
    
        </form>";
    $vistaUsuario -> actualizarPuestoController();
    ?>
    </form>
</div>