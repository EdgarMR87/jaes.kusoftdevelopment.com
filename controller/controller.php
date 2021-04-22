<?php

class MvcController{
	
	#LLAMADA A LA PLANTILLA JAES
	#-------------------------------------
	public function pagina(){	
		include "views/template.php";
	}

	#ENLACES JAES
	#-------------------------------------
	public function enlacesPaginasController(){
		if(isset( $_GET['action'])){
			$enlaces = $_GET['action'];
		} else {
			$enlaces = "index";
		}
		$respuesta = Paginas::enlacesPaginasModel($enlaces);
		include $respuesta;

	}

    #LLAMADA A LA PLANTILLA ATR
	#-------------------------------------
	public function paginaAtr(){	
		include "views/templateAtr.php";
	}

    #ENLACES JAES
	#-------------------------------------
	public function enlacesPaginasAtrController(){
		if(!empty( $_GET['action'])){
			$enlaces = $_GET['action'];
		} else {
			$enlaces = "index";
		}
		$respuesta = PaginasAtr::enlacesPaginasAtrModel($enlaces);
		include $respuesta;
	}

	#REGISTRO DE USUARIOS
	#------------------------------------
	public static function registroUsuarioController(){
		require_once "./models/crud.php";
		if(isset($_POST["usuario"])){
			$datosController = array( "nombre_u"=>strtoupper($_POST["nombre_u"]), 
								      "ape_pat_u"=>strtoupper($_POST["ape_pat_u"]),
									  "ape_mat_u"=>strtoupper($_POST["ape_mat_u"]),
									  "usuario"=>$_POST["usuario"],
									  "contrasena"=>$_POST["contrasena"], 
									  "departamento"=>$_POST["departamento"], 
									  "puesto"=>$_POST["puesto"]);
			$respuesta = Datos::registroUsuarioModel($datosController, "usuarios");
			if($respuesta == "success"){
				return $respuesta;
			}else{
                $valor = $respuesta[2];
                return $valor;
			}
		}
	}

	#INGRESO DE USUARIOS
	#------------------------------------
    public static function ingresoUsuarioController(){
    
		require_once "./models/crud.php";
		if(isset($_POST["usuario_r"])){
			$datosController = array( "usuario_r"=>$_POST["usuario_r"], 
								      "contrasena"=>$_POST["contrasena"]);

			$respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");

			if(password_verify($_POST["contrasena"], $respuesta["password"])){	
                session_start();	
				$_SESSION["id_usuario"] = $respuesta["id_usuario"];
                $_SESSION["nombreCompleto"] = $respuesta["nombreCompleto"];
                $_SESSION["id_departamento"] = $respuesta["id_dpto_u"];
                return "success";
			} else{
				return "error";		
			}
		}
	}	

	#VISTA DE USUARIOS
	#------------------------------------

	public static function vistaUsuariosController(){
		require_once "./models/crud.php";
		$respuesta = Datos::vistaGeneralModel("usuarios");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
		foreach($respuesta as $row => $item){
			echo'<tr>
					<td>'.$item["id_usuario"].'</td>
					<td>'.$item["nombre_u"].'</td>
					<td>'.$item["ape_pat_u"].'</td>
					<td>'.$item["ape_mat_u"].'</td>
					<td>'.$item["usuario"].'</td>
					<td>'.$item["contrasena"].'</td>
					<td>'.$item["nombre_dpto"].'</td>
					<td>'.$item["nombre_puesto"].'</td>
					<td>'.$item["estado_u"].'</td>
					<td>'.$item["fecha_creacion_usuario"].'</td>
					<td><a href="index.php?action=Usuarios/editar&id_usuario_m='.$item["id_usuario"].'"><img src="/views/img/editar.png" class="img-25"></img></a></td>
					<td><a href="index.php?action=Usuarios/usuarios&id_usuario_borrar='.$item["id_usuario"].'"><img src="/views/img/eliminar.png" class="img-25"></img></a></td>
				</tr>';
			}
	}

    #BORRAR USUARIO
	#------------------------------------
	public function borrarUsuarioController(){
        require_once "./models/crud.php";
		if(isset($_GET["id_usuario_borrar"])){
			$datosController = $_GET["id_usuario_borrar"];
			$respuesta = Datos::borrarUsuarioModel($datosController, "usuarios");
			if($respuesta == "success"){
				header("location:index.php?action=Usuarios/usuarios");
			}
		}
	}

	#EDITAR USUARIO
	#------------------------------------
	public function editarUsuarioController(){
		require_once "./models/crud.php";
		$datosController = $_GET["id_usuario_m"];
		$respuesta = Datos::editarUsuarioModel($datosController, "usuarios");
		return $respuesta;
	}

	#ACTUALIZAR USUARIO
	#------------------------------------
	public function actualizarUsuarioController(){
		require_once "./models/crud.php";
		if(isset($_POST["nombre_u_m"])){
			$datosController = array( "id_usuario_m"=>$_POST["id_usuario_m"],
							          "nombre_u_m"=>$_POST["nombre_u_m"],
				                      "ape_pat_u_m"=>$_POST["ape_pat_u_m"],
									  "ape_mat_u_m"=>$_POST["ape_mat_u_m"],
									  "usuario_m"=>$_POST["usuario_m"],
									  "contrasena_m"=>$_POST["contrasena_m"],
									  "departamento_m"=>$_POST["departamento_m"],
									  "puesto_m"=>$_POST["puesto_m"],
									  "estado_m"=>$_POST["estado_m"]);
			$respuesta = Datos::actualizarUsuarioModel($datosController, "usuarios");
			if($respuesta == "success"){
				echo "<span class='registro-actualizado'>Actualizacion Correcta</span>";
                echo '<script> setTimeout("location.href ='."'index.php?action=Usuarios/usuarios'".'"'.', 1000);</script>';
            } else {
				echo "<p class='error-acceso'>". var_dump($respuesta)."</p>";
			}
		}
	}

	#VISTA DE DEPARTAMENTOS SELECT
	#------------------------------------
	public static function vistaDepartamentosController(){
		require_once "./models/crud.php";
		$respuesta = Datos::vistaDepartamentosModel("departamento");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
		echo"<option value='0' disabled selected>Selecciona el departamento que realizará el servicio ... </option>";
        foreach($respuesta as $row => $item){
		echo"<option value='". $item['id_departamento']."'>".$item['nombre_dpto']."</option>";
		}
	}

	#VISTA DE DEPARTAMENTOS SELECT CON SELECCION
	#------------------------------------
	public static function vistaDepartamentosSelectedController($id){
		require_once "./models/crud.php";
		$respuesta = Datos::vistaDepartamentosModel("departamento");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
		foreach($respuesta as $row => $item){
			if($id ==  $item['id_departamento'])
				echo"<option value='". $item['id_departamento']."' SELECTED>".$item['nombre_dpto']."</option>";
			else
				echo"<option value='". $item['id_departamento']."'>".$item['nombre_dpto']."</option>";
		}
	}

	#REGISTRO DE DEPARTAMENTO
	#------------------------------------
	public static function registroDepartamentoController(){
		require_once "./models/crud.php";
		if(isset($_POST["nombre_dpto"])){
			$datosController = array( "nombre_dpto"=>strtoupper($_POST["nombre_dpto"]), 
								      "descripcion_dpto"=>strtoupper($_POST["descripcion_dpto"]));
			$respuesta = Datos::registroDepartamentoModel($datosController, "departamento");
			if($respuesta == "success"){
				header("location:index.php?action=dpto_ok");
			}else{
				echo "<p class='error-acceso'>".$respuesta[2]."</p>";
			}
		}
	}

	#EDITAR DEPARTAMENTO
	public static function editarDptoController(){
		require_once "./models/crud.php";
		$datosController = $_GET["id_dpto_editar"];
		$respuesta = Datos::editarDptoModel($datosController, "departamento");
		return $respuesta;
	}

