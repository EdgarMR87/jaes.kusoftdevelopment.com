<?php

require_once "../../../models/conexion.php";

class Datos extends Conexion{
    public static function obtenerOrdenesServicio($tabla, $id_unidad_servicio){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_unidad_servicio = :id_unidad_servicio
                ORDER BY num_orden ASC");	
        $stmt->bindParam(":id_unidad_servicio", $id_unidad_servicio, PDO::PARAM_INT);
        $stmt->execute();
        #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
        return $stmt->fetchAll();
        $stmt->close();
    }
}

$id_unidad_servicio = $_POST['id_unidad_servicio'];
$respuesta = Datos::obtenerOrdenesServicio('ordenServicio', $id_unidad_servicio);
echo"<option value='0' selected disabled>Selecciona una OS ... </option>";
foreach($respuesta as $row => $item){
    echo"<option value='". $item['num_orden']."'>".$item['num_orden']."</option>";
}

?>