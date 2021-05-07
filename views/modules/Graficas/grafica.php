
 <head>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js" integrity="sha512-VMsZqo0ar06BMtg0tPsdgRADvl0kDHpTbugCBBrL55KmucH6hP9zWdLIWY//OTfMnzz6xWQRxQqsUFefwHuHyg==" crossorigin="anonymous"></script>
       	<link rel="stylesheet" href="/views/estiloTemplate.css">
        <script>
            window.print();
        </script>
    </head> 
 <?php
 
require_once "../../../models/conexion.php";

class Datos extends Conexion{
    #OBTENER TOTALES DE LOS SERVICIOS PARA GRAFICA 
    #-------------------------------------
	public static function vistaTotalesServiciosModel($datosModel){
		$stmt = Conexion::conectar()->prepare("SELECT tipo_servicio, COUNT(num_orden) as total
                FROM ordenServicio 
                WHERE fecha_liberacion BETWEEN :fecha_inicio AND :fecha_termino 
                GROUP BY tipo_servicio");
		$stmt->bindParam(":fecha_inicio", $datosModel["fecha_inicio"], PDO::PARAM_STR);	
        $stmt->bindParam(":fecha_termino", $datosModel["fecha_termino"], PDO::PARAM_STR);	
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

    public static function vistaMayorTiempoTrabajoModel($datosModel){
		$stmt = Conexion::conectar()->prepare("SELECT num_orden_partida_os, TIMESTAMPDIFF(MINUTE, MIN(fecha_inicio_partida_os), 
                MAX(fecha_termino_partida_os))AS tiempo_taller 
                FROM partidas_os 
                WHERE fecha_creacion_partida_os BETWEEN :fecha_inicio AND :fecha_termino
                GROUP BY num_orden_partida_os 
                ORDER BY tiempo_taller DESC 
                LIMIT 5");
		$stmt->bindParam(":fecha_inicio", $datosModel["fecha_inicio"], PDO::PARAM_STR);	
        $stmt->bindParam(":fecha_termino", $datosModel["fecha_termino"], PDO::PARAM_STR);	
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

    public static function vistaMenorTiempoTrabajoModel($datosModel){
		$stmt = Conexion::conectar()->prepare("SELECT num_orden_partida_os, TIMESTAMPDIFF(MINUTE, MIN(fecha_inicio_partida_os), 
                MAX(fecha_termino_partida_os))AS tiempo_taller 
                FROM partidas_os 
                WHERE fecha_creacion_partida_os BETWEEN :fecha_inicio AND :fecha_termino
                GROUP BY num_orden_partida_os 
                ORDER BY tiempo_taller ASC 
                LIMIT 5");
		$stmt->bindParam(":fecha_inicio", $datosModel["fecha_inicio"], PDO::PARAM_STR);	
        $stmt->bindParam(":fecha_termino", $datosModel["fecha_termino"], PDO::PARAM_STR);	
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

    public static function vistaUnidadesTotalModel($datosModel){
		$stmt = Conexion::conectar()->prepare("SELECT id_unidad_servicio, COUNT(id_unidad_servicio) as total
                FROM ordenServicio
                WHERE fecha_creacion BETWEEN :fecha_inicio AND :fecha_termino
                GROUP BY id_unidad_servicio ORDER BY total DESC LIMIT 5");
		$stmt->bindParam(":fecha_inicio", $datosModel["fecha_inicio"], PDO::PARAM_STR);	
        $stmt->bindParam(":fecha_termino", $datosModel["fecha_termino"], PDO::PARAM_STR);	
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

    public static function vistaMayorTiempoRegistroLiberacionModel($datosModel){
		$stmt = Conexion::conectar()->prepare("SELECT id_unidad_servicio, TIMESTAMPDIFF(MINUTE, fecha_liberacion, fecha_creacion) 
                AS tiempo_total FROM ordenServicio
                WHERE fecha_creacion BETWEEN :fecha_inicio AND :fecha_termino 
                ORDER BY tiempo_total DESC LIMIT 5");
		$stmt->bindParam(":fecha_inicio", $datosModel["fecha_inicio"], PDO::PARAM_STR);	
        $stmt->bindParam(":fecha_termino", $datosModel["fecha_termino"], PDO::PARAM_STR);	
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

    
}

    session_start();
    $datosController = array("fecha_inicio" => $_GET["fecha_inicio"], "fecha_termino" => $_GET["fecha_termino"]);
    $_SESSION["fecha_inicio"] = $_GET["fecha_inicio"];
    $_SESSION["fecha_termino"] = $_GET["fecha_termino"];
   

    switch($_GET["reporte"]){
        case "totales_servicios":
            $respuesta = Datos::vistaTotalesServiciosModel($datosController);
            $campos = array();
            $valores = array();
            foreach($respuesta as $row){
                $campos[] = strval($row["tipo_servicio"]);
                $valores[] = floatval($row["total"]);
            }
        ?>
        <table class="table-graficas">
            <thead>
                <tr>    
                    <th>Tipo de Servicio</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $i=0;
                foreach($campos as $row){
                    echo "<tr>
                            <td>$row</td>
                            <td>$valores[$i]</td>
                        </tr>";
                        $i++;
                }
            ?>  
            </tbody>
        </table>
        <?php
    break;
    case "unidades_taller":
        $respuesta = Datos::vistaUnidadesTotalModel($datosController);
        $campos = array();
        $valores = array();
        foreach($respuesta as $row){
            $campos[] = strval($row["id_unidad_servicio"]);
            $valores[] = floatval($row["total"]);
        }
        echo "<h1 class='centrar'>Unidades Totales en Taller ". $_GET["fecha_inicio"] . " / " . $_GET["fecha_termino"] . "</h1>";
    break;
    case "mayor_tiempo":
        $respuesta = Datos::vistaMayorTiempoTrabajoModel($datosController);
        $campos = array();
        $valores = array();
        foreach($respuesta as $row){
            $campos[] = strval($row["num_orden_partida_os"]);
            $valores[] = floatval($row["tiempo_taller"]);
        }
        echo "<h1 class='centrar'>Mayor Tiempo en Taller ". $_GET["fecha_inicio"] . " / " . $_GET["fecha_termino"] . "</h1>";
        ?>
        <table class="table-graficas">
            <thead>
                <tr>    
                    <th>Unidad</th>
                    <th>Minutos</th>
                    <th>Horas</th>
                    <th>Dias</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $i=0;
                foreach($campos as $row){
                    echo "<tr>
                            <td>$row</td>
                            <td>$valores[$i]</td>
                            <td>".($valores[$i]/60)."</td>
                            <td>".($valores[$i]/60/24)."</td>
                        </tr>";
                        $i++;
                }
            ?>  
            </tbody>
        </table>
        <?php
    break;
    case "menor_tiempo":
        $respuesta = Datos::vistaMenorTiempoTrabajoModel($datosController);
        $campos = array();
        $valores = array();
        foreach($respuesta as $row){
            $campos[] = strval($row["num_orden_partida_os"]);
            $valores[] = floatval($row["tiempo_taller"]);
        }
        echo "<h1 class='centrar'>Menor Tiempo en Taller ". $_GET["fecha_inicio"] . " / " . $_GET["fecha_termino"] . "</h1>";
        ?>
        <table class="table-graficas">
            <thead>
                <tr>    
                    <th>Unidad</th>
                    <th>Minutos</th>
                    <th>Horas</th>
                    <th>Dias</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $i=0;
                foreach($campos as $row){
                    echo "<tr>
                            <td>$row</td>
                            <td>$valores[$i]</td>
                            <td>".($valores[$i]/60)."</td>
                            <td>".($valores[$i]/60/24)."</td>
                        </tr>";
                        $i++;
                }
            ?>  
            </tbody>
        </table>
        <?php
    break;
    case "registro_liberacion":
        $respuesta = Datos::vistaMayorTiempoRegistroLiberacionModel($datosController);
        $campos = array();
        $valores = array();
        foreach($respuesta as $row){
            $campos[] = strval($row["id_unidad_servicio"]);
            $valores[] = floatval($row["tiempo_total"]);
        }
        echo "<h1 class='centrar'>Tiempo Registro - Liberacion ". $_GET["fecha_inicio"] . " / " . $_GET["fecha_termino"] . "</h1>";
        ?>
        <table class="table-graficas">
            <thead>
                <tr>    
                    <th>Unidad</th>
                    <th>Minutos Totales</th>
                    <th>Horas</th>
                    <th>Dias</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $i=0;
                foreach($campos as $row){
                    echo "<tr>
                            <td>$row</td>
                            <td>$valores[$i]</td>
                            <td>".($valores[$i]/60)."</td>
                            <td>".($valores[$i]/60/24)."</td>
                        </tr>";
                        $i++;
                }
            ?>  
            </tbody>
        </table>
        <?php
    break;

    }
    
    ?>
    <div class="graficas" id="graficas">
        <canvas id="goodCanvas1" width="400" height="100" aria-label="Hello ARIA World" role="img"></canvas>

    </div>
    
    <script>
     
        var ctx = document.getElementById('goodCanvas1').getContext('2d');
        var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?php
                    foreach($campos as $row){
                            if ($row === end($campos)) {
                                echo "'".$row."'";
                            }else{
                                echo "'".$row."',";
                            }
                        }
                            ?>],
            datasets: [{
                labels: '',
                data: [<?php 
                        $i = 0;
                        foreach($valores as $row){
                            if($i == count($valores))
                                echo $row;
                            else
                                echo $row.",";
                            $i++;
                        }
                            ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    
</script>

</div>
