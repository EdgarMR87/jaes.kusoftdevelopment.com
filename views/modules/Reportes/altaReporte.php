<script>

$(document).on('change','#archivo_imagen',function(e){
    var input =document.getElementById('archivo_imagen');
    var cantidad =input.files.length;
//con esto valido que no tenga una extension aparte de jpg y png
    for (var i = 0; i < cantidad; i++) {
		var nombre = input.files[i].name;
		var ext = nombre.substring(nombre.lastIndexOf("."));
		if (ext != ".png" && ext != ".jpg"){
			var valida = false;
			break;
		}else{
			var valida = true;
		}
	}
    //aqui se checa que todos tengan una extension valida
    if (valida) {
    //limpio el area del form
        //genero el campo del nombre y los separo por un id con el numero de imagen
		for (var i = 0; i < cantidad; i++) {
		           //con esta funcion deberia encargarse de la pre vista
			previsualizarImg(e, i);		  
		}
	} else {
        //en caso de que no sean validos las extensiones manda alert y limpio el file
        alert('este archivo no es valido o no se ha seleccionado archvio');
		$('#archivo_imagen').val('');
		}
  });

//esta es la funcion previsualizacion
function previsualizarImg(e,i)
{
      var file = e.target.files[i];
    
      var reader = new FileReader();

      reader.onload = function(e){
		    var result = e.target.result;
        $('#adjuntos').append(`<img src="${result}" width="100" height="100">`); //Asignamos el src dinámicamente a un img dinámico también
      }
      reader.readAsDataURL(file);     
}

$(document).ready(function(){
    $('#id_unidad_servicio').change(function(){
		var id_unidad_servicio = $(this).find("option:selected").val();
		$.ajax({
            type: 'POST',
            url: '/views/modules/Reportes/obtenerOrdenesServicio',
            data: {'id_unidad_servicio' : id_unidad_servicio},
            dataType: "html",
            success: function(resp){
                $('#num_orden').html(resp);
            }
        });
	});

    
        
});

</script>
<div class="tablas-listado" id="contenido">
    <h1>REGISTRO REPORTE</h1>
    <form method="post" class="form-alta-serv"  enctype="multipart/form-data">
        <table class="tabla-alta-serv">
            <tr>
                <td class="titulo"><p class="derecha">Unidad : </p></td>
                <td class=input>
                    <select name="id_unidad_servicio" id="id_unidad_servicio">
                    <?php 
                        $vistaUsuario = new MvcController();
                        $vistaUsuario -> vistaUnidadesSelectController();
                    ?>
                    </select>
                </td>
                <td class="titulo"><p class="derecha">Orden de Servicio : </p></td>
                <td class=input>
                    <select name="num_orden" id="num_orden"></select>
                </td>
            </tr>
            <tr>
                <td class="titulo">
                    <p class="derecha">Fecha Solicitud : </p>
                </td>
                <td class=input>
                   <input type="datetime-local" value="<?php echo date('Y-m-d\TH:i');?>" name="fecha_solicitud" readonly>
                </td>
                <td class="titulo">
                    <p class="derecha">Fecha Entrega : </p>
                </td>
                <td class=input>
                   <input type="datetime-local" value="<?php echo date('Y-m-d\TH:i');?>" name="fecha_entrega">
                </td>
            </tr>
            <tr>
                <td class="titulo">
                    <p class="derecha mayusculas">Falla Reportada : </p>
                </td>
                <td class=input>
                   <input type="text" name="falla_reportada">
                </td>
                <td class="titulo">
                    <p class="derecha">Operación : </p>
                </td>
                <td class=input>
                   <input class="mayusculas" type="text" name="operacion">
                </td>
            </tr>
            <tr>
                <td class="titulo">
                    <p class="derecha">Reporte : </p>
                </td>
                <td class=input colspan="3">
                   <textarea class="mayusculas" type="text" name="reporte" rows="7"></textarea>
                </td>
            </tr>
            <tr>
                <td class="titulo">
                    <p class="derecha">Adjuntos : </p>
                </td>
                <td class=input>
                   <input type="file" name="archivo_imagen[]"  id="archivo_imagen" accept="image/*" multiple="">
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div id="adjuntos">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="titulo">
                    <p class="derecha mayusculas">Material/Piezas Solicitadas : </p>
                </td>
                <td class=input>
                   <input type="text" name="material_solicitado">
                </td>
                <td class="titulo">
                    <p class="derecha">Observaciones : </p>
                </td>
                <td class=input>
                   <input class="mayusculas" type="text" name="observaciones">
                </td>
            </tr>
        </table>
        <input class="btn-registrar" type="submit" value="REGISTRAR REPORTE">
    </form>
</div>


<?php

/*ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);*/
$registro = new MvcController();
$registro -> registroReporteOSAtrController();
?>