	#ACTUALIZAR DEPARTAMENTO
	#------------------------------------
	public function actualizarDptoController(){
        require_once "./models/crud.php";
		if(isset($_POST["id_dpto_modif"])){
			$datosController = array( "id_dpto_modificar"=>$_POST["id_dpto_modif"],
							          "nombre_dpto_modif"=>$_POST["nombre_dpto_modif"],
				                      "descripcion_dpto_modif"=>$_POST["descripcion_dpto_modif"]);
			
			$respuesta = Datos::actualizarDptoModel($datosController, "departamento");
			if($respuesta == "success"){
                echo "<span class='registro-actualizado'>Actualizacion Correcta</span>";
                echo '<script> setTimeout("location.href ='."'index.php?action=Departamentos/listadoDpto'".'"'.', 1000);</script>';
            } else {
				echo $respuesta;
			}

		}
	
	}
	
	#VISTA DE DEPARTAMENTOS TABLA
	#------------------------------------
	public static function vistaDepartamentosTablaController(){
        require_once "./models/crud.php";
		$respuesta = Datos::vistaGeneralTablaModel("departamento");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
		foreach($respuesta as $row => $item){
			echo'<tr>
					<td>'.$item["id_departamento"].'</td>
					<td>'.$item["nombre_dpto"].'</td>
					<td>'.$item["descripcion_dpto"].'</td>
					<td><a href="index.php?action=Departamentos/editarDpto&id_dpto_editar='.$item["id_departamento"].'"><img src="/views/img/editar.png" class="img-25"></img></a></td>
					<td><a href="index.php?action=Departamentos/listadoDpto&id_dpto_Borrar='.$item["id_departamento"].'"><img src="/views/img/eliminar.png" class="img-25"></img></a></td>
				</tr>';
			}
	}

	#BORRAR DEPARTAMENTO
	#------------------------------------
	public function borrarDepartamentoController(){
        require_once "./models/crud.php";
		if(isset($_GET["id_dpto_Borrar"])){
			$datosController = $_GET["id_dpto_Borrar"];
			$respuesta = Datos::borrarDepartamentoModel($datosController, "departamento");
			if($respuesta == "success"){
				header("location:index.php?action=Departamentos/listadoDpto");
			}
		}
	}



    #VISTA DE DEPARTAMENTOS SELECT CON SELECCION
	#------------------------------------
	public static function vistaPuestosSelectedController($id_dpto, $id_puesto){
		require_once "./models/crud.php";
		$respuesta = Datos::vistaPuestoIDModel("puesto", $id_dpto);
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
		foreach($respuesta as $row => $item){
			if($id_puesto ==  $item['id_puesto'])
				echo"<option value='". $item['id_puesto']."' SELECTED>".$item['nombre_puesto']."</option>";
			else
				echo"<option value='". $item['id_puesto']."'>".$item['nombre_puesto']."</option>";
		}
	}

    
    
    #VISTA DE PUESTOS TABLA
	#------------------------------------
	    public static function vistaPuestoTablaController(){
        require_once "./models/crud.php";
		$respuesta = Datos::vistaPuestoTablaModel("puesto");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
		foreach($respuesta as $row => $item){
			echo'<tr>
					<td>'.$item["id_puesto"].'</td>
					<td>'.$item["nombre_puesto"].'</td>
					<td>'.$item["descripcion_puesto"].'</td>
                    <td>'.$item["nombre_dpto"].'</td>
                    <td>'.$item["fecha_creacion_puesto"].'</td>
					<td><a href="index.php?action=Puestos/editarPuesto&id_puesto_editar='.$item["id_puesto"].'"><img src="/views/img/editar.png" class="img-25"></img></a></td>
					<td><a href="index.php?action=Puestos/listadoPuesto&id_puesto_borrar='.$item["id_puesto"].'"><img src="/views/img/eliminar.png" class="img-25"></img></a></td>
				</tr>';
			}
	}

    #BORRAR PUESTO
	#------------------------------------
	public function borrarPuestoController(){
        require_once "./models/crud.php";
		if(isset($_GET["id_puesto_borrar"])){
			$datosController = $_GET["id_puesto_Borrar"];
			$respuesta = Datos::borrarPuestoModel($datosController, "puesto");
			if($respuesta == "success"){
				header("location:index.php?action=Puestos/listadoPuesto");
			}
		}
	}

    #EDITAR PUESTO
	#------------------------------------
	public function editarPuestoController(){
		require_once "./models/crud.php";
		$datosController = $_GET["id_puesto_editar"];
		$respuesta = Datos::editarPuestoModel($datosController, "puesto");
		return $respuesta;
	}

    #REGISTRO DE PUESTO
	#------------------------------------
	public static function registroPuestoController(){
		require_once "./models/crud.php";
		if(isset($_POST["nombre_puesto"])){
			$datosController = array( "nombre_puesto"=>strtoupper($_POST["nombre_puesto"]), 
                                        "descripcion_puesto"=> strtoupper($_POST["descripcion_puesto"]),
                                        "id_departamento_puesto"=>$_POST["id_departamento_puesto"]);
			$respuesta = Datos::registroPuestoModel($datosController, "puesto");
			if($respuesta == "success"){
				return $respuesta;
			}else{
                $valor = $respuesta[2];
                return $valor;
			}
		}
	}

    #ACTUALIZAR PUESTO
	#------------------------------------
	public function actualizarPuestoController(){
        require_once "./models/crud.php";
		if(isset($_POST["id_puesto_modif"])){
			$datosController = array( "id_puesto_modif"=>$_POST["id_puesto_modif"],
							          "nombre_puesto_modif"=>$_POST["nombre_puesto_modif"],
                                      "descripcion_puesto_modif"=>$_POST["descripcion_puesto_modif"],
				                      "id_departamento_puesto_modif"=>$_POST["id_departamento_puesto_modif"]);
			
			$respuesta = Datos::actualizarPuestoModel($datosController, "puesto");
			if($respuesta == "success"){
                return $respuesta;
			}else{
                $valor = $respuesta[2];
                return $valor;
			}

		}
	
	}
    
    

    public static function vistaServiciosAtrTablaController(){
        require_once "./models/crud.php";
		$respuesta = Datos::vistaServiciosAtrTablaModel("servicios_atr");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
        return $respuesta;
    }


    #REGISTRO DE SERVICIOS
	#------------------------------------
	public static function registroServicioAtrController(){
		require_once "./models/crud.php";
		if(isset($_POST["codigo_atr_serv"])){
			$datosController = array( "codigo_atr_serv"=>$_POST["codigo_atr_serv"], 
								      "descripcion_serv"=>strtoupper($_POST["descripcion_serv"]),
                                    "comentarios_serv"=>strtoupper($_POST["comentarios_serv"]),
                                    "id_dpto_serv"=>$_POST["id_dpto_serv"]);
			$respuesta = Datos::registroServicioAtrModel($datosController, "servicios_atr");
            $link = "index.php?action=ServiciosAtr/listadoServiciosAtr";
			if($respuesta == "success"){
                echo "<script>
                        registroOK('".$link."');
                    </script>";
			}else{
				echo "<p class='error-acceso'>".$respuesta[2]."</p>";
			}
		}
	}


#EDITAR DEPARTAMENTO
public static function editarServicioAtrController(){
    require_once "./models/crud.php";
    $datosController = $_GET["id_servicio_editar"];
    $respuesta = Datos::editarServicioAtrModel($datosController, "servicios_atr");
    return $respuesta;
}


    #ACTUALIZAR SERVICIO ATR
	#------------------------------------
	public function actualizarServicioAtrController(){
		require_once "./models/crud.php";
		if(isset($_POST["id_servicio_editar"])){
			$datosController = array( "codigo_atr_serv_editar"=>$_POST["codigo_atr_serv_editar"],
							          "descripcion_serv_editar"=>$_POST["descripcion_serv_editar"],
				                      "comentarios_serv_editar"=>$_POST["comentarios_serv_editar"],
									  "estado_serv_editar"=>$_POST["estado_serv_editar"],
									  "id_servicio_editar"=>$_POST["id_servicio_editar"]);
			$respuesta = Datos::actualizarServicioAtrModel($datosController, "servicios_atr");
            $link = "index.php?action=ServiciosAtr/listadoServiciosAtr";
			if($respuesta == "success"){
                echo "<script>
                        actualizarOK('".$link."');
                    </script>";
            } else {
				echo "<p class='error-acceso'>". var_dump($respuesta)."</p>";
			}
		}
	}
    
