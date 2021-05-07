<?php

include("conexionbd.php");

$consulta = "SELECT * FROM puesto WHERE id_departamento_puesto=". $_POST['id_departamento']. " ORDER BY nombre_puesto ASC";
if ($resultado = $con->query($consulta)) {  
    echo "<option value='' selected disabled>Selecciona un Puesto ... </option>";
    while ($fila = $resultado->fetch_assoc()) { 
        echo "<option value='" . $fila['id_puesto'] . "'>" .$fila['nombre_puesto'] ."</option>";
  }
    $resultado->close();
}
/* cerrar la conexi贸n */
$con->close();
?>