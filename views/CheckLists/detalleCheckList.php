<div class="tablas-listado" id="contenido">
    <div class="panel-checklist">
        <div>
	        <table class="tabla-listado" id="listado-os">	
		        <thead>	
			        <tr>
				        <th class="listado-th">CARROCERIA</th>
				        <th class="listado-th">BUENO</th>
				        <th class="listado-th">MALO</th>
				        <th class="listado-th">OBSERVACIONES</th>
			        </tr>
		        </thead>
		        <tbody>
			    <?php
                ini_set('display_errors', '1');
                ini_set('error_reporting', E_ALL);
			    $vistaUsuario = new MvcController();
			    $respuesta = $vistaUsuario->vistaDetalleChecklistTablaController($_GET["id_checklist_editar"]);
                foreach($respuesta as $row => $item){        

                switch ($item["parte_revisada"]) {
                    case 'CRISTALES':
                    case 'ESPEJOS':
                    case 'PARABRISAS':
                    case 'BATERIAS':        
                echo'<tr>
                        <td class="num_orden">'.$item["parte_revisada"].'</td>';
                        if('.$item["estado_general"].' == "bueno"){
                           echo '<td>
                                    <img src="/views/img/paloma.png" class="img-25"></img></td>
                            <td></td>';
                        }else{
                           echo '<td></td>
                            <td><img src="/views/img/paloma.png" class="img-25"></img></td>';
                        }   
                        echo '
                        <td>'.$item["observaciones_partida"].'</td>
                    </tr>';
                    break;    
                }
                }			 
			    ?>
		        </tbody>
	        </table>
        </div>
        <div>
            <table class="tabla-listado" id="listado-os">	
		        <thead>	
			        <tr>
				        <th class="listado-th">ELECTRICO</th>
				        <th class="listado-th">BUENO</th>
    				    <th class="listado-th">MALO</th>
	        			<th class="listado-th">OBSERVACIONES</th>
        			</tr>
        		</thead>
        		<tbody>
                <?php
                    foreach($respuesta as $row => $item){
                        switch ($item["parte_revisada"]) {
                            case 'ENCENDIDO DE LUCES':
                            case 'PLAFONES':
                            case 'LUZ DE TRABAJO':       
                            echo'<tr>
                                <td class="num_orden">'.$item["parte_revisada"].'</td>';
                            if('.$item["estado_general"].' == "bueno"){
                                echo '<td>
                                <img src="/views/img/paloma.png" class="img-25"></img></td>
                                <td></td>';
                            }else{
                                echo '<td></td>
                                <td><img src="/views/img/paloma.png" class="img-25"></img></td>';
                            }   
                            echo '
                            <td>'.$item["observaciones_partida"].'</td>
                            </tr>';
                            break;              
                        }
                    }			 
                ?>
                </tbody>
            </table>
        </div>
        <div>
            <table class="tabla-listado" id="listado-os">	
		        <thead>	
			    <tr>
    				<th class="listado-th">NIVELES</th>
	    			<th class="listado-th">SI</th>
		    		<th class="listado-th">NO</th>
			    	<th class="listado-th">OBSERVACIONES</th>
			    </tr>
		        </thead>
        		<tbody>
                <?php
                    foreach($respuesta as $row => $item){
                        switch ($item["parte_revisada"]) {
                            case 'NIVEL DE MOTOR':
                            case 'NIVEL DE ANTICONGELANTE':
                            case 'NIVEL DE DIRECCION HD':       
                            case 'CLUTCH':       
                            echo'<tr>
                                <td class="num_orden">'.$item["parte_revisada"].'</td>';
                            if('.$item["estado_general"].' == "si"){
                                echo '<td>
                                <img src="/views/img/paloma.png" class="img-25"></img></td>
                                <td></td>';
                            }else{
                               echo '<td></td>
                                <td><img src="/views/img/paloma.png" class="img-25"></img></td>';
                            }   
                            echo '
                            <td>'.$item["observaciones_partida"].'</td>
                            </tr>';
                            break;
                        }
                    }			 
                ?>
                </tbody>
            </table>
        </div>
        <div>
            <table class="tabla-listado" id="listado-os">	
		        <thead>	
			    <tr>
    				<th class="listado-th"></th>
	    			<th class="listado-th">BUENO</th>
		    		<th class="listado-th">MAL</th>
			    	<th class="listado-th">OBSERVACIONES</th>
			    </tr>
		        </thead>
        		<tbody>
                <?php
                    foreach($respuesta as $row => $item){
                        switch ($item["parte_revisada"]) {
                            case 'ADMISION':
                            case 'BANDAS':   
                            echo'<tr>
                                <td class="num_orden">'.$item["parte_revisada"].'</td>';
                            if('.$item["estado_general"].' == "bueno"){
                                echo '<td>
                                <img src="/views/img/paloma.png" class="img-25"></img></td>
                                <td></td>';
                            }else{
                               echo '<td></td>
                                <td><img src="/views/img/paloma.png" class="img-25"></img></td>';
                            }   
                            echo '
                            <td>'.$item["observaciones_partida"].'</td>
                            </tr>';
                            break;
                        }
                    }			 
                ?>
                </tbody>
            </table>
        </div>
        <div>
            <table class="tabla-listado" id="listado-os">	
		        <thead>	
			        <tr>
				        <th class="listado-th">FUGAS DE ACEITE</th>
				        <th class="listado-th">SI</th>
    				    <th class="listado-th">NO</th>
	        			<th class="listado-th">OBSERVACIONES</th>
        			</tr>
        		</thead>
        		<tbody>
                <?php
                    foreach($respuesta as $row => $item){
                        switch ($item["parte_revisada"]) {
                            case 'FUGA ACEITE MOTOR':
                            case 'FUGA ACEITE TRANSMISION':
                            case 'FUGA ACEITE DIFERENCIAL':       
                            echo'<tr>
                                <td class="num_orden">'.$item["parte_revisada"].'</td>';
                            if('.$item["estado_general"].' == "si"){
                                echo '<td>
                                <img src="/views/img/paloma.png" class="img-25"></img></td>
                                <td></td>';
                            }else{
                                echo '<td></td>
                                <td><img src="/views/img/paloma.png" class="img-25"></img></td>';
                            }   
                            echo '
                            <td>'.$item["observaciones_partida"].'</td>
                            </tr>';
                            break;              
                        }
                    }			 
                ?>
                </tbody>
            </table>
        </div>
        <div>
            <table class="tabla-listado" id="listado-os">	
		        <thead>	
			        <tr>
				        <th class="listado-th">REVISION DE PASA MUROS</th>
				        <th class="listado-th">BUENO</th>
    				    <th class="listado-th">MAL</th>
	        			<th class="listado-th">OBSERVACIONES</th>
        			</tr>
        		</thead>
        		<tbody>
                <?php
                    foreach($respuesta as $row => $item){
                        switch ($item["parte_revisada"]) {
                            case 'PASAMUROS ELECTRICO':
                            case 'PASAMUROS HIDRAULICO':
                            case 'PASAMUROS NEUMATICO':       
                            echo'<tr>
                                <td class="num_orden">'.$item["parte_revisada"].'</td>';
                            if('.$item["estado_general"].' == "bueno"){
                                echo '<td>
                                <img src="/views/img/paloma.png" class="img-25"></img></td>
                                <td></td>';
                            }else{
                                echo '<td></td>
                                <td><img src="/views/img/paloma.png" class="img-25"></img></td>';
                            }   
                            echo '
                            <td>'.$item["observaciones_partida"].'</td>
                            </tr>';
                            break;              
                        }
                    }			 
                ?>
                </tbody>
            </table>
        </div>
        <div>
            <table class="tabla-listado" id="listado-os">	
		        <thead>	
			        <tr>
				        <th class="listado-th">TAPAS</th>
				        <th class="listado-th">SI</th>
    				    <th class="listado-th">NO</th>
	        			<th class="listado-th">OBSERVACIONES</th>
        			</tr>
        		</thead>
        		<tbody>
                <?php
                    foreach($respuesta as $row => $item){
                        switch ($item["parte_revisada"]) {
                            case 'TAPAS1':
                            case 'TAPAS3':
                            case 'TAPAS5': 
                            case 'TAPAS7':
                            case 'TAPAS9':                            
                            echo'<tr>
                                <td class="num_orden">'.$item["parte_revisada"].'</td>';
                            if('.$item["estado_general"].' == "si"){
                                echo '<td>
                                <img src="/views/img/paloma.png" class="img-25"></img></td>
                                <td></td>';
                            }else{
                                echo '<td></td>
                                <td><img src="/views/img/paloma.png" class="img-25"></img></td>';
                            }   
                            echo '
                            <td>'.$item["observaciones_partida"].'</td>
                            </tr>';
                            break;              
                        }
                    }			 
                ?>
                </tbody>
            </table>
        </div>
        <div>
            <table class="tabla-listado" id="listado-os">	
		        <thead>	
			        <tr>
				        <th class="listado-th">TAPAS</th>
				        <th class="listado-th">SI</th>
    				    <th class="listado-th">NO</th>
	        			<th class="listado-th">OBSERVACIONES</th>
        			</tr>
        		</thead>
        		<tbody>
                <?php
                    foreach($respuesta as $row => $item){
                        switch ($item["parte_revisada"]) {
                            case 'TAPAS2':
                            case 'TAPAS4':
                            case 'TAPAS6': 
                            case 'TAPAS8':
                            case 'TAPAS10':                            
                            echo'<tr>
                                <td class="num_orden">'.$item["parte_revisada"].'</td>';
                            if('.$item["estado_general"].' == "si"){
                                echo '<td>
                                <img src="/views/img/paloma.png" class="img-25"></img></td>
                                <td></td>';
                            }else{
                                echo '<td></td>
                                <td><img src="/views/img/paloma.png" class="img-25"></img></td>';
                            }   
                            echo '
                            <td>'.$item["observaciones_partida"].'</td>
                            </tr>';
                            break;              
                        }
                    }			 
                ?>
                </tbody>
            </table>
        </div>
        <div>
            <table class="tabla-listado" id="listado-os">	
		        <thead>	
			        <tr>
				        <th class="listado-th">LLANTAS PONCHADAS</th>
				        <th class="listado-th">SI</th>
    				    <th class="listado-th">NO</th>
	        			<th class="listado-th">OBSERVACIONES</th>
        			</tr>
        		</thead>
        		<tbody>
                <?php
                    foreach($respuesta as $row => $item){
                        switch ($item["parte_revisada"]) {
                            case 'LLANTAS1':   case 'LLANTAS11':   
                            case 'LLANTAS3':   case 'LLANTAS13':   
                            case 'LLANTAS5':   case 'LLANTAS15':   
                            case 'LLANTAS7':   case 'LLANTAS17':   
                            case 'LLANTAS9':                        
                            echo'<tr>
                                <td class="num_orden">'.$item["parte_revisada"].'</td>';
                            if('.$item["estado_general"].' == "si"){
                                echo '<td>
                                <img src="/views/img/paloma.png" class="img-25"></img></td>
                                <td></td>';
                            }else{
                                echo '<td></td>
                                <td><img src="/views/img/paloma.png" class="img-25"></img></td>';
                            }   
                            echo '
                            <td>'.$item["observaciones_partida"].'</td>
                            </tr>';
                            break;              
                        }
                    }			 
                ?>
                </tbody>
            </table>
        </div>
        <div>
            <table class="tabla-listado" id="listado-os">	
		        <thead>	
			        <tr>
				        <th class="listado-th">LLANTAS PONCHADAS</th>
				        <th class="listado-th">SI</th>
    				    <th class="listado-th">NO</th>
	        			<th class="listado-th">OBSERVACIONES</th>
        			</tr>
        		</thead>
        		<tbody>
                <?php
                    foreach($respuesta as $row => $item){
                        switch ($item["parte_revisada"]) {
                            case 'LLANTAS2':   case 'LLANTAS12':   
                            case 'LLANTAS4':   case 'LLANTAS14':   
                            case 'LLANTAS6':   case 'LLANTAS16':   
                            case 'LLANTAS8':   case 'LLANTAS18':   
                            case 'LLANTAS10':                        
                            echo'<tr>
                                <td class="num_orden">'.$item["parte_revisada"].'</td>';
                            if('.$item["estado_general"].' == "si"){
                                echo '<td>
                                <img src="/views/img/paloma.png" class="img-25"></img></td>
                                <td></td>';
                            }else{
                                echo '<td></td>
                                <td><img src="/views/img/paloma.png" class="img-25"></img></td>';
                            }   
                            echo '
                            <td>'.$item["observaciones_partida"].'</td>
                            </tr>';
                            break;              
                        }
                    }			 
                ?>
                </tbody>
            </table>
        </div>
        <div>
            <table class="tabla-listado" id="listado-os">	
		        <thead>	
			        <tr>
				        <th class="listado-th"></th>
				        <th class="listado-th">BUENO</th>
    				    <th class="listado-th">MAL</th>
	        			<th class="listado-th">OBSERVACIONES</th>
        			</tr>
        		</thead>
        		<tbody>
                <?php
                    foreach($respuesta as $row => $item){
                        switch ($item["parte_revisada"]) {
                            case 'ARRANQUE':                
                            echo'<tr>
                                <td class="num_orden">'.$item["parte_revisada"].'</td>';
                            if('.$item["estado_general"].' == "si"){
                                echo '<td>
                                <img src="/views/img/paloma.png" class="img-25"></img></td>
                                <td></td>';
                            }else{
                                echo '<td></td>
                                <td><img src="/views/img/paloma.png" class="img-25"></img></td>';
                            }   
                            echo '
                            <td>'.$item["observaciones_partida"].'</td>
                            </tr>';
                            break;              
                        }
                    }			 
                ?>
                </tbody>
            </table>
        </div>

        <div>
            <table class="tabla-listado" id="listado-os">	
		        <thead>	
			        <tr>
				        <th class="listado-th"></th>
				        <th class="listado-th">BUENO</th>
    				    <th class="listado-th">MAL</th>
	        			<th class="listado-th">OBSERVACIONES</th>
        			</tr>
        		</thead>
        		<tbody>
                <?php
                    foreach($respuesta as $row => $item){
                        switch ($item["parte_revisada"]) {
                            case 'TAKE OFF':                
                            echo'<tr>
                                <td class="num_orden">'.$item["parte_revisada"].'</td>';
                            if('.$item["estado_general"].' == "si"){
                                echo '<td>
                                <img src="/views/img/paloma.png" class="img-25"></img></td>
                                <td></td>';
                            }else{
                                echo '<td></td>
                                <td><img src="/views/img/paloma.png" class="img-25"></img></td>';
                            }   
                            echo '
                            <td>'.$item["observaciones_partida"].'</td>
                            </tr>';
                            break;              
                        }
                    }			 
                ?>
                </tbody>
            </table>
        </div>
        <div>
            <table class="tabla-listado" id="listado-os">	
		        <thead>	
			        <tr>
				        <th class="listado-th"></th>
				        <th class="listado-th">BUENO</th>
    				    <th class="listado-th">MAL</th>
	        			<th class="listado-th">OBSERVACIONES</th>
        			</tr>
        		</thead>
        		<tbody>
                <?php
                    foreach($respuesta as $row => $item){
                        switch ($item["parte_revisada"]) {
                            case 'PISO TRACTOR': case 'PISO REMOLQUE':                
                            echo'<tr>
                                <td class="num_orden">'.$item["parte_revisada"].'</td>';
                            if('.$item["estado_general"].' == "si"){
                                echo '<td>
                                <img src="/views/img/paloma.png" class="img-25"></img></td>
                                <td></td>';
                            }else{
                                echo '<td></td>
                                <td><img src="/views/img/paloma.png" class="img-25"></img></td>';
                            }   
                            echo '
                            <td>'.$item["observaciones_partida"].'</td>
                            </tr>';
                            break;              
                        }
                    }			 
                ?>
                </tbody>
            </table>
        </div>
        
        <div>
            <table class="tabla-listado" id="listado-os">	
		        <thead>	
			        <tr>
				        <th class="listado-th">HUMEDAD DE ACEITE HD</th>
				        <th class="listado-th">SI</th>
    				    <th class="listado-th">NO</th>
	        			<th class="listado-th">OBSERVACIONES</th>
        			</tr>
        		</thead>
        		<tbody>
                <?php
                    foreach($respuesta as $row => $item){
                        switch ($item["parte_revisada"]) {
                            case 'BLOQUE HD TRACTOR': case 'BLOQUE HD REMOLQUE':
                            echo'<tr>
                                <td class="num_orden">'.$item["parte_revisada"].'</td>';
                            if('.$item["estado_general"].' == "si"){
                                echo '<td>
                                <img src="/views/img/paloma.png" class="img-25"></img></td>
                                <td></td>';
                            }else{
                                echo '<td></td>
                                <td><img src="/views/img/paloma.png" class="img-25"></img></td>';
                            }   
                            echo '
                            <td>'.$item["observaciones_partida"].'</td>
                            </tr>';
                            break;              
                        }
                    }			 
                ?>
                </tbody>
            </table>
        </div>
        <div>
            <table class="tabla-listado" id="listado-os">	
		        <thead>	
			        <tr>
				        <th class="listado-th">RAMPAS</th>
				        <th class="listado-th">BUENO</th>
    				    <th class="listado-th">MAL</th>
	        			<th class="listado-th">OBSERVACIONES</th>
        			</tr>
        		</thead>
        		<tbody>
                <?php
                    foreach($respuesta as $row => $item){
                        switch ($item["parte_revisada"]) {
                            case 'RAMPAS1': case 'RAMPAS2': case 'RAMPAS3': case 'RAMPAS4':case 'RAMPAS5': case 'RAMPAS6':
                            case 'RAMPAS7': case 'RAMPAS8': case 'RAMPAS9': case 'RAMPAS10':case 'RAMPAS11': case 'RAMPAS12':
                            case 'RAMPAS13': case 'RAMPAS14': case 'RAMPAS15': case 'RAMPAS16':case 'RAMPAS17': case 'RAMPAS18':
                            case 'RAMPAS19': case 'RAMPAS20': case 'RAMPAS21': case 'RAMPAS22':case 'RAMPAS23': case 'RAMPAS24':
                            case 'RAMPAS25': case 'RAMPAS26': case 'RAMPAS27': case 'RAMPAS28':case 'RAMPAS29': case 'RAMPAS30':
                            echo'<tr>
                                <td class="num_orden">'.$item["parte_revisada"].'</td>';
                            if('.$item["estado_general"].' == "si"){
                                echo '<td>
                                <img src="/views/img/paloma.png" class="img-25"></img></td>
                                <td></td>';
                            }else{
                                echo '<td></td>
                                <td><img src="/views/img/paloma.png" class="img-25"></img></td>';
                            }   
                            echo '
                            <td>'.$item["observaciones_partida"].'</td>
                            </tr>';
                            break;              
                        }
                    }			 
                ?>
                </tbody>
            </table>
        </div>
        
        <div>
            <table class="tabla-listado" id="listado-os">	
		        <thead>	
			        <tr>
				        <th class="listado-th">PISTONES</th>
				        <th class="listado-th">SI</th>
    				    <th class="listado-th">NO</th>
	        			<th class="listado-th">OBSERVACIONES</th>
        			</tr>
        		</thead>
        		<tbody>
                <?php
                    foreach($respuesta as $row => $item){
                        switch ($item["parte_revisada"]) {
                            case 'PISTONES1': case 'PISTONES2': case 'PISTONES3': case 'PISTONES4':case 'PISTONES5': case 'PISTONES6':
                            case 'PISTONES7': case 'PISTONES8': case 'PISTONES9': case 'PISTONES10':case 'PISTONES11': case 'PISTONES12':
                            case 'PISTONES13': case 'PISTONES14': case 'PISTONES15': case 'PISTONES16':case 'PISTONES17': case 'PISTONES18':
                            case 'PISTONES19': case 'PISTONES20': case 'PISTONES21': case 'PISTONES22':case 'PISTONES23': case 'PISTONES24':
                            case 'PISTONES25': case 'PISTONES26': case 'PISTONES27': case 'PISTONES28':case 'PISTONES29': case 'PISTONES30':
            
                            echo'<tr>
                                <td class="num_orden">'.$item["parte_revisada"].'</td>';
                            if('.$item["estado_general"].' == "si"){
                                echo '<td>
                                <img src="/views/img/paloma.png" class="img-25"></img></td>
                                <td></td>';
                            }else{
                                echo '<td></td>
                                <td><img src="/views/img/paloma.png" class="img-25"></img></td>';
                            }   
                            echo '
                            <td>'.$item["observaciones_partida"].'</td>
                            </tr>';
                            break;              
                        }
                    }			 
                ?>
                </tbody>
            </table>
        </div>
        <div>
            <table class="tabla-listado" id="listado-os">	
		        <thead>	
			        <tr>
				        <th class="listado-th">EL EQUIPO CUENTA CON : </th>
				        <th class="listado-th">SI</th>
    				    <th class="listado-th">NO</th>
	        			<th class="listado-th">OBSERVACIONES</th>
        			</tr>
        		</thead>
        		<tbody>
                <?php
                    foreach($respuesta as $row => $item){
                        switch ($item["parte_revisada"]) {
                            case 'CINCHOS DE TRINCADO':   case 'TENDEDEROS':   
                            case 'MALLA CUBRE AL 100':   case 'CADENA DE TRINCADO':   
                            case 'MARCA EN PTR':  
                            echo'<tr>
                                <td class="num_orden">'.$item["parte_revisada"].'</td>';
                            if('.$item["estado_general"].' == "si"){
                                echo '<td>
                                <img src="/views/img/paloma.png" class="img-25"></img></td>
                                <td></td>';
                            }else{
                                echo '<td></td>
                                <td><img src="/views/img/paloma.png" class="img-25"></img></td>';
                            }   
                            echo '
                            <td>'.$item["observaciones_partida"].'</td>
                            </tr>';
                            break;              
                        }
                    }			 
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>