    #BORRAR USUARIO
	#------------------------------------
	public function borrarServicioAtrController(){
        require_once "./models/crud.php";
		if(isset($_POST["id_servicio_borrar"])){
			$datosController = $_POST["id_servicio_borrar"];
			$respuesta = Datos::borrarServicioAtrModel($datosController, "servicios_atr");
            $link = "index.php?action=ServiciosAtr/listadoServiciosAtr";
			if($respuesta == "success"){
                echo '<script>
                var x = document.getElementById("openModalEliminar");
                x.style.display = "none";             
                borrarOk('."'".$link."'".');
                </script>';
			}else{
                $valor = $respuesta[2];
                $error = str_replace("'", "", $valor);
                echo '<script>
                        var x = document.getElementById("openModalEliminar");
                        x.style.display = "none";              
                        errorRegistro('."'".$error."','".$link."'".');
                </script>';
			}
		}
	}

    public static function vistaUnidadesTablaController(){
        require_once "./models/crud.php";
		$respuesta = Datos::vistaUnidadesTablaModel("unidades");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
        return $respuesta;
    }

    
    #BORRAR UNIDAD
	#------------------------------------
	public function borrarUnidadController(){
        require_once "./models/crud.php";
		if(isset($_POST["id_unidad_borrar"])){
			$datosController = $_POST["id_unidad_borrar"];
			$respuesta = Datos::borrarUnidadesModel($datosController, "unidades");
            $link = "index.php?action=Unidades/listadoUnidades";
			if($respuesta == "success"){
                echo '<script>
                var x = document.getElementById("openModalEliminar");
                x.style.display = "none";             
                borrarOk('."'".$link."'".');
                </script>';
			}else{
                $valor = $respuesta[2];
                $error = str_replace("'", "", $valor);
                echo '<script>
                        var x = document.getElementById("openModalEliminar");
                        x.style.display = "none";              
                        errorRegistro('."'".$error."','".$link."'".');
                </script>';
			}
		}
	}

     #REGISTRO DE SERVICIOS
	#------------------------------------
	public static function registroUnidadController(){
		require_once "./models/crud.php";
		if(isset($_POST["num_unidad"])){
			$datosController = array( "num_unidad"=>$_POST["num_unidad"], 
								      "modelo"=>$_POST["modelo"]);
			$respuesta = Datos::registroUnidadModel($datosController, "unidades");
            $link = "index.php?action=Unidades/altaUnidad";
			if($respuesta == "success"){
                echo "<script>
                        registroOK('".$link."');
                    </script>";
			}else{
                $valor = $respuesta[2];
                $error = str_replace("'", "", $valor);
                echo '<script>
                        errorRegistro('."'".$error."','".$link."'".');
                </script>';
			}
		}
	}
    

    #EDITAR UNIDAD
    public static function editarUnidadController(){
        require_once "./models/crud.php";
        $datosController = $_GET["id_unidad_editar"];
        $respuesta = Datos::editarUnidadModel($datosController, "unidades");
        return $respuesta;
    }

    #ACTUALIZAR SERVICIO ATR
	#------------------------------------
	public function actualizarUnidadController(){
		require_once "./models/crud.php";
		if(isset($_POST["id_unidad_editar"])){
			$datosController = array( "id_unidad_editar"=>$_POST["id_unidad_editar"],
							          "num_unidad_editar"=>$_POST["num_unidad_editar"],
                                      "estado_unidad_editar"=>$_POST["estado_unidad_editar"],
				                      "modelo_unidad_editar"=> strtoupper($_POST["modelo_unidad_editar"]));
			$respuesta = Datos::actualizarUnidadesModel($datosController, "unidades");
			if($respuesta == "success"){
				echo "<span class='registro-actualizado'>Actualizacion Correcta</span>";
                echo '<script> setTimeout("location.href ='."'index.php?action=Unidades/listadoUnidades'".'"'.', 1000);</script>';
            } else {
				echo "<p class='error-acceso'>". $respuesta[2]."</p>";
			}
		}
	}

	public static function vistaOSAtrTablaController(){
        require_once "./models/crud.php";
		$respuesta = Datos::vistaOSAtrTablaModel("ordenServicio");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
        return $respuesta;
    }



	#BORRAR ORDEN DE SERVICIO
	#------------------------------------
	public function borrarOSAtrController(){
        require_once "./models/crud.php";
		if(isset($_POST["id_os_borrar"])){
			$datosController = $_POST["id_os_borrar"];
			$respuesta2 = Datos::borrarPartidasOSAtrModel($datosController, "partidas_os");
            $respuesta3 = Datos::borrarOSAtrModel($datosController, "ordenServicio");
            echo '<script>
                alert("Se ELIMINO la OS  y sus partidas correctamente");
                setTimeout("location.href ='."'index.php?action=OrdenesServicio/listadoOS'".'"'.', 200);
            </script>';
        }
    }
	
	#VISTA DE UNIDADES PARA CARGARLOS A UNA NUEVA ORDEN DE SERVICIO
	#------------------------------------
	public static function vistaUnidadesSelectController(){
		require_once "./models/crud.php";
		$respuesta = Datos::vistaUnidadesModel("unidades");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
		echo"<option value='0' selected disabled> Selecciona una unidad ... </option>";
		foreach($respuesta as $row => $item){
				echo"<option value='". $item['id_unidad']."'>".$item['num_unidad']."</option>";
		}
	}
	
	#VISTA DE UNIDADES MAZDA PARA CARGARLOS A UNA NUEVA ORDEN DE SERVICIO
	#------------------------------------
	public static function vistaUnidadesMazdaSelectController(){
		require_once "./models/crud.php";
		$respuesta = Datos::vistaUnidadesMazdaModel("unidades");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
		echo"<option value='0' selected disabled> Selecciona una unidad ... </option>";
		foreach($respuesta as $row => $item){
				echo"<option value='". $item['id_unidad']."'>".$item['num_unidad']."</option>";
		}
	}
    
    #VISTA DE UNIDADES MAZDA PARA CARGARLOS A UNA NUEVA ORDEN DE SERVICIO
	#------------------------------------
	public static function vistaUnidadesMazdaSelectedController($unidad){
		require_once "./models/crud.php";
		$respuesta = Datos::vistaUnidadesMazdaModel("unidades");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
		foreach($respuesta as $row => $item){
            if($unidad == $item['id_unidad'])
                echo"<option value='". $item['id_unidad']."' selected>".$item['num_unidad']."</option>";
            else
				echo"<option value='". $item['id_unidad']."'>".$item['num_unidad']."</option>";
		}
	}

	#VISTA DE SERVICIOS ATR PARA CARGARLOS A UNA NUEVA ORDEN DE SERVICIO
	#------------------------------------
	public static function vistaServiciosAtrSelectController(){
		require_once "./models/crud.php";
		$respuesta = Datos::vistaServiciosAtrSelectModel("servicios_atr");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
		echo"<option value='0' selected disabled> Selecciona un servicio ... </option>";
		foreach($respuesta as $row => $item){
				echo"<option value='". $item['codigo_atr_serv']."' data-name='". utf8_encode($item['descripcion_serv'])."'>".$item['codigo_atr_serv']."</option>";
		}
	}

	 #REGISTRO DE OS Y PARTIDAS
	#------------------------------------
	public static function registroOSAtrController(){
		require_once "./models/crud.php";
		if(isset($_POST["num_orden"])){
			$datosController = array( "num_orden"=>$_POST["num_orden"], 
								      "id_unidad_servicio"=>$_POST["id_unidad_servicio"],
                                    "operador"=>strtoupper($_POST["operador"]),
									"captura"=>strtoupper($_POST["captura"]),
									"fecha_orden"=>$_POST["fecha_orden"],
									"kilometraje"=>$_POST["kilometraje"],
									"servicio"=>strtoupper($_POST["servicio"]),
									"tipo_servicio"=>strtoupper($_POST["tipo_servicio"]));
			$respuesta = Datos::registroOSAtrModel($datosController, "ordenServicio");
			$partidas = $_POST["partidas"];
			$observacionesPartidas = $_POST["observacionesPartidas"];
			if($respuesta == "success"){
				$i =0;
				foreach($partidas as $partida){
					$datosController2 = array("consec_partida_os" => ($i+1),
											"codigo_partida_os" => $partida,
											"observaciones_os" => $observacionesPartidas[$i],
											"num_orden_partida_os" => $_POST["num_orden"]);
					$respuesta2 = Datos::registroPartidaOSModel($datosController2, "partidas_os");
					$i++;
				}
				echo '<script>
                        alert("Se inserto la OS correctamente");
                        setTimeout("location.href ='."'index.php?action=OrdenesServicio/listadoOS'".'"'.', 200);
                    </script>';
      
			}else{
				echo "<p class='error-acceso'>".$respuesta[2]."</p>";
			}
		}
	}

