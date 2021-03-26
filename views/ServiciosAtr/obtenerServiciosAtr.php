<?php

require_once "../../../models/conexion.php";

class Datos extends Conexion{
    public static function obtenerServiciosATR(){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM servicios_atr ORDER BY codigo_atr_serv ASC");	
        $stmt->execute();
        #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
        return $stmt->fetchAll();
        $stmt->close();
    }
}

$respuesta = Datos::obtenerServiciosATR();

foreach($respuesta as $row => $item){
    echo "<option value='". $item['codigo_atr_serv']."' data-name='".$item['descripcion_serv']."'>".$item['codigo_atr_serv']."</option>";
}

?>