<?php

require_once "../../../models/conexion.php";

class Datos extends Conexion{
    public static function obtenerServiciosOS(){
        $stmt = Conexion::conectar()->prepare("SELECT id_partida_os, codigo_partida_os, descripcion_serv, comentarios_os, observaciones_os FROM partidas_os 
                            LEFT JOIN servicios_atr ON codigo_atr_serv = codigo_partida_os
                            WHERE num_orden_partida_os = :num_orden_partida_os AND
    estado_partida_os = 'ENPROCESO' ORDER BY id_partida_os ASC");	
        $stmt->bindParam(":num_orden_partida_os", $_POST['num_orden_finalizar'], PDO::PARAM_INT);
        $stmt->execute();
        #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
        return $stmt->fetchAll();
        $stmt->close();
    }
}

$respuesta = Datos::obtenerServiciosOS();

foreach($respuesta as $row => $item){
    echo "<option id='". $item['id_partida_os']."' value='". $item['id_partida_os']."'  data-observaciones='". $item['observaciones_os']."' data-comentarios='". $item['comentarios_os']."'>".$item['codigo_partida_os']. " " .$item['descripcion_serv']."</option>";
}





?>