	  #EDITAR OS
	  public static function editarOSAtrController(){
        require_once "./models/crud.php";
        $datosController = $_GET["id_os_editar"];
        $respuesta = Datos::editarOSAtrModel($datosController, "ordenServicio");
        return $respuesta;
    }


	#VISTA PARA OBTENER LAS UNIDADES Y VALIDAR LA QUE SE NECESITA SELECCIONAR
	#------------------------------------
	public static function vistaUnidadesSelectedController($id_unidad){
		require_once "./models/crud.php";
		$respuesta = Datos::vistaUnidadesModel("unidades");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
		foreach($respuesta as $row => $item){
			if($id_unidad ==  $item['id_unidad'])
				echo"<option value='". $item['id_unidad']."' SELECTED>".$item['num_unidad']."</option>";
			else
				echo"<option value='". $item['id_unidad']."'>".$item['num_unidad']."</option>";
		}
	}

	#OBTENEMOS LOS VALORES ENUM DEL CAMPO SERVICIO DE LA TABLA ORDEN DE SERVICIO
	public static function obtenerServiciosOSController(){
        require_once "./models/crud.php";
		$respuesta = Datos::obtenerServiciosOSModel("servicio", "ordenServicio");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
        return $respuesta;
    }

	#OBTENEMOS LOS VALORES ENUM DEL CAMPO TIPO_SERVICIO DE LA TABLA ORDEN DE SERVICIO
	public static function obtenerTipoServOSController(){
        require_once "./models/crud.php";
		$respuesta = Datos::obtenerTipoServOSModel("tipo_servicio", "ordenServicio");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
        return $respuesta;
    }

	#OBTENEMOS LAS PARTIDAS DE LA ORDEN DE SERVICIO, INDICAMOS EL NUM_ORDEN Y LA TABLA
	public static function editarPartidasOSController(){
        require_once "./models/crud.php";
		$datosController = $_GET["id_os_editar"];		
		$respuesta = Datos::obtenerPartidasOSModel($datosController, "partidas_os");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
        return $respuesta;
    }

	public static function obtenerOSPendientesController(){
        require_once "./models/crud.php";
		$respuesta = Datos::obtenerOSPendientesModel("ordenServicio");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
		echo"<option value='0' selected disabled>Selecciona una Unidad ... </option>";
		foreach($respuesta as $row => $item){
				echo"<option value='". $item['num_orden']."' data-os='". $item['num_orden']."'>".$item['id_unidad_servicio']."</option>";
		}
    }

	#ACTUALIZAR SERVICIO ATR
	#------------------------------------
	public function obtenerPartidaOSController(){
		require_once "./models/crud.php";
		if(isset($_POST["id_unidad_editar"])){
			$datosController = array( "num_orden_partida_os"=>$_POST["num_orden_partida_os"],
							          "codigo_partida_os"=>$_POST["codigo_partida_os"]);
			$respuesta = Datos::obtenerPartidaOSModel($datosController, "partidas_os");
			if($respuesta == "success"){
				echo "<span class='registro-actualizado'>Actualizacion Correcta</span>";
                echo '<script> setTimeout("location.href ='."'index.php?action=Unidades/listadoUnidades'".'"'.', 200);</script>';
            } else {
				echo "<p class='error-acceso'>". $respuesta[2]."</p>";
			}
		}
	}

	#CARGAMOS LOS TRABJADORES NUMERO - APELLIDOS Y NOMBRES PARA INICIAR SERVICIO
	public static function obtenerTrabajadorController(){
        require_once "./models/crud.php";
		$respuesta = Datos::vistaTrabajadorAtrModel("usuarios");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
		echo"<option value='0' selected disabled>Selecciona una trabajador ... </option>";
		foreach($respuesta as $row => $item){
				echo"<option value='". $item['id_usuario']."'>".$item['usuario']." - ".$item['ape_pat_u']. " " . $item['ape_mat_u']. " " . $item['nombre_u']."</option>";
		}
    }


	 #INICIAMOS EL SERVICIO ENVIANDO COMENTARIOS DE INCIO E INDICANDO UN USUARIO A REALIZAR LA ACTIVIDAD
	#------------------------------------
	public function iniciarServicioController(){
		require_once "./models/crud.php";
		if(isset($_POST["id_partida_os"])){
			$datosController = array( "id_partida_os"=>$_POST["id_partida_os"],
							          "comentarios_os"=>$_POST["comentarios_os"]);
			$respuesta = Datos::iniciarServicioModel($datosController, "partidas_os");
            $usuariosAgisnados = $_POST["usuariosAsignados"];


			 if($respuesta == "success"){                
                foreach($usuariosAgisnados as $usuarioAsignado){
                    $datosController2 = array("id_partida_os"=> $_POST["id_partida_os"],
                                                "usuario" => $usuarioAsignado);                    
                    $respuesta2 = Datos::asigarUsuariosIniciarServicioModel($datosController2, "usuario_partida_os");
                    $respuesta3 = Datos::empezarOSModel($_POST["orden_servicio_a"]);
                }               
                echo '<script>
						alert("Se INICIO el servicio correctamente");
						setTimeout("location.href ='."'index.php?action=OrdenesServicio/listadoOS'".'"'.', 200);
					</script>';
            } else {
				echo "<p class='error-acceso'>". $respuesta[2]."</p>";
			}
		}
    }

    
    #ACTUALIZAR SERVICIO ATR
	#------------------------------------
	public function obtenerPartidaOSFinalizarController(){
		require_once "./models/crud.php";
		if(isset($_POST["id_partida_os"])){
			$datosController = array( "num_orden_partida_os"=>$_POST["id_partida_os"],
							          "codigo_partida_os"=>$_POST["comentarios_os"]);
			$respuesta = Datos::obtenerPartidaOSFinalizarModel($datosController, "partidas_os");
			if($respuesta == "success"){
                echo '<script>
						alert("Se INICIO el servicio correctamente");
						setTimeout("location.href ='."'index.php?action=OrdenesServicio/iniciarServicio'".'"'.', 200);
					</script>';
            } else {
				echo "<p class='error-acceso'>". $respuesta[2]."</p>";
			}
		}

		}

    #FINALIZAMOS EL SERVICIO ENVIANDO COMENTARIOS DE FINALIZAR Y ACTUALIZAMOS EL ESTATUS DE PROGRESO
	#------------------------------------
	public function finalizarServicioController(){
        require_once "./models/crud.php";
		if(isset($_POST["num_orden_finalizar"])){
			$datosController = array( "id_partida_os"=>$_POST["id_partida_os_f"],
							          "comentario_final"=>$_POST["observacion_final_os_f"]);
			$respuesta = Datos::finalizarSevicioModel($datosController, "partidas_os");
			if($respuesta == "success"){
                $respuesta2 = Datos::actualizarPorcentajeGral($_POST["num_orden_finalizar"]);
                if($respuesta2 == "success" )
                    $respuesta3 = Datos::cerrarOSModel($_POST["num_orden_finalizar"]);
                else{
                    echo "<p class='error-acceso'>". $respuesta2[2]."</p>";
                }
                echo '<script>
						alert("Se FINALIZO el servicio correctamente");
						setTimeout("location.href ='."'index.php?action=OrdenesServicio/listadoOS'".'"'.', 200);
					</script>';
            } else {
				echo "<p class='error-acceso'>". $respuesta[2]."</p>";
			}
		}	
	}
    
