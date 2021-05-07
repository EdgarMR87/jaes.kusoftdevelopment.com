<div class="tablas-listado" id="contenido">
    <h1>EDITAR DEPARTAMENTO</h1>
    <form method="post">
    <?php 
    $vistaUsuario = new MvcController();
    $respuesta = $vistaUsuario -> editarDptoController();
    $date = date_create($respuesta["fecha_creacion_dpto"]);
    $fecha = date_format($date, 'Y-m-d');
    echo "<form method='post'>
            <table class='tabla-alta'>
		        <tr>
                    <td class='derecha'><p>Nombre : </p></td>
                    <td>
                    <input type='hidden' name='id_dpto_modif' value='".$respuesta['id_departamento']."'>
                    <input type='text' value='".$respuesta["nombre_dpto"]."' name='nombre_dpto_modif' required>
                    </td>
                </tr>
                <tr>
                    <td class='derecha'><p>Descripción  : </p></td>
                    <td>
                        <input type='text' value='".$respuesta["descripcion_dpto"]."' name='descripcion_dpto_modif' required>
                    </td>
                </tr>
                <tr>
                    <td class='derecha'><p>Fecha Creación : </p></td>
                    <td><input type='date' value='". $fecha . "' name='fecha_creacion_dpto' disabled></td>
                <tr>
            </table>
	        <input class='btn-registrar' type='submit' value='Enviar'>
    
        </form>";
    $vistaUsuario -> actualizarDptoController();
    ?>
    </form>
</div>