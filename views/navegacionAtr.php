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
            closeOnConfirm: false
        }).then(function(result) {
                if (result.value) {
                    swal({
                        title: "Adios",
                        text: "Saliendo del sistema .....",
                        type: "success",
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
            <a onclick="salir(); return false;" >
                <img class="img-header" src="/views/img/Salir.png">
            </a>
        </li>
	</ul>
</div>


<div class="submenu-usuarios" id="submenu-os">
	<div class="listado-submenu">
		<a href="index.php?action=OrdenesServicio/listadoOS">
			<img src="/views/img/ListadoUsuarios.png">
			<p>Listado Ordenes Servicio</p>
		</a>
	</div>
	<div class="listado-submenu">
		<a href="index.php?action=OrdenesServicio/altaOrdenS">
			<img src="/views/img/NuevoUsuario.png">
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
		<a href="index.php?action=OrdenesServicio/listadoServiciosEnProceso">
			<img src="/views/img/asignarUsuarios.png">
			<p>Servicio En Proceso</p>
		</a>
	</div>

</div>
    

<div class="submenu-usuarios" id="submenu-unidades">
	<div class="listado-submenu">
		<a href="index.php?action=Unidades/listadoUnidades">
			<img src="/views/img/Unidades.png">
			<p>Listado Unidades</p>
		</a>
	</div>
	<div class="listado-submenu">
		<a href="index.php?action=Unidades/altaUnidad">
			<img src="/views/img/Departamentos.png">
			<p>Agregar Unidad</p>
		</a>
	</div>
</div> 

<div class="submenu-usuarios" id="submenu-servicios">
	<div class="listado-submenu">
		<a href="index.php?action=ServiciosAtr/listadoServiciosAtr">
			<img src="/views/img/Servicios.png">
			<p>Listado Servicios</p>
		</a>
	</div>
	<div class="listado-submenu">
		<a href="index.php?action=ServiciosAtr/altaServicioAtr">
			<img src="/views/img/Puesto.png">
			<p>Agregar Servicio</p>
		</a>
	</div>
</div>