    #INICIAMOS EL SERVICIO DESDE EL DETALLE DE SERVICIOS CON UNA MODAL DONDE SOLO SE PIDE LOS COMENTARIOS INCIALES.
    # Y LOS USUARIOS A REALIZAR LA ACTIVIDAD
    public function iniciarServicioModalController(){
		require_once "./models/crud.php";
		if(isset($_POST["id_partida_os_i"])){
			$datosController = array( "id_partida_os"=>$_POST["id_partida_os_i"],
							          "comentarios_os"=>$_POST["comentarios_os"]);
			$respuesta = Datos::iniciarServicioModel($datosController, "partidas_os");
            $usuariosAgisnados = $_POST["usuariosAsignadosInicio"];
            if($respuesta == "success"){                
                foreach($usuariosAgisnados as $usuarioAsignado){
                    $datosController2 = array("id_partida_os"=> $_POST["id_partida_os_i"],
                                                "usuario" => $usuarioAsignado);                    
                    $respuesta2 = Datos::asigarUsuariosIniciarServicioModel($datosController2, "usuario_partida_os");
                    $respuesta3 = Datos::empezarOSModel($_POST["num_orden_iniciar"]);
                }
                if($respuesta2 == "success" && $respuesta3 == "success"){
                    $link = "index.php?action=OrdenesServicio/listadoOS";
                    echo '<script>
                            var x = document.getElementById("openModalIniciar");
                            x.style.display = "none";    
                            registroOK('."'".$link."'".');
                        </script>';
                }else{
                    $valor = $respuesta[2];
                    $error = str_replace("'", "", $valor);
                    echo '<script>
                            var x = document.getElementById("openModalIniciar");
                            x.style.display = "none";              
                            errorRegistro('."'".$error."','".$link."'".');
                    </script>';
			    }
            }
		}
	}


    #OBTENER LOS USUARIOS QUE HAN REALIZADO DICHA ACTIVIDAD
	#OBTENEMOS LOS VALORES ENUM DEL CAMPO TIPO_SERVICIO DE LA TABLA ORDEN DE SERVICIO
	public static function obtenerUsuariosAsignadosController($id_partida_servicio){
        require_once "./models/crud.php";     
		$respuesta = Datos::obtenerUsuariosAsignadosModel("usuario_partida_os", $id_partida_servicio);
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
        return $respuesta;
    }

    
    public static function obtenerSupervisorAsignadosController($id_partida_servicio){
        require_once "./models/crud.php";       
		$respuesta = Datos::obtenerSupervisorAsignadosModel("usuario_partida_os", $id_partida_servicio);
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
        return $respuesta;
    }

    public function finalizarServicioModalController(){
		require_once "./models/crud.php";
		if(isset($_POST["num_orden_finalizar"])){
			$datosController = array( "id_partida_os"=>$_POST["id_partida_os_f"],
							          "comentario_final"=>$_POST["observacion_final_os_f"]);
			$respuesta = Datos::finalizarSevicioModel($datosController, "partidas_os");
			if($respuesta == "success"){
                $respuesta2 = Datos::actualizarPorcentajeGral($_POST["num_orden_finalizar"]);
                if($respuesta2 == "success" )
                    $respuesta3 = Datos::cerrarOSModel($_POST["num_orden_finalizar"]);
                else{
                    echo "<p class='error-acceso'>". $respuesta2[2]."</p>";
                }
                echo '<script>
						alert("Se FINALIZO el servicio correctamente");
						location.href = "index.php?action=OrdenesServicio/detalleOS&id_os_editar='.$_POST["num_orden_finalizar"].'";
					</script>';
            } else {
				echo "<p class='error-acceso'>". $respuesta[2]."</p>";
			}
		}
	}

    #OBTENER LAS OS DE EN PROCESO PARA POSTERIORMENTE OBTENER LAS PARTIDAS EN PROCESO Y PODER ASIGNAR UN(OS) USUARIO(S) AL SERVICIO
    public static function obtenerOSEnProcesoController(){
        require_once "./models/crud.php";
		$respuesta = Datos::obtenerOSEnProcesoModel("ordenServicio");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
		echo"<option value='0' selected disabled>Selecciona una Unidad ... </option>";
		foreach($respuesta as $row => $item){
				echo"<option value='". $item['num_orden']."' data-os='". $item['num_orden']."'>".$item['id_unidad_servicio']."</option>";
		}
    }

    #ASIGNAR USUARIOS DESDE LA VENTANA ASIGNAR USUARIOS
    public function asignarUsuariosServicioController(){
		require_once "./models/crud.php";
		if(isset($_POST["id_partida_os_asignar"])){
            $usuariosAgisnados = $_POST["usuariosAsignados"]; 
            foreach($usuariosAgisnados as $usuarioAsignado){
                    $datosController2 = array("id_partida_os"=> $_POST["id_partida_os_asignar"],
                                                "usuario" => $usuarioAsignado);                    
                    $respuesta2 = Datos::asigarUsuariosIniciarServicioModel($datosController2, "usuario_partida_os");
            }               
            echo '<script>
			    	alert("Asignacion Correcta");
					setTimeout("location.href ='."'index.php?action=OrdenesServicio/asignarUsuarios'".'"'.', 200);
				</script>';
        } else {
			echo "<p class='error-acceso'>". $respuesta[2]."</p>";
		}
	}

    #VITA DE LA LISTA DE SERVICIOS EN PROCESO
    public static function vistaPartidasEnProcesoController(){
        require_once "./models/crud.php";
		$respuesta = Datos::vistaPartidasEnProcesoAtrTablaModel("partidas_os");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
        return $respuesta;
    }

    #ASIGNAR USUARIOS DESDE LA VENTA DE LISTADO DE SERVICIOS EN PROCESO
    public function asignarUsuariosServicioListadoController(){
		require_once "./models/crud.php";
		if(isset($_POST["id_partida_os_asignar"])){
            $usuariosAgisnados = $_POST["usuariosAsignados"]; 
            foreach($usuariosAgisnados as $usuarioAsignado){
                    $datosController2 = array("id_partida_os"=> $_POST["id_partida_os_asignar"],
                                                "usuario" => $usuarioAsignado);                    
                    $respuesta = Datos::asigarUsuariosIniciarServicioModel($datosController2, "usuario_partida_os");
            }               
            if($respuesta == "success"){
                echo "";
            } else {
			echo "<p class='error-acceso'>". $respuesta[2]."</p>";
		    }
        }
	}    

    
    //BUSQUEDA DE HISTORIAL PERSONALIZADA
    public function vistaOSAtrTablaBusquedaController(){
        require_once "./models/crud.php";
		if(isset($_POST["valor_buscado_text"])){
            $datosController = array("campo_buscado"=> $_POST["campo_buscado"],
                                                "valor" => $_POST['valor_buscado_text']); 
            $respuesta = Datos::vistaOSAtrTablaBusquedaModel($datosController, "ordenServicio"); 
            if(isset($respuesta)){
                return $respuesta;
            }else{
                echo "<p class='error-acceso'>". $respuesta[2]."</p>";
            }
        }
    }

