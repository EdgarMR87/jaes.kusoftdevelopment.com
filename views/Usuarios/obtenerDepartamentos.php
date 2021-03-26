<?php
include('../models/conexion.php');
$consulta = "SELECT * FROM categorias";
if ($resultado = $con->query($consulta)) {  
    /* obtener el array de objetos */    
    echo "<option value=''>Selecciona una categoria .... </option>";
    while ($fila = $resultado->fetch_assoc()) { 
        echo "<option value='" . $fila['id_categoria'] . "'>" . $fila['descripcion'] . "</option>";
    }   
    /* liberar el conjunto de resultados */
    $resultado->close();
}
/* cerrar la conexi贸n */
$con->close();

?>