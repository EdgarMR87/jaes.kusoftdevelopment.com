<?php

#EXTENSIÓN DE CLASES: Los objetos pueden ser extendidos, y pueden heredar propiedades y métodos. Para definir una clase como extensión, debo definir una clase padre, y se utiliza dentro de una clase hija.

require_once "conexion.php";
date_default_timezone_set('America/Mexico_City');


class Datos extends Conexion{

	#REGISTRO DE USUARIOS
	#-------------------------------------
	public static function registroUsuarioModel($datosModel, $tabla){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre_u, ape_pat_u, ape_mat_u, usuario, contrasena, password, id_dpto_u, 
												id_puesto_u, estado_u, fecha_creacion_usuario) 
												VALUES (:nombre_u, :ape_pat_u, :ape_mat_u, :usuario, :contrasena, :password, :id_dpto_u, 
												:id_puesto_u, :estado_u, :fecha_creacion_usuario)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$contrasena =  password_hash($datosModel["contrasena"], PASSWORD_DEFAULT);
		//ASIGNAMOS VALORES LOCALES
		$estado_u = "activo"; $fecha_creacion_usuario = date("Y-m-d  H:m:S");
		$stmt->bindParam(":nombre_u", $datosModel["nombre_u"], PDO::PARAM_STR);
		$stmt->bindParam(":ape_pat_u", $datosModel["ape_pat_u"], PDO::PARAM_STR);
		$stmt->bindParam(":ape_mat_u", $datosModel["ape_mat_u"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":contrasena", $datosModel["contrasena"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $contrasena, PDO::PARAM_STR);
		$stmt->bindParam(":id_dpto_u", $datosModel["departamento"], PDO::PARAM_INT);
		$stmt->bindParam(":id_puesto_u", $datosModel["puesto"], PDO::PARAM_INT);
		$stmt->bindParam(":estado_u", $estado_u, PDO::PARAM_STR);
		$stmt->bindParam(":fecha_creacion_usuario", $fecha_creacion_usuario, PDO::PARAM_STR);

		if($stmt->execute()){

			return "success";

		}

		else{

            return $stmt->errorInfo();

		}

		$stmt->close();

	}

	#INGRESO USUARIO
	#-------------------------------------
	public static function ingresoUsuarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT CONCAT(nombre_u,' ',ape_pat_u,' ',ape_mat_u)AS nombreCompleto, 
												id_usuario, password, estado_u, id_dpto_u
                                                 FROM $tabla WHERE usuario = :usuario");	
		$stmt->bindParam(":usuario", $datosModel["usuario_r"], PDO::PARAM_STR);
		$stmt->execute();

		#fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetch();

		$stmt->close();

	}

	#VISTA USUARIOS
	#-------------------------------------

	public static function vistaGeneralModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_usuario, nombre_u, ape_pat_u, ape_mat_u, usuario, contrasena, id_dpto_u,
                                id_puesto_u, estado_u, fecha_creacion_usuario, nombre_dpto, nombre_puesto, salario_usuario, lugar_trabajo FROM $tabla
                                LEFT JOIN departamento ON id_departamento = id_dpto_u
                                LEFT JOIN puesto ON id_puesto = id_puesto_u");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

    #VISTA USUARIOS
	#-------------------------------------