    #ACTUALIZAR USUARIO
	#------------------------------------
	public function actualizarOSAtrController(){
		require_once "./models/crud.php";
		if(isset($_POST["num_orden_e"])){
			$datosController = array( "num_orden"=>$_POST["num_orden_e"], 
								      "id_unidad_servicio"=>$_POST["id_unidad_servicio"],
                                    "operador"=>strtoupper($_POST["operador"]),
									"captura"=>strtoupper($_POST["captura"]),
									"fecha_orden"=>$_POST["fecha_orden"],
									"kilometraje"=>$_POST["kilometraje"],
									"servicio"=>strtoupper($_POST["servicio"]),
									"tipo_servicio"=>strtoupper($_POST["tipo_servicio"]),
                                    "servicio_tiempo"=>strtoupper($_POST["servicio_tiempo"]));
			$respuesta = Datos::actualizarOSAtrModel($datosController, "ordenServicio");
			$link = "index.php?action=OrdenesServicio/listadoOS";
			if($respuesta == "success"){
                if(isset($_POST["partidas"])){
                    $partidas = $_POST["partidas"];
			        $observacionesPartidas = $_POST["observacionesPartidas"];
                    $consecutivos = $_POST["consecutivos"];
                    $i =0;
                    foreach($partidas as $partida){
                        $datosController2 = array("consec_partida_os" => $consecutivos[$i],
                                                "codigo_partida_os" => $partida,
                                                "observaciones_os" => $observacionesPartidas[$i],
                                                "num_orden_partida_os" => $_POST["num_orden_e"]);
                        $respuesta2 = Datos::registroPartidaOSModel($datosController2, "partidas_os");
                        $i++;
                    }
                    if($respuesta2 == "success"){
                        echo "  <script>
                                    actualizarOK('".$link."');
                                </script>";
                    }else{ 
                        $valor = $respuesta2[2];
                        $error = str_replace("'", "", $valor);
                        echo '<script>
                                errorRegistro('."'".$error."','".$link."'".');
                            </script>';
                    }
                } else{
                echo "<script>
                        actualizarOK('".$link."');
                    </script>";
                }
			}else{
                $valor = $respuesta[2];
                $error = str_replace("'", "", $valor);
                echo '<script>
                        errorRegistro('."'".$error."','".$link."'".');
                </script>';
			}
		}
	}



     #REGISTRO DE OS Y PARTIDAS
	#------------------------------------
	public static function registroChecklistController(){
		require_once "./models/crud.php";
		if(isset($_POST["fecha_checklist"])){
			$datosController = array( "fecha_checklist"=>$_POST["fecha_checklist"], 
								      "id_usuario_realiza"=>$_POST["id_usuario"],
                                    "kilometraje"=>$_POST["kilometraje_checklist"],
									"unidad_mazda"=>$_POST["unidad_checklist"],
									"observaciones"=>strtoupper($_POST["observaciones_checklist"]));
			$respuesta = Datos::registroChecklistModel($datosController, "checklist_mazda");
            $id;
            foreach($respuesta as $row => $item){
                $id = $item["id"];
            }

            $partes[] = "CRISTALES";
            $estados[] = $_POST["cristales_estado"]; 
            $partes[] = "ESPEJOS";
            $estados[] = $_POST["espejos_estado"]; 
            $partes[] = "PARABRISAS";
            $estados[] = $_POST["parabrisas_estado"];
            $partes[] = "BATERIAS"; 
            $estados[] = $_POST["baterias_estado"]; 
            $partes[] = "ENCENDIDO DE LUCES";
            $estados[] = $_POST["luces_estado"]; 
            $partes[] = "PLAFONES";
            $estados[] = $_POST["plafones_estado"];
            $partes[] = "LUZ DE TRABAJO"; 
            $estados[] = $_POST["luz_trabajo_estado"];
            $partes[] = "NIVEL DE MOTOR";
            $estados[] = $_POST["motor_estado"]; 
            $partes[] = "NIVEL DE ANTICONGELANTE";
            $estados[] = $_POST["anticongelante_estado"]; 
            $partes[] = "NIVEL DE DIRECCION HD";
            $estados[] = $_POST["direccion_estado"]; 
            $partes[] = "CLUTCH";
            $estados[] = $_POST["clutch_estado"];
            $partes[] = "ADMISION"; 
            $estados[] = $_POST["admision_estado"];
            $partes[] = "BANDAS";
            $estados[] = $_POST["bandas_estado"];
            $partes[] = "FUGA ACEITE MOTOR";
            $estados[] = $_POST["f_motor_estado"];
            $partes[] = "FUGA ACEITE TRANSMISION";
            $estados[] = $_POST["transmision_estado"];
            $partes[] = "FUGA ACEITE DIFERENCIAL";
            $estados[] = $_POST["diferencial_estado"];
            $partes[] = "PASAMUROS ELECTRICO";
            $estados[] = $_POST["r_pasamuros_electrico_estado"];
            $partes[] = "PASAMUROS HIDRAULICO";
            $estados[] = $_POST["r_pasamuros_hidraulico_estado"];
            $partes[] = "PASAMUROS NEUMATICO";
            $estados[] = $_POST["r_pasamuros_neumatico_estado"];
            $partes[] = "TAPAS1";
            $estados[] = $_POST["t1_estado"];
            $partes[] = "TAPAS2";
            $estados[] = $_POST["t2_estado"];
            $partes[] = "TAPAS3";
            $estados[] = $_POST["t3_estado"];
            $partes[] = "TAPAS4";
            $estados[] = $_POST["t4_estado"];
            $partes[] = "TAPAS5";
            $estados[] = $_POST["t5_estado"];
            $partes[] = "TAPAS6";
            $estados[] = $_POST["t6_estado"];
            $partes[] = "TAPAS7";
            $estados[] = $_POST["t7_estado"];
            $partes[] = "TAPAS8";
            $estados[] = $_POST["t8_estado"];
            $partes[] = "TAPAS9";           
            $estados[] = $_POST["t9_estado"];
            $partes[] = "TAPAS10";
            $estados[] = $_POST["t10_estado"];
            for ($i=1; $i <= 18 ; $i++) { 
                $partes[] = "LLANTAS".$i;
            }
            for ($i=1; $i <= 18 ; $i++) { 
                $llanta = "llanta_".$i."_estado";
                $estados[] = $_POST[$llanta];
            }
            $partes[] = "ARRANQUE";
            $estados[] = $_POST["arranque_estado"];
            $partes[] = "TAKE OFF";
            $estados[] = $_POST["take_off_estado"];
            $partes[] = "PISO TRACTOR";
            $estados[] = $_POST["piso_tractor_estado"];
            $partes[] = "PISO REMOLQUE";
            $estados[] = $_POST["piso_remolque_estado"];
            $partes[] = "BLOQUE HD TRACTOR";
            $estados[] = $_POST["bloque_hd_tractor_estado"];
            $partes[] = "BLOQUE HD REMOLQUE";
            $estados[] = $_POST["bloque_hd_remolque_estado"];
            for ($i=1; $i <= 30 ; $i++) { 
                $partes[] = "RAMPAS".$i;
            }
            for ($i=1; $i <= 30 ; $i++) { 
                $rampa = "rampa_".$i."_estado"; 
                $estados[] = $_POST[$rampa];
            }
            for ($i=1; $i <= 30 ; $i++) { 
                $partes[] = "PISTONES".$i;
            }
            for ($i=1; $i <= 30 ; $i++) { 
                $piston  = "piston_".$i."_estado";
                $estados[] = $_POST[$piston];
            }
            $partes[] = "CINCHOS DE TRINCADO";
            $estados[] = $_POST["cinchos_trincado_estado"];
            $partes[] = "TENDEDEROS";
            $estados[] = $_POST["tendederos_estado"];
            $partes[] = "MALLA CUBRE AL 100";
            $estados[] = $_POST["malla_estado"];
            $partes[] = "MARCA EN PTR";           
            $estados[] = $_POST["ptr_estado"];
            $partes[] = "CADENA DE TRINCADO";
            $estados[] = $_POST["cadena_trincado_estado"];


            $observaciones[] = $_POST["cristales_observ"]; 
            $observaciones[] = $_POST["espejos_observ"]; 
            $observaciones[] = $_POST["parabrisas_observ"]; 
            $observaciones[] = $_POST["baterias_observ"]; 
            $observaciones[] = $_POST["luces_observaciones"]; 
            $observaciones[] = $_POST["plafones_observ"]; 
            $observaciones[] = $_POST["luz_trabajo_estado_observ"]; 
            $observaciones[] = $_POST["motor_observ"]; 
            $observaciones[] = $_POST["anticongelante_observ"]; 
            $observaciones[] = $_POST["direccion_observ"]; 
            $observaciones[] = $_POST["clutch_observ"]; 
            $observaciones[] = $_POST["admision_observ"]; 
            $observaciones[] = $_POST["bandas_observ"]; 
            $observaciones[] = $_POST["f_motor_observ"]; 
            $observaciones[] = $_POST["transmision_observ"]; 
            $observaciones[] = $_POST["diferencial_observ"]; 
            $observaciones[] = $_POST["r_pasamuros_electrico_obser"]; 
            $observaciones[] = $_POST["r_pasamuros_hidraulico_observ"]; 
            $observaciones[] = $_POST["r_pasamuros_neumatico_observ"]; 
            $observaciones[] = $_POST["t1_observ"]; 
            $observaciones[] = $_POST["t2_observ"]; 
            $observaciones[] = $_POST["t3_observ"]; 
            $observaciones[] = $_POST["t4_observ"]; 
            $observaciones[] = $_POST["t5_observ"]; 
            $observaciones[] = $_POST["t6_observ"]; 
            $observaciones[] = $_POST["t7_observ"]; 
            $observaciones[] = $_POST["t8_observ"]; 
            $observaciones[] = $_POST["t9_observ"]; 
            $observaciones[] = $_POST["t10_observ"]; 
            for ($i=1; $i <= 18 ; $i++) { 
                $llanta = "llanta_".$i."_observ";
                $observaciones[] = $_POST[$llanta];
            }
            $observaciones[] = $_POST["arranque_observaciones"];
            $observaciones[] = $_POST["take_off_observ"];
            $observaciones[] = $_POST["piso_tractor_observ"];
            $observaciones[] = $_POST["piso_remolque_observ"];
            $observaciones[] = $_POST["bloque_hd_tractor_observ"];
            $observaciones[] = $_POST["bloque_hd_remolque_observ"];
            for ($i=1; $i <= 30 ; $i++) { 
                $rampa = "rampa_".$i."_observ";
                $observaciones[] = $_POST[$rampa];
            }
            for ($i=1; $i <= 30 ; $i++) { 
                $piston = "piston_".$i."_observ";
                $observaciones[] = $_POST[$piston];
            }
            $observaciones[] = $_POST["cinchos_trincado_observ"];
            $observaciones[] = $_POST["tendederos_observ"];
            $observaciones[] = $_POST["malla_observ"];
            $observaciones[] = $_POST["ptr_observ"];
            $observaciones[] = $_POST["cadena_trincado_observ"];

            $i =0;
            foreach($partes as $parte){
                $datosController2 = array("id_checklist_partidas"=>$id,
                                        "parte_revisada"=>$partes[$i],
                                        "estado_general"=>$estados[$i],
                                        "observaciones_partida"=>$observaciones[$i]);
                $respuesta = Datos::registroPartidasChecklistModel($datosController2, "partidas_checklist");
                $i++;
            }
            $link = "index.php?action=CheckLists/altaCheckListMazda";
            if($respuesta == "success"){
                echo "<script>
                        registroOK('".$link."');
                    </script>";
            } else{           
                $valor = $respuesta[2];
                $error = str_replace("'", "", $valor);
                echo '<script>
                        errorRegistro('."'".$error."','".$link."'".');
                </script>';
            }
        }
    }

