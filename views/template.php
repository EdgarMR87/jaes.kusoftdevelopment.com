<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv=”refresh” content=”15″>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/estiloAcceso.css">
	<link rel="stylesheet" href="/views/estiloTemplate.css">
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js" integrity="sha512-VMsZqo0ar06BMtg0tPsdgRADvl0kDHpTbugCBBrL55KmucH6hP9zWdLIWY//OTfMnzz6xWQRxQqsUFefwHuHyg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <link rel="shortcut icon" href="views/img/jaeslogo.png" type="image/png">
    
    <script type="text/javascript" src="/views/modules/sweetalerts.js"></script>
	<script>
    
  	$(document).ready(function(){

      $("#departamento").on('change', function(){
			let id_departamento =  document.getElementById('departamento').value;
    		var dataen = 'id_departamento=' + id_departamento;	
    		$.ajax({
        		type:'post',
        		url:'/views/modules/Usuarios/obtenerPuestosId.php',
        		data: dataen, 
        		dataType: "html",     
        		success: function(resp){      	      
          		  	$("#puesto").html(resp);
        		}
    		});
    		return false;
        });

		$("#servicio").on('change', function(){
			let servicio =  document.getElementById('servicio').value;
			switch(servicio){
				case "PREVENTIVO":
					$('#tipo_servicio').empty();
					$('#tipo_servicio').prepend("<option value='A' >A</option>");
					$('#tipo_servicio').prepend("<option value='AB' >AB</option>");
					$('#tipo_servicio').prepend("<option value='ABC' >ABC</option>");
					break;
				default:
				$('#tipo_servicio').empty();
				$('#tipo_servicio').prepend("<option value='"+servicio+"'>"+servicio+"</option>");
			}
		});

        
$('#li-usuarios').click(function(event){
    $('#submenu-usuarios').css('display', 'block');
    $('#submenu-almacen').css('display', 'none');
    $('#contenido').css('display', 'none');    
});

$('#li-almacen').click(function(event){
    $('#submenu-almacen').css('display', 'block');
    $('#submenu-usuarios').css('display', 'none');
    $('#contenido').css('display', 'none');
});


});

</script>

</head>

<body>
<section>
<?php 

session_start();

if(isset($_SESSION["id_departamento"])){
    switch($_SESSION["id_departamento"]){
        case "10":
	        if(isset($_SESSION["id_usuario"]))    
            $_SESSION["autentificado"] = "SI"; 
		    include "views/modules/navegacionAtr.php";
		    $mvc = new MvcController();
		    $mvc -> enlacesPaginasAtrController();
            echo "</section>";
            include "footer.php";
	    break;
	    case "1" || "17":
		    if(isset($_SESSION["id_usuario"]))
            $_SESSION["autentificado"] = "SI";
	        include "views/modules/navegacion.php"; 
	    	$mvc = new MvcController();
		    $mvc -> enlacesPaginasController();
            echo "</section>";
            include "footer.php";
	    break;
        
    }  
}else{
    $mvc = new MvcController();
    $mvc -> enlacesPaginasController();
    echo "</section>";
    include "footer.php";
}

 ?>

</body>

</html>