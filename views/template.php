<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/estiloAcceso.css">
	<link rel="stylesheet" href="/views/estiloTemplate.css">
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.css">
	<link rel="shortcut icon" href="views/img/jaeslogo.png" type="image/png">
	<title><?=$page_title?></title>
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




$('#li-os').click(function(event){
    $('#submenu-os').css('display', 'block');
    $('#submenu-unidades').css('display', 'none');
    $('#submenu-servicios').css('display', 'none');
    $('#contenido').css('display', 'none');    
});


$('#li-unidades').click(function(event){
    $('#submenu-unidades').css('display', 'block');
    $('#submenu-os').css('display', 'none');
    $('#submenu-servicios').css('display', 'none');
    $('#contenido').css('display', 'none');    
});

$('#li-servicios').click(function(event){
    $('#submenu-servicios').css('display', 'block');
    $('#submenu-unidades').css('display', 'none');
    $('#submenu-os').css('display', 'none');
    $('#contenido').css('display', 'none');    
});
	

});

</script>

</head>

<script>

function registroOK(url){
    swal({
        title: "Registro Exitoso",
        text: "Redireccionando en 2 segundos .....",
        type: "success",
        timer: 2000,
        },
        function(){
            window.location = url;
    });
}

function borrarOk(link){
    swal({
        title: "Se elimino el registro Exitosamente!",
        text: "Redireccionando en 2 segundos...",
        type: "success",
        timer: 2000
    }).then(() => {
        window.location.href = link;
    })
}

</script>
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
	    case "1":
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