	public static function vistaGeneralTablaModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}



	#EDITAR USUARIO
	#-------------------------------------
	public static function editarUsuarioModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_usuario = :id_usuario");
		$stmt->bindParam(":id_usuario", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	#ACTUALIZAR USUARIO
	#-------------------------------------
	public static function actualizarUsuarioModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_u=:nombre_u, ape_pat_u=:ape_pat_u, ape_mat_u=:ape_mat_u, 
                usuario=:usuario, contrasena=:contrasena, password=:password, id_dpto_u=:id_dpto_u, id_puesto_u=:id_puesto_u, 
                estado_u=:estado_u, salario_usuario=:salario_usuario, lugar_trabajo=:lugar_trabajo
                WHERE id_usuario=:id_usuario");
        $contrasena =  password_hash($datosModel["contrasena_m"], PASSWORD_DEFAULT); //GENERAMOS HASH
		$stmt->bindParam(":nombre_u", $datosModel["nombre_u_m"], PDO::PARAM_STR);
		$stmt->bindParam(":ape_pat_u", $datosModel["ape_pat_u_m"], PDO::PARAM_STR);
        $stmt->bindParam(":ape_mat_u", $datosModel["ape_mat_u_m"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datosModel["usuario_m"], PDO::PARAM_STR);
        $stmt->bindParam(":contrasena", $datosModel["contrasena_m"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $contrasena, PDO::PARAM_STR);
        $stmt->bindParam(":id_dpto_u", $datosModel["departamento_m"], PDO::PARAM_INT);
        $stmt->bindParam(":id_puesto_u", $datosModel["puesto_m"], PDO::PARAM_INT);
		$stmt->bindParam(":estado_u", $datosModel["estado_m"], PDO::PARAM_STR);
        $stmt->bindParam(":salario_usuario", $datosModel["salario_usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":lugar_trabajo", $datosModel["lugar_trabajo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario", $datosModel["id_usuario_m"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		} else {
            $error = $stmt->errorInfo();
            return $error;
		}
		$stmt->close();
	}

	#BORRAR USUARIO
	#------------------------------------
	public function borrarUsuarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_usuario = :id_usuario");
		$stmt->bindParam(":id_usuario", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

		#REGISTRO DE DEPARTAMENTO
	#-------------------------------------
	public static function registroDepartamentoModel($datosModel, $tabla){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre_dpto, descripcion_dpto, fecha_creacion_dpto) VALUES (:nombre_dpto,:descripcion_dpto,:fecha_creacion_dpto)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
        date_default_timezone_set('America/Mexico_City');
        $fecha_creacion_dpto = date("Y-m-d H:m:s");
		$stmt->bindParam(":nombre_dpto", $datosModel["nombre_dpto"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_dpto", $datosModel["descripcion_dpto"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_creacion_dpto", $fecha_creacion_dpto, PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}
		else{
			return $stmt->errorInfo();
		}

		$stmt->close();

	}

	#VISTA DEPARTAMENTOS
	#-------------------------------------

	public static function vistaDepartamentosModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY nombre_dpto ASC");	
		$stmt->execute();
		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();
		$stmt->close();
	}

    #EDITAR DEPARTAMENTO
	#-------------------------------------

	public function editarDptoModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_departamento = :id_departamento");
		$stmt->bindParam(":id_departamento", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

    #ACTUALIZAR DEPARTAMENTO
	#-------------------------------------

	public function actualizarDptoModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_dpto = :nombre_dpto, descripcion_dpto = :descripcion_dpto
												WHERE id_departamento = :id_departamento");		
        $stmt->bindParam(":nombre_dpto", $datosModel["nombre_dpto_modif"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_dpto", $datosModel["descripcion_dpto_modif"], PDO::PARAM_STR);
        $stmt->bindParam(":id_departamento", $datosModel["id_dpto_modificar"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return $stmt->errorInfo();
		}
		$stmt->close();
	}


    

	#REGISTRO DE PUESTO
	#-------------------------------------
	public static function registroPuestoModel($datosModel, $tabla){
		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre_puesto, descripcion_puesto, id_departamento_puesto, fecha_creacion_puesto)
												 VALUES (:nombre_puesto,:descripcion_puesto,:id_departamento_puesto,:fecha_creacion_puesto)");	
		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
        date_default_timezone_set('America/Mexico_City');
        $fecha_creacion_puesto = date("Y-m-d H:m:s");
		$stmt->bindParam(":nombre_puesto", $datosModel["nombre_puesto"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_puesto", $datosModel["descripcion_puesto"], PDO::PARAM_STR);
		$stmt->bindParam(":id_departamento_puesto", $datosModel["id_departamento_puesto"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_creacion_puesto", $fecha_creacion_puesto, PDO::PARAM_STR);
		if($stmt->execute()){
			return "success";
		} else{
			return $stmt->errorInfo();
		}
		$stmt->close();
	}

	#BORRAR DEPARTAMENTO
	#------------------------------------
	public static function borrarDepartamentoModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_departamento = :id_departamento");
		$stmt->bindParam(":id_departamento", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

	#BORRAR PUESTO	
	#------------------------------------
	public static function borrarPuestoModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_puesto = :id_puesto");
		$stmt->bindParam(":id_puesto", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

	#VISTA PUESTO
	#-------------------------------------

	public static function vistaPuestoTablaModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT id_puesto, nombre_puesto, descripcion_puesto, d.nombre_dpto, fecha_creacion_puesto
												FROM $tabla LEFT JOIN departamento d ON id_departamento_puesto = d.id_departamento");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();
	}

    #EDITAR PUESTO
	#-------------------------------------

	public static function editarPuestoModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_puesto = :id_puesto");
		$stmt->bindParam(":id_puesto", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}
    
      #ACTUALIZAR PUESTO
	#-------------------------------------

	public function actualizarPuestoModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_puesto = :nombre_puesto, descripcion_puesto = :descripcion_puesto,
                                                id_departamento_puesto = :id_departamento_puesto WHERE id_puesto = :id_puesto");		
        $stmt->bindParam(":nombre_puesto", $datosModel["nombre_puesto_modif"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_puesto", $datosModel["descripcion_puesto_modif"], PDO::PARAM_STR);
        $stmt->bindParam(":id_departamento_puesto", $datosModel["id_departamento_puesto_modif"], PDO::PARAM_INT);
        $stmt->bindParam(":id_puesto", $datosModel["id_puesto_modif"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return $stmt->errorInfo();
		}
		$stmt->close();
	}
    

	#VISTA PUESTO ID DEPARTAMENTO
	#-------------------------------------

	public static function vistaPuestoIDModel($tabla, $id_departamento_puesto){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_departamento_puesto=:id_departamento_puesto");	
		$stmt->bindParam(":id_departamento_puesto", $id_departamento_puesto, PDO::PARAM_INT);
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}
    
	#VISTA UNIDADES EN GENERAL 
	#-------------------------------------

    public static function vistaUnidadesModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");	
		$stmt->execute();
		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();
		$stmt->close();
	}

	#VISTA UNIDADES MAZDA
	#-------------------------------------
    public static function vistaUnidadesMazdaModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE modelo='MAZDA'");	
		$stmt->execute();
		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();
		$stmt->close();
	}

    
    
	#REGISTRO DE UNIDADES
	#-------------------------------------
	public static function registroUnidadModel($datosModel, $tabla){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_unidad,num_unidad, modelo, fecha_creacion, id_usuario_creacion, estado)
												 VALUES (:id_unidad,:num_unidad,:modelo,:fecha_creacion,:id_usuario_creacion, :estado)");	
		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		session_start();
        $fecha_creacion = date("Y-m-d H:m:s");
        $id_usuario_creacion = $_SESSION["id_usuario"];
        $estado = "ACTIVO";
		$stmt->bindParam(":id_unidad", $datosModel["num_unidad"], PDO::PARAM_INT);
        $stmt->bindParam(":num_unidad", $datosModel["num_unidad"], PDO::PARAM_INT);
		$stmt->bindParam(":modelo", $datosModel["modelo"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_creacion", $fecha_creacion, PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario_creacion", $id_usuario_creacion, PDO::PARAM_INT);
		$stmt->bindParam(":estado", $estado, PDO::PARAM_STR);

		if($stmt->execute()){

			return "success";

		}
		else{

			return $stmt->errorInfo();

		}

		$stmt->close();

	}

    #BORRAR UNIDAD
	#------------------------------------
	public static function borrarUnidadesModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_unidad = :id_unidad");
		$stmt->bindParam(":id_unidad", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return $stmt->errorInfo();
		}
		$stmt->close();
	}

    #VISTA UNIDADES TABLA
	#-------------------------------------

	public static function vistaUnidadesTablaModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT id_unidad, num_unidad, modelo, fecha_creacion, u.usuario, estado
                                                FROM $tabla LEFT JOIN usuarios u ON id_usuario_creacion = u.id_usuario");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();
	}
    
    #EDITAR UNIDAD
	#-------------------------------------

	public static function editarUnidadModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_unidad, num_unidad, modelo, fecha_creacion, u.usuario, estado
        FROM $tabla LEFT JOIN usuarios u ON id_usuario_creacion = u.id_usuario WHERE id_unidad = :id_unidad");
		$stmt->bindParam(":id_unidad", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}  

	#ACTUALIZAR UNIDADES
	#-------------------------------------

	public static function actualizarUnidadesModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_unidad = :id_unidad_modif, num_unidad = :num_unidad, 
                                                modelo = :modelo, estado = :estado WHERE id_unidad = :id_unidad");
        $stmt->bindParam(":id_unidad_modif", $datosModel["num_unidad_editar"], PDO::PARAM_INT);
		$stmt->bindParam(":num_unidad", $datosModel["num_unidad_editar"], PDO::PARAM_INT);
		$stmt->bindParam(":modelo", $datosModel["modelo_unidad_editar"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datosModel["estado_unidad_editar"], PDO::PARAM_STR);
        $stmt->bindParam(":id_unidad", $datosModel["id_unidad_editar"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		} else {
			return $stmt->errorInfo();
		}
		$stmt->close();
	}

    	#REGISTRO DE SERVICIO ATR
	#-------------------------------------
	public static function registroServicioAtrModel($datosModel, $tabla){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo_atr_serv, descripcion_serv, comentarios_serv, 
                fecha_creacion_serv, id_usuario_creacion_serv, estado_serv, id_dpto_serv) VALUES (:codigo_atr_serv, :descripcion_serv, 
                :comentarios_serv, :fecha_creacion_serv, :id_usuario_creacion_serv, :estado_serv, :id_dpto_serv)");	
		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		session_start();
        $fecha_creacion_serv = date("Y-m-d H:m:s");
        $id_usuario_creacion_serv = $_SESSION["id_usuario"];
        $estado_serv = "ACTIVO";
		$stmt->bindParam(":codigo_atr_serv", $datosModel["codigo_atr_serv"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion_serv", $datosModel["descripcion_serv"], PDO::PARAM_STR);
		$stmt->bindParam(":comentarios_serv", $datosModel["comentarios_serv"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_creacion_serv", $fecha_creacion_serv, PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario_creacion_serv", $id_usuario_creacion_serv, PDO::PARAM_INT);
        $stmt->bindParam(":id_dpto_serv", $datosModel["id_dpto_serv"], PDO::PARAM_INT);
		$stmt->bindParam(":estado_serv", $estado_serv, PDO::PARAM_STR);
		if($stmt->execute()){
			return "success";
		} else {
			return $stmt->errorInfo();
		}
		$stmt->close();
	}
    
    #VISTA SERVICIOS ATR TABLA
	#-------------------------------------

	public static function vistaServiciosAtrTablaModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT id_servicio, codigo_atr_serv, descripcion_serv, comentarios_serv, 
                fecha_creacion_serv, u.usuario, estado_serv, d.nombre_dpto
                FROM $tabla 
                LEFT JOIN usuarios u ON id_usuario_creacion_serv = u.id_usuario
                LEFT JOIN departamento d ON id_dpto_serv = d.id_departamento 
                ORDER BY codigo_atr_serv ASC");	
		$stmt->execute();
		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();
		$stmt->close();
	}

 	#VISTA SERVICIOS ATR TABLA ORDENADOS
	#-------------------------------------

	public static function vistaServiciosAtrSelectModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY codigo_atr_serv ASC");	
		$stmt->execute();
		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();
		$stmt->close();
	}


    #VISTA OS PENDIENTES
	#-------------------------------------
	public static function obtenerOSPendientesModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT num_orden, id_unidad_servicio FROM $tabla WHERE estado = 'PENDIENTE' OR estado = 'ENPROCESO' ORDER BY fecha_orden ASC");	
		$stmt->execute();
		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();
		$stmt->close();
	}

     #VISTA OS EN PROCESO
	#-------------------------------------
	public static function obtenerOSEnProcesoModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT num_orden, id_unidad_servicio FROM $tabla WHERE estado = 'ENPROCESO' ORDER BY fecha_orden ASC");	
		$stmt->execute();
		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();
		$stmt->close();
	}


	 #BORRAR SERVICIO ATR
	#------------------------------------
	public static function borrarServicioAtrModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_servicio = :id_servicio");
		$stmt->bindParam(":id_servicio", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}
    
 	#EDITAR SERVICIO ATR
	#-------------------------------------

	public function editarServicioAtrModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id_servicio, codigo_atr_serv, descripcion_serv, comentarios_serv, 
							fecha_creacion_serv, u.usuario, estado_serv
							FROM $tabla LEFT JOIN usuarios u ON id_usuario_creacion_serv = u.id_usuario WHERE id_servicio = :id_servicio");
		$stmt->bindParam(":id_servicio", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}  

	#ACTUALIZAR SERVICIO ATR
	#-------------------------------------

	public static function actualizarServicioAtrModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codigo_atr_serv = :codigo_atr_serv, descripcion_serv = :descripcion_serv, 
                                                comentarios_serv = :comentarios_serv, estado_serv = :estado_serv 
												WHERE id_servicio = :id_servicio");		
        $stmt->bindParam(":codigo_atr_serv", $datosModel["codigo_atr_serv_editar"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_serv", $datosModel["descripcion_serv_editar"], PDO::PARAM_STR);
		$stmt->bindParam(":comentarios_serv", $datosModel["comentarios_serv_editar"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_serv", $datosModel["estado_serv_editar"], PDO::PARAM_STR);
        $stmt->bindParam(":id_servicio", $datosModel["id_servicio_editar"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			$arr = $stmt->errorInfo();
			return $arr;
		}
		$stmt->close();
	}




    
	public static function registroOSAtrModel($datosModel, $tabla){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (num_orden, id_unidad_servicio, operador, 
                captura, fecha_orden, kilometraje, servicio, tipo_servicio, fecha_creacion, id_usuario_creacion, estado) 
                VALUES (:num_orden, :id_unidad_servicio, :operador, :captura, :fecha_orden, :kilometraje, :servicio, :tipo_servicio, 
                (SELECT NOW()), :id_usuario_creacion, :estado)");	
		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		session_start();
        $id_usuario_creacion = $_SESSION["id_usuario"];
        $estado = "PENDIENTE";
		$stmt->bindParam(":num_orden", $datosModel["num_orden"], PDO::PARAM_INT);
        $stmt->bindParam(":id_unidad_servicio", $datosModel["id_unidad_servicio"], PDO::PARAM_INT);
		$stmt->bindParam(":operador", $datosModel["operador"], PDO::PARAM_STR);
        $stmt->bindParam(":captura", $datosModel["captura"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_orden", $datosModel["fecha_orden"], PDO::PARAM_STR);
        $stmt->bindParam(":kilometraje", $datosModel["kilometraje"], PDO::PARAM_INT);
        $stmt->bindParam(":servicio", $datosModel["servicio"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_servicio", $datosModel["tipo_servicio"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario_creacion", $id_usuario_creacion, PDO::PARAM_INT);
		$stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
		if($stmt->execute()){
			return "success";
		}else{
            $arr = $stmt->errorInfo();
			return $arr;

		}
		$stmt->close();
	}

    #VISTA ORDEN DE SERVICIO ATR TABLA
	#-------------------------------------
	public static function vistaOSAtrTablaModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT num_orden, id_unidad_servicio, operador, captura, fecha_orden, kilometraje, 
		servicio, tipo_servicio, servicio_tiempo, fecha_creacion, u.nombre_u, estado, avance_porcentaje, impreso
		FROM $tabla
		LEFT JOIN usuarios u ON id_usuario_creacion = u.id_usuario
		WHERE estado = 'TERMINADO' AND cast(fecha_termino as date) = DATE_FORMAT(now(),'Y-m-d')
	UNION ALL
		SELECT num_orden, id_unidad_servicio, operador, captura, fecha_orden, kilometraje, servicio, tipo_servicio,
		servicio_tiempo, fecha_creacion, u.nombre_u, estado, avance_porcentaje, impreso
		FROM $tabla
		LEFT JOIN usuarios u ON id_usuario_creacion = u.id_usuario
		WHERE estado <> 'TERMINADO'
		ORDER BY estado, num_orden ASC");
		$stmt->execute();
		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();
		$stmt->close();
	}

    #VISTA ORDEN DE SERVICIO ATR TABLA
	#-------------------------------------

	public static function vistaOSAtrTablaBusquedaModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT num_orden, id_unidad_servicio, operador, 
                captura, fecha_orden, kilometraje, servicio, tipo_servicio, servicio_tiempo, 
                fecha_creacion, CONCAT(u.ape_pat_u,' ',u.ape_mat_u,' ',u.nombre_u)as nombre_completo, estado, avance_porcentaje, impreso FROM $tabla 
                LEFT JOIN usuarios u ON id_usuario_creacion = u.id_usuario 
                WHERE " . $datosModel["campo_buscado"] . " = :valor                
                ORDER BY fecha_orden ASC");	
        
        $stmt->bindParam(":valor", $datosModel["valor"], PDO::PARAM_STR);
        if($stmt->execute()){
            return $stmt->fetchAll();
		}else{
			$arr = $stmt->errorInfo();
			return $arr;
		}
        $stmt->close();
	}
    
	 #BORRAR ORDEN DE SERVICIO ATR
	#------------------------------------
	public static function borrarOSAtrModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE num_orden = :num_orden");
		$stmt->bindParam(":num_orden", $datosModel, PDO::PARAM_INT);
        #REGISTRAMOS QUIEN ELIMINO EL REGISTRO COMPLETO DE LA ORDEN DE SERVICIO.
        $valores = "Se elimina la OS ".$datosModel." y sus partidas. El id de usuario que elimino fue : ".$_SESSION["id_usuario"];
		$tipo_m = "D";					
        $insert = Conexion::conectar()->prepare("INSERT INTO movimientos_partidas_os(id_usuario_m, id_partida_os_m, valores_m, 
        fecha_m, tipo_m) VALUES (:id_usuario_m, :id_partida_os_m, :valores_m, (SELECT NOW()), :tipo_m)");
        $insert->bindParam(":id_usuario_m", $_SESSION["id_usuario"], PDO::PARAM_INT);
        $insert->bindParam(":id_partida_os_m", $datosModel, PDO::PARAM_INT);
        $insert->bindParam(":valores_m", $valores, PDO::PARAM_STR);
        $insert->bindParam(":tipo_m", $tipo_m, PDO::PARAM_STR);
		if($stmt->execute()){
            $insert->execute();
			return "success";
		}else{
            $arr = $stmt->errorInfo();
			return $arr;
		}
		$stmt->close();
        $insert->close();
	}

    
	#BORRAR ORDEN DE SERVICIO ATR
	#------------------------------------
	public static function borrarPartidasOSAtrModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE num_orden_partida_os = :num_orden_partida_os");
		$stmt->bindParam(":num_orden_partida_os", $datosModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			$arr = $stmt->errorInfo();
			return $arr;
		}
		$stmt->close();
	}
	


 	#EDITAR ORDEN DE SERVICIO ATR
	#-------------------------------------

	public static function editarOSAtrModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE num_orden = :num_orden");
		$stmt->bindParam(":num_orden", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}  

	#ACTUALIZAR ORDEN DE SERVICIO 
	#-------------------------------------

	public static function actualizarOSAtrModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_unidad_servicio = :id_unidad_servicio, operador = :operador,
                captura=:captura, fecha_orden=:fecha_orden, kilometraje=:kilometraje, servicio=:servicio, tipo_servicio=:tipo_servicio,
                servicio_tiempo=:servicio_tiempo, observaciones_os=:observaciones_os WHERE num_orden = :num_orden");		
        $stmt->bindParam(":id_unidad_servicio", $datosModel["id_unidad_servicio"], PDO::PARAM_INT);
		$stmt->bindParam(":operador", $datosModel["operador"], PDO::PARAM_STR);
		$stmt->bindParam(":captura", $datosModel["captura"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_orden", $datosModel["fecha_orden"], PDO::PARAM_STR);
        $stmt->bindParam(":kilometraje", $datosModel["kilometraje"], PDO::PARAM_INT);
        $stmt->bindParam(":servicio", $datosModel["servicio"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_servicio", $datosModel["tipo_servicio"], PDO::PARAM_STR);
        $stmt->bindParam(":servicio_tiempo", $datosModel["servicio_tiempo"], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones_os", $datosModel["observaciones_os"], PDO::PARAM_STR);		
        $stmt->bindParam(":num_orden", $datosModel["num_orden"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			$arr = $stmt->errorInfo();
			return $arr;
		}
		$stmt->close();
	}


	public static function registroPartidaOSModel($datosModel, $tabla){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (consec_partida_os, codigo_partida_os, observaciones_os, 
                num_orden_partida_os, fecha_creacion_partida_os) VALUES (:consec_partida_os, :codigo_partida_os, :observaciones_os, 
				:num_orden_partida_os, :fecha_creacion_partida_os)");	
        session_start();
        date_default_timezone_set('America/Mexico_City');
        $fecha_creacion = date("Y-m-d H:m:s");
		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$stmt->bindParam(":consec_partida_os", $datosModel["consec_partida_os"], PDO::PARAM_INT);
        $stmt->bindParam(":codigo_partida_os", $datosModel["codigo_partida_os"], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones_os", $datosModel["observaciones_os"], PDO::PARAM_STR);
        $stmt->bindParam(":num_orden_partida_os", $datosModel["num_orden_partida_os"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_creacion_partida_os", $fecha_creacion, PDO::PARAM_STR);
		if($stmt->execute()){
			return "success";
		} else {
			return $stmt->errorInfo();
		}
		$stmt->close();
	}
    
	public static function obtenerServiciosOSModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SHOW COLUMNS FROM $tabla WHERE Field = :Field");
		$stmt->bindParam(":Field", $datosModel, PDO::PARAM_STR);	
		$stmt->execute();
		$valores = $stmt->fetchAll(PDO::FETCH_COLUMN|PDO::FETCH_UNIQUE, 1);
		$valor = $valores["servicio"];
		$enum = explode("','", trim($valor, "enum()'"));
		return $enum;		
	}  

	public static function obtenerTipoServOSModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SHOW COLUMNS FROM $tabla WHERE Field = :Field");
		$stmt->bindParam(":Field", $datosModel, PDO::PARAM_STR);	
		$stmt->execute();
		$valores = $stmt->fetchAll(PDO::FETCH_COLUMN|PDO::FETCH_UNIQUE, 1);
		$valor = $valores["tipo_servicio"];
		$enum = explode("','", trim($valor, "enum()'"));
		return $enum;		
	}  


	#OBTENER PARTIDAS DE ORDEN DE SERVICIO ATR
	#-------------------------------------

	public static function obtenerPartidasOSModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla LEFT JOIN servicios_atr ON codigo_partida_os = codigo_atr_serv
                                                             WHERE num_orden_partida_os = :num_orden_partida_os");
		$stmt->bindParam(":num_orden_partida_os", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();
		return $stmt->fetchall();
		$stmt->close();
	}  
	
	#OBTENER PARTIDA BUSCADA PARA INICIAR SERVICIO
	#-------------------------------------

	public static function obtenerPartidaOSModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT id_partida_os, codigo_partida_os, comentarios_os, observaciones_os, 
												num_orden_partida_os, estado_partida_os, descripcion_serv FROM $tabla
												LEFT JOIN servicios_atr ON codigo_atr_serv = codigo_partida_os
												WHERE num_orden_partida_os = :num_orden_partida_os 
												AND codigo_partida_os = :codigo_partida_os AND estado_partida_os = 'PENDIENTE'");
		$stmt->bindParam(":num_orden_partida_os", $datosModel["num_orden_partida_os"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo_partida_os", $datosModel["codigo_partida_os"], PDO::PARAM_STR);	
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}  

	#INICIAR SERVICIO 
	#-------------------------------------

	public static function iniciarServicioModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fecha_inicio_partida_os = :fecha_inicio_partida_os, 
											comentarios_os = :comentarios_os, estado_partida_os = :estado_partida_os 
												WHERE id_partida_os = :id_partida_os");	
		session_start();
		date_default_timezone_set('America/Mexico_City');
		$fecha_inicio = date("Y-m-d H:m:s");
		$id_usuario_creacion = $_SESSION["id_usuario"];
		$estado = "ENPROCESO";	
		$tipo_m = "U";						
		$valores =  $datosModel["comentarios_os"] . "," . $estado ;
        $stmt->bindParam(":comentarios_os", $datosModel["comentarios_os"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_inicio_partida_os", $fecha_inicio, PDO::PARAM_STR);
		$stmt->bindParam(":estado_partida_os", $estado, PDO::PARAM_STR);
        $stmt->bindParam(":id_partida_os", $datosModel["id_partida_os"], PDO::PARAM_INT);

        $insert = Conexion::conectar()->prepare("INSERT INTO movimientos_partidas_os(id_usuario_m, id_partida_os_m, valores_m, 
					    fecha_m, tipo_m) VALUES (:id_usuario_m, :id_partida_os_m, :valores_m, :fecha_m, :tipo_m)");
		    $insert->bindParam(":id_usuario_m", $id_usuario_creacion, PDO::PARAM_INT);
		    $insert->bindParam(":id_partida_os_m", $datosModel["id_partida_os"], PDO::PARAM_INT);
		    $insert->bindParam(":valores_m", $valores, PDO::PARAM_STR);
		    $insert->bindParam(":fecha_m", $fecha_inicio, PDO::PARAM_STR);
		    $insert->bindParam(":tipo_m", $tipo_m, PDO::PARAM_STR);

		if($stmt->execute()){
			if($insert->execute()){
                return "success";
			}
			else{
				$arr = $insert->errorInfo();
			    return $arr;
			}
			
		}else{
			$arr = $stmt->errorInfo();
			return $arr;
		}
        $stmt->close();  
        $insert->close();
	}


    public static function asigarUsuariosIniciarServicioModel($datosModel, $tabla){
        $asignarUser = Conexion::conectar()->prepare("INSERT INTO $tabla(id_partida_os, id_usuario_r, 
                                        id_supervisor_a, fecha_asignacion) VALUES (:id_partida_os, :id_usuario_r, 
                                        :id_supervisor_a, :fecha_asignacion)");
        session_start();
        date_default_timezone_set('America/Mexico_City');
        $fecha_inicio = date("Y-m-d H:m:s");
        $id_usuario_creacion = $_SESSION["id_usuario"];
        $asignarUser->bindParam(":id_usuario_r", $datosModel["usuario"], PDO::PARAM_INT);
		$asignarUser->bindParam(":id_partida_os", $datosModel["id_partida_os"], PDO::PARAM_INT);
		$asignarUser->bindParam(":id_supervisor_a", $id_usuario_creacion, PDO::PARAM_INT);
		$asignarUser->bindParam(":fecha_asignacion", $fecha_inicio, PDO::PARAM_STR);
        if($asignarUser->execute()){
            return "success";
        }else{
            $arr = $asignarUser->errorInfo();
            return $arr;
        }
        $asignarUser->close();
    }


	public static function obtenerPartidaOSFinalizarModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT id_partida_os, codigo_partida_os, comentarios_os, observaciones_os, 
												num_orden_partida_os, estado_partida_os, descripcion_serv FROM $tabla
												LEFT JOIN servicios_atr ON codigo_atr_serv = codigo_partida_os
												WHERE num_orden_partida_os = :num_orden_partida_os 
												AND codigo_partida_os = :codigo_partida_os AND estado_partida_os = 'ENPROCESO'");
		$stmt->bindParam(":num_orden_partida_os", $datosModel["num_orden_partida_os"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo_partida_os", $datosModel["codigo_partida_os"], PDO::PARAM_STR);	
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}  

	#OBTENER PARTIDA BUSCADA 
	#-------------------------------------


	public static function finalizarSevicioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fecha_termino_partida_os = (SELECT NOW()), 
										estado_partida_os = :estado_partida_os, comentario_final = :comentario_final
												WHERE id_partida_os = :id_partida_os");	
		session_start();
		$id_usuario_creacion = $_SESSION["id_usuario"];
		$estado = "TERMINADO";	
		$tipo_m = "U";						
		$valores = "SE FINALIZA LA PARTIDA " .  $datosModel["id_partida_os"]. " CON LOS COMENTARIOS : ".$datosModel["comentario_final"] . "," . $estado ;
        $stmt->bindParam(":comentario_final", $datosModel["comentario_final"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_partida_os", $estado, PDO::PARAM_STR);
        $stmt->bindParam(":id_partida_os", $datosModel["id_partida_os"], PDO::PARAM_INT);

		$insert = Conexion::conectar()->prepare("INSERT INTO movimientos_partidas_os(id_usuario_m, id_partida_os_m, valores_m, 
					fecha_m, tipo_m) VALUES (:id_usuario_m, :id_partida_os_m, :valores_m, (SELECT NOW()), :tipo_m)");
		$insert->bindParam(":id_usuario_m", $id_usuario_creacion, PDO::PARAM_INT);
		$insert->bindParam(":id_partida_os_m", $datosModel["id_partida_os"], PDO::PARAM_INT);
		$insert->bindParam(":valores_m", $valores, PDO::PARAM_STR);
		$insert->bindParam(":tipo_m", $tipo_m, PDO::PARAM_STR);

        $update = Conexion::conectar()->prepare("UPDATE usuario_partida_os SET fecha_termino =(SELECT NOW()) 
                    WHERE id_partida_os = :id_partida_os AND fecha_termino IS NULL");
        $update->bindParam(":id_partida_os", $datosModel["id_partida_os"], PDO::PARAM_INT);
        
		if($stmt->execute()){				
			if($insert->execute()){
                $update->execute();
				return "success";
			} else {
			    return $insert->errorInfo();
			}
		}else{		
			return $stmt->errorInfo();
		}
		$stmt->close();
		$insert->close();
        $update->close();
	}

	#VISTA PUESTO
	#-------------------------------------
	public static function vistaTrabajadorAtrModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_dpto_u 
            IN('7','13','15','19','20','21','22','23','25','26','27','28','29') 
            AND lugar_trabajo = 'ATR' AND estado_u = 'activo'
            ORDER BY nombre_u ASC");	
		$stmt->execute();
		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();
		$stmt->close();
	}

	public static function obtenerUsuariosAsignadosModel($tabla, $datosModel){
		$stmt = Conexion::conectar()->prepare("SELECT CONCAT(u.ape_pat_u, ' ', u.ape_mat_u, ' ' , u.nombre_u)as usuarioCompleto, 
												pos.codigo_partida_os, fecha_asignacion, sa.descripcion_serv 
												FROM $tabla ups
												LEFT JOIN partidas_os pos ON pos.id_partida_os = ups.id_partida_os
												LEFT JOIN servicios_atr sa ON sa.codigo_atr_serv = pos.codigo_partida_os
												LEFT JOIN usuarios u ON u.id_usuario = ups.id_usuario_r
												WHERE ups.id_partida_os = :id_partida_os");
		$stmt->bindParam(":id_partida_os", $datosModel, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}  

	public static function obtenerSupervisorAsignadosModel($tabla, $datosModel){
		$stmt = Conexion::conectar()->prepare("SELECT CONCAT(u.ape_pat_u, ' ', u.ape_mat_u, ' ' , u.nombre_u)as supervisor 
												FROM $tabla
												LEFT JOIN usuarios u ON u.id_usuario = id_supervisor_a
												WHERE id_partida_os = :id_partida_os");
		$stmt->bindParam(":id_partida_os", $datosModel, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}  

	public static function actualizarPorcentajeGral($num_orden_partida_os){
		$obtenerPorcentaje = Conexion::conectar()->prepare("UPDATE ordenServicio SET avance_porcentaje = (SELECT (COUNT(id_partida_os)*100) / 
									(SELECT COUNT(id_partida_os) FROM partidas_os WHERE num_orden_partida_os = :num_orden_partida_os) 
									FROM partidas_os WHERE estado_partida_os = 'TERMINADO' AND num_orden_partida_os = :num_orden_partida_os)
									WHERE num_orden = :num_orden_partida_os");
        $obtenerPorcentaje->bindParam(":num_orden_partida_os", $num_orden_partida_os, PDO::PARAM_INT);
		if($obtenerPorcentaje->execute()){
			return "success";
	 	}else{
            return $obtenerPorcentaje->errorInfo();
		}
		$obtenerPorcentaje->close();
	}

    #METODO PARA VALIDAR SI YA SE TERMINO AL 100% UNA ORDEN DE SERVICIO ACTUALIZAMOS SU ESTATUS.
    public  static function cerrarOSModel($num_orden_partida_os){
        $obtenerPorcentaje = Conexion::conectar()->prepare("UPDATE ordenServicio SET estado = 'TERMINADO', fecha_termino = (SELECT NOW())
                                                            WHERE  num_orden = :num_orden_partida_os AND avance_porcentaje = 100"); 
        $obtenerPorcentaje->bindParam(":num_orden_partida_os", $num_orden_partida_os, PDO::PARAM_INT);
        if($obtenerPorcentaje->execute()){
            return "success";
        }else{
            return $obtenerPorcentaje->errorInfo();
        }
        $obtenerPorcentaje->close();
    }

    #METODO PARA VALIDAR SI YA SE TERMINO AL MENOS UN SERVICIO Y CAMBIAR ESTADO A ENPROCESO
    public  static function empezarOSModel($num_orden_partida_os){
        $obtenerPorcentaje = Conexion::conectar()->prepare("UPDATE ordenServicio SET estado = 'ENPROCESO'
                                                            WHERE  num_orden = :num_orden_partida_os"); 
        $obtenerPorcentaje->bindParam(":num_orden_partida_os", $num_orden_partida_os, PDO::PARAM_INT);
        if($obtenerPorcentaje->execute()){
            return "success";
        }else{
            $arr = $obtenerPorcentaje->errorInfo();
            return $arr;
        }
    }

    #VISTA ORDEN DE SERVICIO ATR TABLA
	#-------------------------------------

	public static function vistaPartidasEnProcesoAtrTablaModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT num_orden_partida_os, id_unidad_servicio, descripcion_serv, comentarios_os, 
                comentario_final, observaciones_os, fecha_creacion_partida_os, fecha_inicio_partida_os, id_partida_os, id_dpto_serv
                FROM $tabla 
                LEFT JOIN ordenServicio ON num_orden = num_orden_partida_os 
                LEFT JOIN servicios_atr ON codigo_partida_os = codigo_atr_serv
                WHERE estado_partida_os = 'ENPROCESO'");
		$stmt->execute();
		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();
		$stmt->close();
	}

    public static function registroChecklistModel($datosModel, $tabla){
		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (fecha_checklist, id_usuario_realiza, unidad_mazda, kilometraje, 
                observaciones) VALUES (:fecha_checklist, :id_usuario_realiza, :unidad_mazda, :kilometraje, :observaciones)");
                date_default_timezone_set('America/Mexico_City');
                $fecha_registro = date("Y-m-d H:m:s");
		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$stmt->bindParam(":fecha_checklist", $fecha_registro, PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario_realiza", $datosModel["id_usuario_realiza"], PDO::PARAM_INT);
		$stmt->bindParam(":unidad_mazda", $datosModel["unidad_mazda"], PDO::PARAM_INT);
        $stmt->bindParam(":kilometraje", $datosModel["kilometraje"], PDO::PARAM_INT);
        $stmt->bindParam(":observaciones", $datosModel["observaciones"], PDO::PARAM_STR);
		if($stmt->execute()){
            $stmt2 = Conexion::conectar()->prepare("SELECT MAX(id_checklist)AS id FROM $tabla");
            $stmt2->execute();
            return $stmt2->fetchAll();
		} else {
			return $stmt->errorInfo();
		}
		$stmt->close();
	}
    

    public static function registroPartidasChecklistModel($datosModel, $tabla){
		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_checklist_partidas, parte_revisada, estado_general, 
                observaciones_partida) VALUES (:id_checklist_partidas, :parte_revisada, :estado_general, :observaciones_partida)");
		$stmt->bindParam(":id_checklist_partidas", $datosModel["id_checklist_partidas"], PDO::PARAM_INT);
        $stmt->bindParam(":parte_revisada", $datosModel["parte_revisada"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_general", $datosModel["estado_general"], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones_partida", $datosModel["observaciones_partida"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "success";
		} else {
			return $stmt->errorInfo();
		}
		$stmt->close();
	}


    public static function vistaChecklistTablaModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT id_checklist, fecha_checklist, 
                            CONCAT(nombre_u,' ', ape_pat_u, ' ',ape_mat_u)as nombreCompleto, unidad_mazda, kilometraje,
                            observaciones FROM $tabla
                            LEFT JOIN usuarios ON id_usuario_realiza = id_usuario");	
		$stmt->execute();
		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}
    
    public static function vistaDetalleChecklistTablaModel($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_checklist_partidas = :id_checklist_partidas");	
        $stmt->bindParam(":id_checklist_partidas", $datos, PDO::PARAM_INT);
		$stmt->execute();
		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();
		$stmt->close();
	}

    #BORRAR ORDEN DE SERVICIO ATR
	#------------------------------------
	public static function borrarChecklistModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_checklist = :id_checklist");
		$stmt->bindParam(":id_checklist", $datosModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}
    
	#BORRAR ORDEN DE SERVICIO ATR
	#------------------------------------
	public static function borrarPartidasChecklistModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_checklist_partidas = :id_checklist_partidas");
		$stmt->bindParam(":id_checklist_partidas", $datosModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

    #EDITAR CHECKLIST
    #-------------------------------------
	public static function editarCheckListModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT id_checklist, fecha_checklist, id_usuario_realiza, unidad_mazda, 
                kilometraje, observaciones, CONCAT(nombre_u,' ', ape_pat_u, ' ',ape_mat_u)as nombreCompleto 
                FROM $tabla
                LEFT JOIN usuarios ON id_usuario_realiza = id_usuario
                WHERE id_checklist = :id_checklist");
		$stmt->bindParam(":id_checklist", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

      #EDITAR CHECKLIST
    #-------------------------------------
	public static function editarPartidasCheckListModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_checklist_partidas = :id_checklist_partidas");
		$stmt->bindParam(":id_checklist_partidas", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}


    public static function actualizarChecklistModel($datosModel, $tabla){
		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fecha_checklist=:fecha_checklist, unidad_mazda=:unidad_mazda, 
                kilometraje=:kilometraje, observaciones=:observaciones WHERE id_checklist=:id_checklist");
		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$stmt->bindParam(":fecha_checklist", $datosModel["fecha_checklist"], PDO::PARAM_STR);
        $stmt->bindParam(":unidad_mazda", $datosModel["unidad_checklist"], PDO::PARAM_INT);
		$stmt->bindParam(":kilometraje", $datosModel["kilometraje_checklist"], PDO::PARAM_INT);
        $stmt->bindParam(":observaciones", $datosModel["observaciones_checklist"], PDO::PARAM_STR);
        $stmt->bindParam(":id_checklist", $datosModel["id_checklist_editar"], PDO::PARAM_INT);
		if($stmt->execute()){
            return "success";
		} else {
			return $stmt->errorInfo();
		}
		$stmt->close();
	}

    public static function actualizarPartidasChecklistModel($datosModel, $tabla){
		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado_general=:estado_general, 
                observaciones_partida=:observaciones_partida WHERE id_partida=:id_partida");
		$stmt->bindParam(":estado_general", $datosModel["estado_general"], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones_partida", $datosModel["observaciones_partida"], PDO::PARAM_STR);
		$stmt->bindParam(":id_partida", $datosModel["id_partida"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		} else {
			return $stmt->errorInfo();
		}
		$stmt->close();
	}

    #VISTA PARTIDAS USARIOS PARA FINALIZAR SU TURNO
	#-------------------------------------
	public static function vistaPartidasFinalizarUsariosTablaModel(){
		$stmt = Conexion::conectar()->prepare("SELECT id_u_p_os, id_unidad_servicio,
                CONCAT(nombre_u,' ',ape_pat_u,' ',ape_mat_u)as nombreCompleto, fecha_asignacion, descripcion_serv
                FROM usuario_partida_os
                LEFT JOIN usuarios ON usuarios.id_usuario = usuario_partida_os.id_partida_os
                LEFT JOIN partidas_os ON partidas_os.id_partida_os = usuario_partida_os.id_partida_os
                LEFT JOIN servicios_atr ON servicios_atr.codigo_atr_serv =  partidas_os.codigo_partida_os
                LEFT JOIN ordenServicio ON ordenServicio.num_orden = partidas_os.num_orden_partida_os
                WHERE fecha_termino IS NULL");
		$stmt->execute();
		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();
		$stmt->close();
	}

    public static function finalizarTurnoUsuarioModel($datosModel, $tabla){
		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fecha_termino=(SELECT now())
                WHERE id_u_p_os=:id_u_p_os");
		$stmt->bindParam(":id_u_p_os", $datosModel["id_partida_finalizar"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		} else {
			return $stmt->errorInfo();
		}
		$stmt->close();
	}

	public static function vistaCalculoManoObraDirectaModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT descripcion_serv, observaciones_os, fecha_asignacion, fecha_termino, 
				nombre_u, (salario_usuario/3360)as salario_minuto, 
				TIMESTAMPDIFF(MINUTE, fecha_asignacion, fecha_termino) AS tiempo_diferencia 
				FROM $tabla upo 
				LEFT JOIN partidas_os po ON po.id_partida_os = upo.id_partida_os 
				LEFT JOIN servicios_atr s ON s.codigo_atr_serv = po.codigo_partida_os 
				LEFT JOIN usuarios u ON u.id_usuario = upo.id_usuario_r 
				WHERE upo.id_partida_os = :id_partida_os");
		$stmt->bindParam(":id_partida_os", $datosModel["id_partida_os"], PDO::PARAM_INT);
		if($stmt->execute()){
			return $stmt->fetchAll();
		} else {
			return $stmt->errorInfo();
		}
		$stmt->close();
	}

  	#OBTENER PARTIDAS DE LA ORDEN DE SERVICIO PARA CALCULAR MANO DE OBRA DIRECTA
    #-------------------------------------
	public static function obtenerPartidasOSXOSModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT id_partida_os FROM $tabla WHERE num_orden_partida_os = :num_orden_partida_os");
		$stmt->bindParam(":num_orden_partida_os", $datosModel["os_buscar"], PDO::PARAM_INT);	
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}


    public static function iniciarFinalizarServicioModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fecha_inicio_partida_os = :fecha_inicio_partida_os,
                fecha_termino_partida_os = :fecha_termino_partida_os, comentarios_os = :comentarios_os, 
                estado_partida_os = :estado_partida_os  WHERE id_partida_os = :id_partida_os");	
        $fecha_inicio = date_create($datosModel['fecha_inicio']);
        $fecha_inicio_formato = date_format($fecha_inicio, "Y-m-d H:i:s");
        $fecha_termino = date_create($datosModel['fecha_termino']);
        $fecha_termino_formato =date_format($fecha_termino, "Y-m-d H:i:s");
		$id_usuario_creacion = $_SESSION["id_usuario"];
		$estado = "TERMINADO";	
		$tipo_m = "U";						
		$valores =  $datosModel["comentarios_os"] . "," . $estado ;
        $stmt->bindParam(":comentarios_os", $datosModel["comentarios_os"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_inicio_partida_os", $fecha_inicio_formato, PDO::PARAM_STR);
        $stmt->bindParam(":fecha_termino_partida_os", $fecha_termino_formato, PDO::PARAM_STR);
		$stmt->bindParam(":estado_partida_os", $estado, PDO::PARAM_STR);
        $stmt->bindParam(":id_partida_os", $datosModel["id_partida_os"], PDO::PARAM_INT);
        
        $insert = Conexion::conectar()->prepare("INSERT INTO movimientos_partidas_os(id_usuario_m, id_partida_os_m, valores_m, 
					    fecha_m, tipo_m) VALUES (:id_usuario_m, :id_partida_os_m, :valores_m, (SELECT NOW()), :tipo_m)");
		    $insert->bindParam(":id_usuario_m", $id_usuario_creacion, PDO::PARAM_INT);
		    $insert->bindParam(":id_partida_os_m", $datosModel["id_partida_os"], PDO::PARAM_INT);
		    $insert->bindParam(":valores_m", $valores, PDO::PARAM_STR);
		    $insert->bindParam(":tipo_m", $tipo_m, PDO::PARAM_STR);

		if($stmt->execute()){
			if($insert->execute()){
                return "success";
			}
			else{
				$arr = $insert->errorInfo();
			    return $arr;
			}
			
		}else{
			$arr = $stmt->errorInfo();
			return $arr;
		}
        $stmt->close();  
        $insert->close();
	}

    public static function asigarUsuariosIniciarFinalizarServicioModel($datosModel, $tabla){
        $asignarUser = Conexion::conectar()->prepare("INSERT INTO $tabla(id_partida_os, id_usuario_r, 
                                        id_supervisor_a, fecha_asignacion, fecha_termino) VALUES (:id_partida_os, :id_usuario_r, 
                                        :id_supervisor_a, :fecha_asignacion, :fecha_termino)");
        $fecha_inicio = date_create($datosModel['fecha_inicio']);
        $fecha_inicio_formato = date_format($fecha_inicio, "Y-m-d H:i:s");
        $fecha_termino = date_create($datosModel['fecha_termino']);
        $fecha_termino_formato =date_format($fecha_termino, "Y-m-d H:i:s");
        $id_usuario_creacion = $_SESSION["id_usuario"];
        $asignarUser->bindParam(":id_usuario_r", $datosModel["usuario"], PDO::PARAM_INT);
		$asignarUser->bindParam(":id_partida_os", $datosModel["id_partida_os"], PDO::PARAM_INT);
		$asignarUser->bindParam(":id_supervisor_a", $id_usuario_creacion, PDO::PARAM_INT);
		$asignarUser->bindParam(":fecha_asignacion", $fecha_inicio_formato, PDO::PARAM_STR);
        $asignarUser->bindParam(":fecha_termino", $fecha_termino_formato, PDO::PARAM_STR);
        if($asignarUser->execute()){
            return "success";
        }else{
            $arr = $asignarUser->errorInfo();
            return $arr;
        }
        $asignarUser->close();
    }

	public static function finalizarOSModel($datosModel, $tabla){
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fecha_termino = :fecha_termino, estado = :estado, 
                avance_porcentaje = :avance_porcentaje, fecha_liberacion = :fecha_liberacion  WHERE num_orden = :num_orden");
        $fecha_inicio = date_create($datosModel['fecha_termino']);
        $fecha_inicio_formato = date_format($fecha_inicio, "Y-m-d H:i:s");
        $fecha_liberacion = date_create($datosModel['fecha_liberacion']);
        $fecha_liberacion_formato = date_format($fecha_liberacion, "Y-m-d H:i:s");
        $estado = "TERMINADO";
        $avance_porcentaje = "100.00";
        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
        $stmt->bindParam(":avance_porcentaje", $avance_porcentaje, PDO::PARAM_STR);
        $stmt->bindParam(":fecha_termino", $fecha_inicio_formato, PDO::PARAM_STR);
        $stmt->bindParam(":fecha_liberacion", $fecha_liberacion_formato, PDO::PARAM_STR);        
        $stmt->bindParam(":num_orden", $datosModel["orden_servicio"], PDO::PARAM_INT);
        if($stmt->execute()){
            return "success";
        } else {
            $err = $stmt->errorInfo();
            return $err;
        }
        $stmt->close();
    }


    public static function registroProcesoGeneralModel($datosModel, $tabla){
		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (descripcion_proceso_general, comentarios_proceso_general)
        										 VALUES (:descripcion_proceso_general, :comentarios_proceso_general)");	
		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$stmt->bindParam(":descripcion_proceso_general", $datosModel["descripcion_proceso_general"], PDO::PARAM_STR);
		$stmt->bindParam(":comentarios_proceso_general", $datosModel["comentarios_proceso_general"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "success";
		} else{
			return $stmt->errorInfo();
		}
		$stmt->close();
	}

    public static function registroProcesoModel($datosModel, $tabla){
		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.
		
        $validacion = Conexion::conectar()->prepare("SELECT descripcion_proceso FROM $tabla 
                        WHERE descripcion_proceso=:descripcion_proceso AND id_proceso_general_pp = :id_proceso_general_pp");
        $validacion->bindParam(":id_proceso_general_pp", $datosModel["id_proceso_general_pp"], PDO::PARAM_INT);
        $validacion->bindParam(":descripcion_proceso", $datosModel["descripcion_proceso"], PDO::PARAM_STR);
        $validacion->execute();
        $num_rows = $validacion->fetchColumn();
        if ($num_rows == ""){ 
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo_proceso, id_proceso_general_pp, descripcion_proceso,
                    comentarios_proceso, tiempo_promedio_proceso) VALUES (:codigo_proceso, :id_proceso_general_pp, 
                    :descripcion_proceso, :comentarios_proceso, :tiempo_promedio_proceso)");	
		    #bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		    $stmt->bindParam(":codigo_proceso", $datosModel["codigo_proceso"], PDO::PARAM_STR);
		    $stmt->bindParam(":id_proceso_general_pp", $datosModel["id_proceso_general_pp"], PDO::PARAM_INT);
            $stmt->bindParam(":descripcion_proceso", $datosModel["descripcion_proceso"], PDO::PARAM_STR);
            $stmt->bindParam(":comentarios_proceso", $datosModel["comentarios_proceso"], PDO::PARAM_STR);
            $stmt->bindParam(":tiempo_promedio_proceso", $datosModel["tiempo_promedio_proceso"], PDO::PARAM_INT);
		    if($stmt->execute()){
    			return "success";
	    	} else{
		    	return $stmt->errorInfo();
		    }
		    $stmt->close();
        }else{
            return "duplicado";
        }
        $validacion->close();
	}


    #VISTA PROCESOS POR CATEGORIA 
    public static function vistaProcesosModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT *, descripcion_proceso_general 
                                FROM $tabla
                                LEFT JOIN procesos_general ON id_proceso_general = id_proceso_general_pp");	
		$stmt->execute();
		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();
		$stmt->close();
	}

    #EDITAR PROCESO GRAL
	#-------------------------------------
	public static function editarProcesoGeneralModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT *	FROM $tabla WHERE id_proceso_general = :id_proceso_general");
		$stmt->bindParam(":id_proceso_general", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}
    
    #ACTUALIZAR PROCESO GENERAL
	#-------------------------------------

	public static function actualizarProcesoGralModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion_proceso_general = :descripcion_proceso_general, 
                comentarios_proceso_general = :comentarios_proceso_general
												WHERE id_proceso_general = :id_proceso_general");		
        $stmt->bindParam(":descripcion_proceso_general", $datosModel["descripcion_proceso"], PDO::PARAM_STR);
		$stmt->bindParam(":comentarios_proceso_general", $datosModel["comentarios_proceso"], PDO::PARAM_STR);
        $stmt->bindParam(":id_proceso_general", $datosModel["id_proceso_actualizar"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
            $error = $stmt->errorInfo();
            return $error;
		}
		$stmt->close();
	}    
    
    #BORRAR DATO DE UNA TABLA INDICANDO LA COLUMNA COMO ID
	#------------------------------------
	public static function borrarDatoModel($datosModel, $tabla, $columna){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $columna = :$columna");
		$stmt->bindParam(":$columna", $datosModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

    #OBTENER DATOS COMPLETOS DE UNA TABLA INDICANDO EL NOMBRE DE COLUMNA Y TABLA Y ENVIANDO EL ID
	#-------------------------------------
	public static function editarGeneralModel($datosModel, $tabla, $columna){
		$stmt = Conexion::conectar()->prepare("SELECT *	FROM $tabla WHERE $columna = :$columna");
		$stmt->bindParam(":$columna", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

    public static function actualizarProcesoModel($datosModel, $tabla){
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion_proceso = :descripcion_proceso, 
                        codigo_proceso = :codigo_proceso, id_proceso_general_pp = :id_proceso_general_pp, 
                        comentarios_proceso = :comentarios_proceso, tiempo_promedio_proceso = :tiempo_promedio_proceso
						WHERE id_proceso_prod = :id_proceso_prod");		
        $stmt->bindParam(":descripcion_proceso", $datosModel["descripcion_proceso"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo_proceso", $datosModel["codigo_proceso"], PDO::PARAM_STR);
        $stmt->bindParam(":id_proceso_general_pp", $datosModel["id_proceso_general_pp"], PDO::PARAM_INT);
        $stmt->bindParam(":comentarios_proceso", $datosModel["comentarios_proceso"], PDO::PARAM_STR);
        $stmt->bindParam(":tiempo_promedio_proceso", $datosModel["tiempo_promedio_proceso"], PDO::PARAM_STR);
        $stmt->bindParam(":id_proceso_prod", $datosModel["id_proceso_editar"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
            $error = $stmt->errorInfo();
            return $error;
		}
		$stmt->close();
    }

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

    #REGISTRAR CLIENTES NUEVOS
    public static function registrarClienteModel($dataModel, $tabla){
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(razon_social_cliente, codigo_proyecto_cliente) 
                VALUES (:razon_social_cliente, :codigo_proyecto_cliente)");
        $stmt->bindParam(":razon_social_cliente", $dataModel["razon_social_cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":codigo_proyecto_cliente", $dataModel["codigo_proyecto_cliente"], PDO::PARAM_STR);
        if($stmt->execute())
            return "success";
        else{
            $error = $stmt->errorInfo();
            return $error;
        }
    }
    
}
?>