	public static function vistaChecklistTablaController(){
        require_once "./models/crud.php";
		$respuesta = Datos::vistaChecklistTablaModel("checklist_mazda");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
        return $respuesta;
    }
    
    public static function vistaDetalleChecklistTablaController($datos){
        require_once "./models/crud.php";
		$respuesta = Datos::vistaDetalleChecklistTablaModel("partidas_checklist", $datos);
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
        return $respuesta;
    }

    #BORRAR ORDEN DE SERVICIO
	#------------------------------------
	public function borrarChecklistController(){
        require_once "./models/crud.php";
		if(isset($_POST["id_checklist_borrar"])){
			$datosController = $_POST["id_checklist_borrar"];
			$respuesta2 = Datos::borrarPartidasChecklistModel($datosController, "partidas_checklist");
            $respuesta3 = Datos::borrarChecklistModel($datosController, "checklist_mazda");
            $link = "index.php?action=CheckLists/listadoCheckListMazda";
            if($respuesta2 == "success" && $respuesta3 == "success"){
                echo '<script>
                        var x = document.getElementById("openModalEliminar");
                        x.style.display = "none";    
                        borrarOk('."'".$link."'".');
                    </script>';
            } else{           
                $valor = $respuesta2[2];
                $valor2 = $respuesta3[2];
                $error2 = str_replace("'", "", $valor2);
                $error = str_replace("'", "", $valor);
                echo '<script>
                        var x = document.getElementById("openModalEliminar");
                        x.style.display = "none";              
                        errorRegistro('."'".$error."/".$error2."','".$link."'".');
                </script>';
            }
        }
    }

    #EDITAR OS
	public static function editarChecklistController(){
        require_once "./models/crud.php";
        $datosController = $_GET["id_checklist_editar"];
        $respuesta = Datos::editarCheckListModel($datosController, "checklist_mazda");
        return $respuesta;
    }

    #EDITAR OS
    public static function editarPartidasChecklistController(){
        require_once "./models/crud.php";
        $datosController = $_GET["id_checklist_editar"];
        $respuesta = Datos::vistaDetalleChecklistTablaModel($datosController, "partidas_checklist");
        return $respuesta;
    }

