<script>
    function salir(){
        swal({
            title: "¿Deseas Cerrar Sesión?",
            text: "Estás por salir del sistema.",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Continuar",
            closeOnClickOutside: false,
            closeOnEsc: false,
            allowOutsideClick: false,
        }).then(function(result) {
                if (result.value) {
                    swal({
                        title: "Adios",
                        text: "Saliendo del sistema .....",
                        type: "success",
                        closeOnClickOutside: false,
                        closeOnEsc: false,
                        allowOutsideClick: false,
                    }).then(function(result) {
                            if(result.value){
                                location.href = "index.php?action=exit";
                            }
                        });
                }else{
                    swal("No se ha cerrado sesión","Sigamos trabajando.","error");
                    delay(2000);
                }
        });
    }

</script>

<div id="header">
	<ul class="nav">
		<li>
            <a id="li-os">
                <img class="img-header" src="/views/img/OrdenServicio.png">
            </a>
        </li>
	    <li>
            <a id="li-unidades">
                <img class="img-header" src="/views/img/Unidades.png">
            </a>
        </li>
        <li>
            <a id="li-servicios">
                <img class="img-header" src="/views/img/Servicios.png">
            </a>            
        </li>
        <li>
            <a id="li-checklist">
                <img class="img-header" src="/views/img/checklist.png">
            </a>            
        </li>
        <li>
            <a id="li-tiempos">
                <img class="img-header" src="/views/img/tiempos.png">
            </a>            
        </li>
        <li>
            <a id="li-reportes">
                <img class="img-header" src="/views/img/Reportes.png">
            </a>            
        </li>
        <li>
            <a id="li-procesos">
                <img class="img-header" src="/views/img/Procesos.png">
            </a>            
        </li>
        <li>
            <a id="li-graficas">
                <img class="img-header" src="/views/img/Graficas.png">
            </a>            
        </li>
        <li>
            <a onclick="salir(); return false;" >
                <img class="img-header" src="/views/img/Salir.png">
            </a>
        </li>
	</ul>
</div>

<div class="submenu-usuarios" id="submenu-os">
	<div class="listado-submenu">
		<a href="index.php?action=OrdenesServicio/listadoOS">
			<img src="/views/img/Listado_OS.png">
			<p>Listado Ordenes Servicio</p>
		</a>
	</div>
	<div class="listado-submenu">
		<a href="index.php?action=OrdenesServicio/altaOrdenS">
			<img src="/views/img/Add_OS.png">
			<p>Agregar Orden Servicio</p>
		</a>
	</div>
	<div class="listado-submenu">
		<a href="index.php?action=OrdenesServicio/iniciarServicio">
			<img src="/views/img/Iniciar.png">
			<p>Iniciar Servicio</p>
		</a>
	</div>
	<div class="listado-submenu">
		<a href="index.php?action=OrdenesServicio/finalizarServicio">
			<img src="/views/img/Terminar.png">
			<p>Finalizar Servicio</p>
		</a>
	</div>
    <div class="listado-submenu">
		<a href="index.php?action=OrdenesServicio/asignarUsuarios">
			<img src="/views/img/asignarUsuarios.png">
			<p>Asignar Usuario</p>
		</a>
	</div>
    <div class="listado-submenu">
		<a href="index.php?action=OrdenesServicio/finalizarTurnoUsuarios">
			<img src="/views/img/asignarUsuarios.png">
			<p>Finalizar Turno Usuario</p>
		</a>
	</div>
    <div class="listado-submenu">
		<a href="index.php?action=OrdenesServicio/listadoServiciosEnProceso">
			<img src="/views/img/servicios_Proceso.png">
			<p>Servicios En Proceso</p>
		</a>
	</div>
    <div class="listado-submenu">
		<a href="index.php?action=OrdenesServicio/historialOS">
			<img src="/views/img/Historial.png">
			<p>Historial OS</p>
		</a>
	</div>
    <div class="listado-submenu">
		<a href="index.php?action=OrdenesServicio/finalizarOS">
			<img src="/views/img/Historial.png">
			<p>Finalizar OS</p>
		</a>
	</div>
</div>

<div class="submenu-usuarios" id="submenu-unidades">
	<div class="listado-submenu">
		<a href="index.php?action=Unidades/listadoUnidades">
			<img src="/views/img/Listado_Trailers.png">
			<p>Listado Unidades</p>
		</a>
	</div>
	<div class="listado-submenu">
		<a href="index.php?action=Unidades/altaUnidad">
			<img src="/views/img/Add_Trailer.png">
			<p>Agregar Unidad</p>
		</a>
	</div>
</div> 

