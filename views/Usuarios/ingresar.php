<script>
function bienvenida(usuario){
    swal({
        title: "Acceso Exitoso!",
        text: "Bienvenido : " + usuario,
        type: "success",
        closeOnClickOutside: false,
        closeOnEsc: false,
        allowOutsideClick: false
    }).then(function(result) {
        if(result.value){
            window.location.href = "index.php?action=ok";
        }else{}
    });
}
</script>

<?php 
echo "<script> window.document.title = 'ACCESO JAES'</script>";
?>
<div class="padre">
<div class="principal">
        <img src="/views/img/jaeslogo.png" alt="" class="ico-login">
        <h1>ACCESO SISTEMA JAES</h1>
        <form method="POST" class="acceder">
            <table>
                <tr> 
                <td class="one">          
                    <span>Usuario : </span>
                </td>
                <td class="two">
                    <input name="usuario_r" type="text" class="input_form">
                </td>
                </tr>
                <tr>
                    <td class="one">
                        <span>Contraseña : </span>
                    </td>
                    <td class="two">
                        <input name="contrasena" type="password" class="input_form">
                    </td>
                </tr>
            </table>
            <input name="Ingresar" type="submit" value="Ingresar" class="acceso">
            <p><a href=""> ¿Olvidaste tu password?</a></p>
        </form>
    </div>
    </div>
<?php

require_once "controllers/controller.php";

$ingreso = new MvcController();
$respuesta = $ingreso -> ingresoUsuarioController();
$nombreCompleto = $_SESSION["nombreCompleto"]; 
if(isset($respuesta)){
    if($respuesta == "success"){
        echo "<script>
                    bienvenida('". $nombreCompleto ."');
            </script>";
    }
}

?>