    public static function actualizarChecklistController(){
        require_once "./models/crud.php";
		if(isset($_POST["id_checklist_editar"])){
			$datosController = array( "id_checklist_editar"=>$_POST["id_checklist_editar"], 
								      "fecha_checklist"=>$_POST["fecha_checklist"],
                                    "kilometraje_checklist"=>$_POST["kilometraje_checklist"],
									"unidad_checklist"=>$_POST["unidad_checklist"],
									"observaciones_checklist"=>strtoupper($_POST["observaciones_checklist"]));
			$respuesta = Datos::actualizarChecklistModel($datosController, "checklist_mazda");
            if($respuesta == "success"){           
                $estados[] = $_POST["cristales_estado"]; 
                $estados[] = $_POST["espejos_estado"]; 
                $estados[] = $_POST["parabrisas_estado"];
                $estados[] = $_POST["baterias_estado"]; 
                $estados[] = $_POST["luces_estado"]; 
                $estados[] = $_POST["plafones_estado"];
                $estados[] = $_POST["luz_trabajo_estado"];
                $estados[] = $_POST["motor_estado"];
                $estados[] = $_POST["anticongelante_estado"]; 
                $estados[] = $_POST["direccion_estado"]; 
                $estados[] = $_POST["clutch_estado"];
                $estados[] = $_POST["admision_estado"];
                $estados[] = $_POST["bandas_estado"];
                $estados[] = $_POST["f_motor_estado"];
                $estados[] = $_POST["transmision_estado"];
                $estados[] = $_POST["diferencial_estado"];
                $estados[] = $_POST["r_pasamuros_electrico_estado"];
                $estados[] = $_POST["r_pasamuros_hidraulico_estado"];
                $estados[] = $_POST["r_pasamuros_neumatico_estado"];
                $estados[] = $_POST["t1_estado"];
                $estados[] = $_POST["t3_estado"];
                $estados[] = $_POST["t5_estado"];
                $estados[] = $_POST["t7_estado"];
                $estados[] = $_POST["t9_estado"];
                $estados[] = $_POST["t2_estado"];
                $estados[] = $_POST["t4_estado"];
                $estados[] = $_POST["t6_estado"];
                $estados[] = $_POST["t8_estado"];         
                $estados[] = $_POST["t10_estado"];
                for ($i=1; $i <= 17 ; $i+=2) { 
                    $llanta = "llanta_".$i."_estado";
                    $estados[] = $_POST[$llanta];
                }
                for ($i=2; $i <= 18 ; $i+=2) { 
                    $llanta = "llanta_".$i."_estado";
                    $estados[] = $_POST[$llanta];
                }
                $estados[] = $_POST["arranque_estado"];
                $estados[] = $_POST["take_off_estado"];
                $estados[] = $_POST["piso_tractor_estado"];
                $estados[] = $_POST["piso_remolque_estado"];
                $estados[] = $_POST["bloque_hd_tractor_estado"];
                $estados[] = $_POST["bloque_hd_remolque_estado"];
                for ($i=1; $i <= 30 ; $i++) { 
                    $rampa = "rampa_".$i."_estado"; 
                    $estados[] = $_POST[$rampa];
                }
                for ($i=1; $i <= 30 ; $i++) { 
                    $piston  = "piston_".$i."_estado";
                    $estados[] = $_POST[$piston];
                }
                $estados[] = $_POST["cinchos_trincado_estado"];
                $estados[] = $_POST["tendederos_estado"];
                $estados[] = $_POST["malla_estado"];          
                $estados[] = $_POST["ptr_estado"];
                $estados[] = $_POST["cadena_trincado_estado"];
                #OBSERVACIONES
                $observaciones[] = $_POST["cristales_observ"]; 
                $observaciones[] = $_POST["espejos_observ"]; 
                $observaciones[] = $_POST["parabrisas_observ"]; 
                $observaciones[] = $_POST["baterias_observ"]; 
                $observaciones[] = $_POST["luces_observaciones"]; 
                $observaciones[] = $_POST["plafones_observ"]; 
                $observaciones[] = $_POST["luz_trabajo_estado_observ"]; 
                $observaciones[] = $_POST["motor_observ"]; 
                $observaciones[] = $_POST["anticongelante_observ"]; 
                $observaciones[] = $_POST["direccion_observ"]; 
                $observaciones[] = $_POST["clutch_observ"]; 
                $observaciones[] = $_POST["admision_observ"]; 
                $observaciones[] = $_POST["bandas_observ"]; 
                $observaciones[] = $_POST["f_motor_observ"]; 
                $observaciones[] = $_POST["transmision_observ"]; 
                $observaciones[] = $_POST["diferencial_observ"]; 
                $observaciones[] = $_POST["r_pasamuros_electrico_obser"]; 
                $observaciones[] = $_POST["r_pasamuros_hidraulico_observ"]; 
                $observaciones[] = $_POST["r_pasamuros_neumatico_observ"]; 
                $observaciones[] = $_POST["t1_observ"]; 
                $observaciones[] = $_POST["t3_observ"]; 
                $observaciones[] = $_POST["t5_observ"];
                $observaciones[] = $_POST["t7_observ"]; 
                $observaciones[] = $_POST["t9_observ"]; 
                $observaciones[] = $_POST["t2_observ"]; 
                $observaciones[] = $_POST["t4_observ"];
                $observaciones[] = $_POST["t6_observ"]; 
                $observaciones[] = $_POST["t8_observ"]; 
                $observaciones[] = $_POST["t10_observ"]; 
                for ($i=1; $i <= 17 ; $i+=2) { 
                    $llanta = "llanta_".$i."_observ";
                    $observaciones[] = $_POST[$llanta];
                }
                for ($i=2; $i <= 18 ; $i+=2) { 
                    $llanta = "llanta_".$i."_observ";
                    $observaciones[] = $_POST[$llanta];
                }

                $observaciones[] = $_POST["arranque_observaciones"];
                $observaciones[] = $_POST["take_off_observ"];
                $observaciones[] = $_POST["piso_tractor_observ"];
                $observaciones[] = $_POST["piso_remolque_observ"];
                $observaciones[] = $_POST["bloque_hd_tractor_observ"];
                $observaciones[] = $_POST["bloque_hd_remolque_observ"];
                for ($i=1; $i <= 30 ; $i++) { 
                    $rampa = "rampa_".$i."_observ";
                    $observaciones[] = $_POST[$rampa];
                }
                for ($i=1; $i <= 30 ; $i++) { 
                    $piston = "piston_".$i."_observ";
                    $observaciones[] = $_POST[$piston];
                }
                $observaciones[] = $_POST["cinchos_trincado_observ"];
                $observaciones[] = $_POST["tendederos_observ"];
                $observaciones[] = $_POST["malla_observ"];
                $observaciones[] = $_POST["ptr_observ"];
                $observaciones[] = $_POST["cadena_trincado_observ"];
                $partidas = $_POST["partidas"];
                $i=0;
                foreach($partidas as $partida){
                    $datosController2 = array("id_partida"=>$partida,
                                        "estado_general"=>$estados[$i],
                                        "observaciones_partida"=>$observaciones[$i]);
                                      
                    $respuesta2 = Datos::actualizarPartidasChecklistModel($datosController2, "partidas_checklist");
                    $i++;
                }            
                $link = "index.php?action=CheckLists/listadoCheckListMazda";
                if($respuesta2 == "success"){     
                    echo "<script>
                            actualizarOK('".$link."');
                        </script>";
                }else{
                    $valor = $respuesta2[2];
                    $error = str_replace("'", "", $valor);
                    echo '<script>
                            errorRegistro('."'".$error."','".$link."'".');
                        </script>';
                }
            }else{
                $valor = $respuesta[2];
                $error = str_replace("'", "", $valor);
                echo '<script>
                        errorRegistro('."'".$error."','".$link."'".');
                    </script>';
            }
        }
    }

    #VITA DE LA LISTA DE SERVICIOS EN PROCESO
    public static function vistaPartidasFinalizarUsuariosController(){
        require_once "./models/crud.php";
        $respuesta = Datos::vistaPartidasFinalizarUsariosTablaModel("usuario_partida_os");
        #El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.
        return $respuesta;
    }

    public function finalizarTurnoUsuarioController(){
		require_once "./models/crud.php";
		if(isset($_POST["id_partida_finalizar"])){
			$datosController = array( "id_partida_finalizar"=>$_POST["id_partida_finalizar"]);
			$respuesta = Datos::finalizarTurnoUsuarioModel($datosController, "usuario_partida_os");
            $link = "index.php?action=OrdenesServicio/finalizarTurnoUsuarios";
			if($respuesta == "success"){
                echo '<script>
                        var x = document.getElementById("openModalIniciar");
                        x.style.display = "none";    
                        actualizarOK('."'".$link."'".');
                    </script>';
            } else {
                $valor = $respuesta[2];
                $error = str_replace("'", "", $valor);
                echo '<script>
                        var x = document.getElementById("openModalIniciar");
                        x.style.display = "none";              
                        errorRegistro('."'".$error."','".$link."'".');
                </script>';
			}
		}
	}
    
        //BUSQUEDA DE HISTORIAL PERSONALIZADA
        public function vistaCalculoManoObraDirectaController(){
            require_once "./models/crud.php";
            if(isset($_POST["id_partida_os_calcular"])){
                $datosController = array("id_partida_os"=> $_POST["id_partida_os_calcular"]); 
                $respuesta = Datos::vistaCalculoManoObraDirectaModel($datosController, "usuario_partida_os"); 
                if(isset($respuesta)){
                    return $respuesta;
                }else{
                    echo "<p class='error-acceso'>". $respuesta[2]."</p>";
                }
            }
        }

        public function obtenerPartidaOSXOSController(){
            require_once "./models/crud.php";
            if(isset($_POST["os_buscar"])){
                $datosController = array( "os_buscar"=>$_POST["os_buscar"]);
                $respuesta = Datos::obtenerPartidasOSXOSModel($datosController, "partidas_os");
                if(isset($respuesta)){
                    $total_orden_servicio=0;
                    foreach($respuesta as $row => $item){
                        $datosController2 = array("id_partida_os"=>$item["id_partida_os"]);
                        $respuesta2 = Datos::vistaCalculoManoObraDirectaModel($datosController2, "usuario_partida_os");
                        foreach($respuesta2 as $row2 => $item2){
                            $tiempo =  $item2["tiempo_diferencia"];
                            $salario = $item2["salario_minuto"];
                            $costo = $tiempo * $salario;     
                            $total_orden_servicio += $costo; 
                            echo'<tr>
                                <td>'. utf8_decode($item2["descripcion_serv"]) .'</td>
                                <td>'. utf8_decode($item2["descripcion_serv"]) .'</td>
                                <td>'.$item2["observaciones_os"].'</td>
                                <td>'.$item2["fecha_asignacion"].'</td>
                                <td>'.$item2["fecha_termino"].'</td>
                                <td>'.$item2["nombre_u"].'</td>
                                <td>'.$item2["salario_minuto"].'</td>
                                <td>'.$item2["tiempo_diferencia"].'</td>
                                <td>'. $costo .'</td>
                            </tr>';
                        }
                    }   
                    echo "<tr><td colspan='3'>".$total_orden_servicio."</td></tr>";              
                } else {
                    echo "<p class='error-acceso'>". $respuesta[2]."</p>";
                }
            }
        }        





}
?>