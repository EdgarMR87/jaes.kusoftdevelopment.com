<?php

require_once "../../../models/conexion.php";

class Datos extends Conexion{
    public static function eliminar_partida_os($tabla, $id_partida_eliminar){
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_partida_os = :id_partida_os AND estado_partida_os = 'PENDIENTE'");	
        $stmt->bindParam(":id_partida_os", $id_partida_eliminar, PDO::PARAM_INT);
        if($stmt->execute()){
            return "success";
        }else{
            $error = $stmt->errorInfo();
            return $error;
        }
        $stmt->close();
    }
}

$id_partida_eliminar = $_POST['id_partida_os'];
$tabla = 'partidas_os';

$respuesta = Datos::eliminar_partida_os($num_orden_post, $estado_partida_os_post);
if($respuesta == "success"){
    echo '<script>
    borrarpartidaOk('."'".$link."'".');
    </script>';
}else{
    $valor = $respuesta[2];
    $error = str_replace("'", "", $valor);
    echo '<script>
            var x = document.getElementById("openModalEliminar");
            x.style.display = "none";              
            errorRegistro('."'".$error."','".$link."'".');
    </script>';
}
?>