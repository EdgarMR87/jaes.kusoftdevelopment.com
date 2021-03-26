<div class="tablas-listado" id="contenido">
    <h1>USUARIOS ASIGNADOS  / ORDEN DE SERVICIO : <?php echo $_GET['OS']; ?></h1>
    <form method="post" class="form-alta-serv">
    <table class="listado-previo" id="tabla-servicios-pre">
        <thead>
            <th class="listado-th">Realizado por :</th>
            <th class="listado-th">Codigo</th>
            <th class="listado-th">Servicio</th>
            <th class="listado-th">Fecha Asignacion</th>
            <th class="listado-th">Supervisor</th>
        </thead>
        <tbody>
        <?php 
            $id_partida_servicio = $_GET['id_partida_os'];
    		$vistaUsuario = new MvcController();
    		$respuesta = $vistaUsuario -> obtenerUsuariosAsignadosController($id_partida_servicio);
            $vistaSupervisor = new MvcController();
            $supervisor = $vistaSupervisor-> obtenerSupervisorAsignadosController($id_partida_servicio);

           $n=0;
            foreach($respuesta as $row => $campo){
            echo "<tr> 
                   <td>".
                        $campo['usuarioCompleto']
                   ."</td>
                   <td>".
                        $campo['codigo_partida_os']
                   ."</td>
                   <td>".
                        $campo['descripcion_serv']
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
</div>