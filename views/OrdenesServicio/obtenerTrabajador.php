<?php

require_once "../../../models/conexion.php";

class Datos extends Conexion{
    public static function obtenerTrabajador($tabla, $id_dpto_u){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_dpto_u = :id_dpto_u");	
        $stmt->bindParam(":id_dpto_u", $id_dpto_u, PDO::PARAM_INT);
        $stmt->execute();
        #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
        return $stmt->fetchAll();
        $stmt->close();
    }
}

$id_dpto_serv = $_POST['id_dpto_serv'];

$respuesta = Datos::obtenerTrabajador('usuarios', $id_dpto_serv);
echo"<option value='0' selected disabled>Selecciona una trabajador ... </option>";
foreach($respuesta as $row => $item){
        echo"<option value='". $item['id_usuario']."'>".$item['usuario']." - ".$item['ape_pat_u']. " " . $item['ape_mat_u']. " " . $item['nombre_u']."</option>";
}

?>