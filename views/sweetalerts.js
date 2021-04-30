
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
    $('#submenu-checklist').css('display', 'none');
    $('#submenu-tiempos').css('display', 'none');
    $('#submenu-reportes').css('display', 'none');
    $('#contenido').css('display', 'none');    
});

$('#li-unidades').click(function(event){
    $('#submenu-unidades').css('display', 'block');
    $('#submenu-os').css('display', 'none');
    $('#submenu-servicios').css('display', 'none');
    $('#submenu-checklist').css('display', 'none');
    $('#submenu-tiempos').css('display', 'none');
    $('#submenu-reportes').css('display', 'none');
    $('#contenido').css('display', 'none');    
});

$('#li-servicios').click(function(event){
    $('#submenu-servicios').css('display', 'block');
    $('#submenu-unidades').css('display', 'none');
    $('#submenu-checklist').css('display', 'none');
    $('#submenu-tiempos').css('display', 'none');
    $('#submenu-reportes').css('display', 'none');
    $('#submenu-os').css('display', 'none');
    $('#contenido').css('display', 'none');    
});


$('#li-checklist').click(function(event){
    $('#submenu-checklist').css('display', 'block');
    $('#submenu-servicios').css('display', 'none');
    $('#submenu-unidades').css('display', 'none');
    $('#submenu-tiempos').css('display', 'none');
    $('#submenu-reportes').css('display', 'none');
    $('#submenu-os').css('display', 'none');
    $('#contenido').css('display', 'none');    
});

$('#li-tiempos').click(function(event){
    $('#submenu-tiempos').css('display', 'block');
    $('#submenu-checklist').css('display', 'none');
    $('#submenu-servicios').css('display', 'none');
    $('#submenu-unidades').css('display', 'none');
    $('#submenu-reportes').css('display', 'none');
    $('#submenu-os').css('display', 'none');
    $('#contenido').css('display', 'none');    
});

$('#li-reportes').click(function(event){
    $('#submenu-reportes').css('display', 'block');
    $('#submenu-tiempos').css('display', 'none');
    $('#submenu-checklist').css('display', 'none');
    $('#submenu-servicios').css('display', 'none');
    $('#submenu-unidades').css('display', 'none');
    $('#submenu-os').css('display', 'none');
    $('#contenido').css('display', 'none');    
});


});


function registroOK(url){
    swal({
        title: "Registro Exitoso",
        text: "Redireccionando en 2 segundos .....",
        type: "success",
        timer: 2000
    }).then(() => {
        window.location.href = url;
    });
}

function finalizarServicioOK(url){
    swal({
        title: "Se finalizo el servicio exitosamente",
        text: "Redireccionando en 5 segundos .....",
        type: "success",
        timer: 5000
    }).then(() => {
        window.location.href = url;
    });
}

function actualizarOK(url){
    swal({
        title: "Actualizacion Correcta",
        text: "Redireccionando en 2 segundos .....",
        type: "success",
        timer: 2000
        }).then(() =>{
            window.location.href = url;
    });
}

function errorRegistro(error, link){
    swal({
        title: "Error en el registro",
        text: error,
        type: "warning"
    }).then(() => {
        window.location.href = link;
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
    });
}

function iniciarFinalizarServiciok(link){
    swal({
        title: "¡Se inicio y finalizo el servicio Exitosamente!",
        text: "Redireccionando en 2 segundos . . .  ",
        type: "success",
        timer: 2000
        }).then(() => {
            window.location.href = link;
        });
}

function finalizarOSOK(link){
    swal({
        title: "¡Se inicio y finalizo el servicio Exitosamente!",
        text: "Redireccionando en 2 segundos . . .  ",
        type: "success",
        timer: 2000
        }).then(() => {
            window.location.href = link;
        });
}