<div class="submenu-usuarios" id="submenu-servicios">
	<div class="listado-submenu">
		<a href="index.php?action=ServiciosAtr/listadoServiciosAtr">
			<img src="/views/img/Listado_Servicios.png">
			<p>Listado Servicios</p>
		</a>
	</div>
	<div class="listado-submenu">
		<a href="index.php?action=ServiciosAtr/altaServicioAtr">
			<img src="/views/img/Add_Servicio.png">
			<p>Agregar Servicio</p>
		</a>
	</div>
</div>

<!-- SUBMENU DE LOS CHECKLIST !-->

<div class="submenu-usuarios" id="submenu-checklist">
	<div class="listado-submenu">
		<a href="index.php?action=CheckLists/altaCheckListMazda">
			<img src="/views/img/NuevoCheckListMazda.png">
			<p>Nuevo Checklist Mazda</p>
		</a>
	</div>
    <div class="listado-submenu">
		<a href="index.php?action=CheckLists/listadoCheckListMazda">
			<img src="/views/img/ListadoCheckListMazda.png">
			<p>Listado Checklist Mazda</p>
		</a>
	</div>
    <div class="listado-submenu">
		<a href="index.php?action=CheckLists/pendientes">
			<img src="/views/img/pendientes.png">
			<p>Pendientes</p>
		</a>
	</div>
    <div class="listado-submenu">
		<a href="index.php?action=CheckLists/listadoPendientes">
			<img src="/views/img/pendientes.png">
			<p>Listado Pendientes</p>
		</a>
	</div>
</div>

<!-- SUBMENU DE LOS TIEMPOS !-->
<div class="submenu-usuarios" id="submenu-tiempos">
	<div class="listado-submenu">
		<a href="index.php?action=Tiempos/tiemposUnidad">
			<img src="/views/img/unidadTiempos.png">
			<p>Tiempos Servicios x Unidad</p>
		</a>
	</div>
</div>


<!-- SUBMENU DE LOS REPORTES !-->
<div class="submenu-usuarios" id="submenu-reportes">
	<div class="listado-submenu">
		<a href="index.php?action=Reportes/altaReporte">
			<img src="/views/img/registrarReporte.png">
			<p>Registrar Reporte</p>
		</a>
	</div>
    <div class="listado-submenu">
		<a href="index.php?action=Reportes/listadoReporte">
			<img src="/views/img/listadoReportes.png">
			<p>Listado Reportes</p>
		</a>
	</div>
</div>

<!-- SUBMENU DE LOS PROCESOS !-->
<div class="submenu-usuarios" id="submenu-procesos">
    <div class="listado-submenu">
		<a href="index.php?action=Procesos/registrarProyecto">
			<img src="/views/img/NuevoProyecto.png">
			<p>Registrar Nuevo Proyecto</p>
		</a>
	</div>
    <div class="listado-submenu">
		<a href="index.php?action=Procesos/listadoProyectos">
			<img src="/views/img/ListadoProyectos.png">
			<p>Listado Proyectos</p>
		</a>
	</div>
	<div class="listado-submenu">
		<a href="index.php?action=Procesos/registrarProcesoGeneral">
			<img src="/views/img/NuevoProcesoGral.png">
			<p>Registrar Proceso General</p>
		</a>
	</div>
    <div class="listado-submenu">
		<a href="index.php?action=Procesos/listadoProcesosGeneral">
			<img src="/views/img/ListadoProcesoGral.png">
			<p>Listado Procesos Gral</p>
		</a>
	</div>
    <div class="listado-submenu">
		<a href="index.php?action=Procesos/registrarProceso">
			<img src="/views/img/NuevoProceso.png">
			<p>Registrar Proceso</p>
		</a>
	</div>
    <div class="listado-submenu">
		<a href="index.php?action=Procesos/listadoProcesos">
			<img src="/views/img/ListadoProceso.png">
			<p>Listado Procesos</p>
		</a>
	</div>
    <div class="listado-submenu">
		<a href="index.php?action=Procesos/registrarCliente">
			<img src="/views/img/NuevoCliente.png">
			<p>Registrar Cliente</p>
		</a>
	</div>
    <div class="listado-submenu">
		<a href="index.php?action=Procesos/listadoClientes">
			<img src="/views/img/ListadoClientes.png">
			<p>Listado Clientes</p>
		</a>
	</div>
</div>


<!-- SUBMENU DE LOS GRAFICAS !-->
<div class="submenu-usuarios" id="submenu-graficas">
	<div class="listado-submenu">
		<a href="index.php?action=Graficas/OrdenesServicio">
			<img src="/views/img/Graficas.png">
			<p>Totales OS</p>
		</a>
	</div>
    <div class="listado-submenu">
		<a href="index.php?action=Graficas/OrdenesServicio">
			<img src="/views/img/Graficas.png">
			<p>Listado Reportes</p>
		</a>
	</div>
</div>