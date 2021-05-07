<?php

require_once "../../../models/conexion.php";

class Datos extends Conexion{
    public static function obtenerTrabajador($tabla, $id_dpto_u){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_dpto_u = :id_dpto_u ORDER BY nombre_u ASC");	
        $stmt->bindParam(":id_dpto_u", $id_dpto_u, PDO::PARAM_INT);
        $stmt->execute();
        #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
        return $stmt->fetchAll();
        $stmt->close();
    }
    public static function obtenerTrabajadorMecanicaSuspenciones($tabla){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_dpto_u IN('21','27','29') ORDER BY nombre_u ASC");
        $stmt->execute();
        #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement.
        return $stmt->fetchAll();
        $stmt->close();
    }
}

$id_dpto_serv = $_POST['id_dpto_serv'];

if($id_dpto_serv == 21 || $id_dpto_serv == 27){
    $respuesta = Datos::obtenerTrabajadorMecanicaSuspenciones('usuarios', $id_dpto_serv);
    echo"<option value='0' selected disabled>Selecciona una trabajador ... </option>";
    foreach($respuesta as $row => $item){
        echo"<option value='". $item['id_usuario']."'>".$item['nombre_u']. " " . $item['ape_pat_u']. " " . $item['ape_mat_u']."</option>";
    }
}else{
    $respuesta = Datos::obtenerTrabajador('usuarios', $id_dpto_serv);
    echo"<option value='0' selected disabled>Selecciona una trabajador ... </option>";
    foreach($respuesta as $row => $item){
        echo"<option value='". $item['id_usuario']."'>".$item['nombre_u']. " " . $item['ape_pat_u']. " " . $item['ape_mat_u']."</option>";
    }
}


?>