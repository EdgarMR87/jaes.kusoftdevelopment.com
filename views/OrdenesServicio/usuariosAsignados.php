<div class="tablas-listado" id="contenido">
<?php 
  $id_partida_servicio = $_GET['id_partida_os'];
  $vistaUsuario = new MvcController();
  $respuesta = $vistaUsuario -> obtenerUsuariosAsignadosController($id_partida_servicio);
  $vistaSupervisor = new MvcController();
  $supervisor = $vistaSupervisor-> obtenerSupervisorAsignadosController($id_partida_servicio);
  $codigo_servicio="";
  $descripcion_servicio ="";
  foreach($respuesta as $row => $campo){
      $codigo_servicio = $campo['codigo_partida_os'];
      $descripcion_servicio = $campo['descripcion_serv'];
    }
?>
    <h1>USUARIOS ASIGNADOS  / ORDEN DE SERVICIO : <?php echo $_GET['OS']; ?></h1>
    <h2><?php echo $codigo_servicio . " - " . $descripcion_servicio; ?></h2>
    <form method="post" class="form-alta-serv">
    <table class="listado-previo" id="tabla-servicios-pre">
        <thead>
            <th class="listado-th">Realizado por :</th>
            <th class="listado-th">Fecha Asignacion</th>
            <th class="listado-th">Supervisor</th>
        </thead>
        <tbody>
        <?php 
          
           $n=0;
            foreach($respuesta as $row => $campo){
            echo "<tr> 
                   <td class='izquierda'>".
                        $campo['usuarioCompleto']
                   ."</td>
                   <td>".
                        $campo['fecha_asignacion']
                        .
                   "</td>
                   <td>".
                        $supervisor[0]['supervisor']
                        .
                "</td></tr>";
                $n =$n +1;
            }
		?>
        </tbody>
    </table>
    </form>
    <center>
    <a href="index.php?action=OrdenesServicio/detalleOS&id_os_editar= <?php echo $_GET['OS']; ?>"><img class='ico-partida' src='/views/img/regresar.png'></a>
    </center>
</div>