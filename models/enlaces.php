<?php 

class Paginas{
	
	public static function enlacesPaginasModel($enlaces){

		if($enlaces == "Usuarios/usuarios" || $enlaces == "Usuarios/registro" || $enlaces == "Usuarios/editar"){

			$module =  "views/modules/".$enlaces.".php";

		}	else if($enlaces == "Puestos/listadoPuesto" || $enlaces == "Puestos/registro_puesto" ||
        $enlaces == "Puestos/editarPuesto"){

			$module =  "views/modules/".$enlaces.".php";

		}	else if($enlaces == "Departamentos/listadoDpto" || $enlaces == "Departamentos/registro_dpto" 
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
		
		}

		else if($enlaces == "fallo"){

			$module =  "views/modules/Usuarios/ingresar.php";
		
		}

		else if($enlaces == "cambio"){

			$module =  "views/modules/Usuarios/usuarios.php";
		
		}
	    else if($enlaces == "salir"){

			$module =  "views/modules/salir.php";
		
		}

		else{

			$module =  "views/modules/index.php";

		}
		
		return $module;

	}
}

    class PaginasAtr{
	
        public static function enlacesPaginasAtrModel($enlaces){
    
            if($enlaces == "OrdenesServicio/altaOrdenS" || $enlaces == "OrdenesServicio/listadoOS" || 
                $enlaces == "Unidades/listadoUnidades" || $enlaces == "Unidades/altaUnidad" || $enlaces == "Unidades/editarUnidad"
				|| $enlaces == "ServiciosAtr/altaServicioAtr" || $enlaces == "ServiciosAtr/listadoServiciosAtr"
                || $enlaces == "ServiciosAtr/editarServicioAtr" || $enlaces == "OrdenesServicio/detalleOS"
				|| $enlaces == "OrdenesServicio/iniciarServicio" || $enlaces == "OrdenesServicio/finalizarServicio"
				|| $enlaces == "OrdenesServicio/usuariosAsignados"){
    
                $module =  "views/modules/".$enlaces.".php";
    			//VALIDAMOS SI SE DIO DE ALTA OK LA UNIDAD
            }	else if($enlaces == "Unidades/altaUnidadOk"){
				
				$module =  "views/modules/Unidades/altaUnidad.php";
                
    			//VALIDAMOS CUANDO SE REALIZA UN CAMBIO OK A LAS UNIDADES
            }	else if($enlaces == "Unidades/cambiok"){

				$module =  "views/modules/Unidades/listadoUnidades.php";
    
            }  else  if($enlaces == "ServiciosAtr/altaServicioAtrok"){

				$module =  "views/modules/ServiciosAtr/altaServicioAtr.php";
            //VALIDAMOS SI SE DIO DE ALTA LA ORDEN DE SERVICIO
            }else if($enlaces == ""){
    
                
            }else if($enlaces == "index"){
    
    
            }else if($enlaces == "ok"){
            
                $module =  "views/modules/ServiciosAtr/listadoUnidades.php";
            
            }
    
            else if($enlaces == "fallo"){
    
                
            
            }
    
            else if($enlaces == "cambio"){
    
                
            
            }
            else if($enlaces == "salir"){

				$module =  "views/modules/salir.php";
			
			}
	
    
            else{
    
                
    
            }
            
            return $module;
    
        }
    
}


?>