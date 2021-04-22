<?php 

class Paginas{
	
	public static function enlacesPaginasModel($enlaces){
        session_start();
        if( $_SESSION["autentificado"] == "SI"){
		    if($enlaces == "Usuarios/usuarios" || $enlaces == "Usuarios/registro" || $enlaces == "Usuarios/editar"){
			    $module =  "views/modules/".$enlaces.".php";
    		}else if($enlaces == "Puestos/listadoPuesto" || $enlaces == "Puestos/registro_puesto" ||
            $enlaces == "Puestos/editarPuesto"){                    
			    $module =  "views/modules/".$enlaces.".php";
		    }else if($enlaces == "Departamentos/listadoDpto" || $enlaces == "Departamentos/registro_dpto" 
            || $enlaces == "Departamentos/editarDpto"){

			$module =  "views/modules/".$enlaces.".php";

		    }  else  if($enlaces == "dpto_ok"){

			$module =  "views/modules/Departamentos/registro_dpto.php";

    		}else if($enlaces == "puesto_ok"){

			$module =  "views/modules/Puestos/registro_puesto.php";

            }else if($enlaces == "Usuarios/registrook"){

            $module =  "views/modules/Usuarios/registro.php";

            }else if($enlaces == "index"){
			$module =  "views/modules/Usuarios/ingresar.php";

	    	}else if($enlaces == "ok"){
			$module =  "views/modules/Usuarios/Usuarios.php";	
    		} else if($enlaces == "fallo"){
			$module =  "views/modules/Usuarios/ingresar.php";
		    }  else if($enlaces == "cambio"){
			$module =  "views/modules/Usuarios/usuarios.php";
		
		    }
	        else if($enlaces == "salir"){
			$module =  "views/modules/salir.php";
		
		    }
		    return $module;
	    }else{
            $module =  "views/modules/Usuarios/ingresar.php";
            return $module;
        }
    }
}

    class PaginasAtr{
        public static function enlacesPaginasAtrModel($enlaces){
            session_start();
            if( $_SESSION["autentificado"] == "SI"){
    
                if($enlaces == "OrdenesServicio/altaOrdenS" || $enlaces == "OrdenesServicio/listadoOS" || 
                    $enlaces == "Unidades/listadoUnidades" || $enlaces == "Unidades/altaUnidad" || $enlaces == "Unidades/editarUnidad"
	    			|| $enlaces == "ServiciosAtr/altaServicioAtr" || $enlaces == "ServiciosAtr/listadoServiciosAtr"
                    || $enlaces == "ServiciosAtr/editarServicioAtr" || $enlaces == "OrdenesServicio/detalleOS"
			    	|| $enlaces == "OrdenesServicio/iniciarServicio" || $enlaces == "OrdenesServicio/finalizarServicio"
				    || $enlaces == "OrdenesServicio/usuariosAsignados" || $enlaces == "OrdenesServicio/editarOS"
                    || $enlaces == "OrdenesServicio/asignarUsuarios" || $enlaces == "OrdenesServicio/listadoServiciosEnProceso"
                    || $enlaces == "OrdenesServicio/historialOS"|| $enlaces == "CheckLists/listadoCheckListMazda"
                    || $enlaces == "CheckLists/altaCheckListMazda" || $enlaces == "CheckLists/detalleCheckList"
                    || $enlaces == "CheckLists/editarCheckList" || $enlaces == "OrdenesServicio/finalizarTurnoUsuarios"
                    || $enlaces == "Tiempos/tiemposUnidad"){
                                $module =  "views/modules/".$enlaces.".php";
                } else if($enlaces == "Unidades/altaUnidadOk"){				
        				$module =  "views/modules/Unidades/altaUnidad.php";                
    	        } else if($enlaces == "Unidades/cambiok"){
				        $module =  "views/modules/Unidades/listadoUnidades.php";    
                }  else  if($enlaces == "ServiciosAtr/altaServicioAtrok"){
        				$module =  "views/modules/ServiciosAtr/altaServicioAtr.php";
                }else if($enlaces == "index"){
                        $module =  "views/modules/Usuarios/ingresar.php";   
                }else if($enlaces == "ok"){
                        $module =  "views/modules/OrdenesServicio/listadoOS";
                }else if($enlaces == "fallo"){
                        $module =  "views/modules/Usuarios/ingresar.php";
                } else if($enlaces == "exit"){
                        $module =  "views/modules/salir.php";
			    } else{
                        $module =  "index.php";    
                }
                return $module;
            }else{
                $module =  "views/modules/Usuarios/ingresar.php";
                return $module;
            }
        }
    }

?>