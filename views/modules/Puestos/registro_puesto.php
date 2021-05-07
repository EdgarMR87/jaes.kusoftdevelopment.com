<script>
    function pregunta(){
        swal({
            title: "Registro Exitoso!",
            text: "Redireccionando en 2 segundos...",
            type: "success",
            timer: 2000,
            showConfirmButton: false
        }, function(){
            window.location = "index.php?action=Puestos/listadoPuesto";
            });
    } 

    function errorRegistro(texto){
        swal({
            title: texto,
            text: "Registro incorrecto",
            type: "error",
            timer: 2000,
            showConfirmButton: false
        }, function(){
            window.location = "index.php?action=Puestos/listadoPuesto";
        });
    }

</script>

<div class="tablas-listado" id="contenido">
    <h1>REGISTRO PUESTO</h1>
    <form method="post">
        <table class="tabla-alta">
		    <tr>
                <td class="derecha"><p>Nombre : </p></td>
                <td>
	                <input class="mayusculas" type="text" placeholder="Nombre del Puesto" name="nombre_puesto" required>
                </td>
            </tr>
            <tr>
                <td class="derecha"><p>Descripción: </p></td>
                <td>
                    <input class="mayusculas" type="text" placeholder="Descripcion del Puesto" name="descripcion_puesto">
                </td>
            </tr>
		    <tr>
                <td class="derecha"><p>Departamento : </p></td>
                <td>
                    <select name="id_departamento_puesto" id="id_departamento_puesto">
	                <?php
	                    $vistaUsuario = new MvcController();
		                $vistaUsuario -> vistaDepartamentosController();		
	                ?>
	                </select>
                </td>
            </tr>
        </table>
	    <input class="btn-registrar" type="submit" value="Registrar">
    </form>
<?php

$registro = new MvcController();
$resultado = $registro -> registroPuestoController();
  

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