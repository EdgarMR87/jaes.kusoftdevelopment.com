<?php
require_once "../../../models/conexion.php";

class Datos extends Conexion{
    public static function validarOS($num_orden){
        $stmt = Conexion::conectar()->prepare("SELECT num_orden FROM ordenServicio WHERE num_orden = :num_orden");	
        $stmt->bindParam(":num_orden", $num_orden, PDO::PARAM_INT);
        $stmt->execute();
        #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
        return $stmt->fetchAll();
        $stmt->close();
    }
}

$num_orden = $_POST['num_orden'];
$respuesta = Datos::validarOS($num_orden);
foreach($respuesta as $row => $item){
    echo $item["num_orden"];
}

?>