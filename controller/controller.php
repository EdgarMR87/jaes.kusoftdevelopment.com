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
				                      "modelo_unidad_editar"=>$_POST["modelo_unidad_editar"]);
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
		if(isset($_POST["num_orden_iniciar"])){
			$datosController = array( "id_partida_os"=>$_POST["id_partida_os"],
							          "comentarios_os"=>$_POST["comentarios_os"]);
			$respuesta = Datos::iniciarServicioModel($datosController, "partidas_os");
            $usuariosAgisnados = $_POST["usuariosAsignados"];
            if($respuesta == "success"){                
                foreach($usuariosAgisnados as $usuarioAsignado){
                    $datosController2 = array("id_partida_os"=> $_POST["id_partida_os"],
                                                "usuario" => $usuarioAsignado);                    
                    $respuesta2 = Datos::asigarUsuariosIniciarServicioModel($datosController2, "usuario_partida_os");
                    $respuesta3 = Datos::empezarOSModel($_POST["num_orden_iniciar"]);
                }               
                echo '<script>
						alert("Se INICIO el servicio correctamente");
						location.href = "index.php?action=OrdenesServicio/detalleOS&id_os_editar='.$_POST["num_orden_iniciar"].'";
						</script>';
            } else {
				echo "<p class='error-acceso'>". $respuesta[2]."</p>";
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
                    $respuesta2 = Datos::asigarUsuariosIniciarServicioModel($datosController2, "usuario_partida_os");
            }               
            echo '<script>
			    	alert("Asignacion Correcta");
					setTimeout("location.href ='."'index.php?action=OrdenesServicio/listadoServiciosEnProceso'".'"'.', 200);
				</script>';
        } else {
			echo "<p class='error-acceso'>". $respuesta[2]."</p>";
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



}
?>