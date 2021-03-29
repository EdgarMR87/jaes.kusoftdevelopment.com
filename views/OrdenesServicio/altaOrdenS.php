<script>


function ventanaNueva(documento){	
  var ventana =	window.open(documento,'Alta Servicio','width=800, height=600');
  ventana.onload = function() {
        // Ya se cargó la página y se puede asignar el evento final
        ventana.onunload = function() {
            $("#codigo_atr_serv").html("");
            $.ajax({
            type:'POST',
            url:  '/views/modules/ServiciosAtr/obtenerServiciosAtr',
            data: {}, 
            dataType: "html",     
            success: function(resp){      
                $("#codigo_atr_serv").html(resp);            
            }
        });
	    return false;  
        }
    };
}

    window.document.title = 'ALTA ORDEN-SERVICIO';
    function actualizarFilas(){
        var nFilas = $("#tabla-servicios-pre tr").length;
        var table = document.getElementById("tabla-servicios-pre");
        let valor =1;
        for(i=0; i<= nFilas ; i++){
            $("#tabla-servicios-pre tr:eq("+i+")").find("td:eq(0)").text(i);

        }

    }

//EVENTO DEL BOTON AGREGAR PARTIDA 
$(document).ready(function(){
$("#agregar-serv").click(function(){
    var nFilas = $("#tabla-servicios-pre tr").length;
    var htmlTags = '<tr>'+
        '<td>' + nFilas + '<input type="hidden" name="consecutivo[]" value="' + nFilas + '"></td>'+
        '<td>' + $("#codigo_atr_serv").val() + '<input type="hidden" name="partidas[]" value="'+$("#codigo_atr_serv").val()+'"> </td>'+
        '<td>' + $("#codigo_atr_serv option:selected").attr('data-name') + '</td>'+
        '<td>' + $("#observaciones-serv").val() + '<input type="hidden" name="observacionesPartidas[]" value="'+$("#observaciones-serv").val()+'"></td>'+
        '<td><a class="borrar"><img src="/views/img/eliminar.png" class="img25"></img></a></td>'+
       '</tr>';
   $('#tabla-servicios-pre tbody').append(htmlTags);
   $("#observaciones-serv").val('');
   $("#codigo_atr_serv").focus();
   actualizarFilas(); //REORDENAMOS LOS NUMEROS DE CONSECUTIVO
});

    //POSICIONAR EN COMENTARIOS DESPUES DE SELECCIONAR EL CODIGO
    $("#codigo_atr_serv").change(function(){
        $("#observaciones-serv").focus();
    });

});

//EVENTO DEL BOTON ELIMINAR FILA
$(document).on('click', '.borrar', function (event) {
    event.preventDefault();
    $(this).closest('tr').remove(); //ELIMINAS FILA
    actualizarFilas(); //REORDENAMOS LOS NUMEROS DE CONSECUTIVO
});
</script>

<div class="tablas-listado" id="contenido">
<h1>REGISTRO ORDEN DE SERVICIO</h1>

<form method="post" class="form-alta-serv">
    <table class="tabla-alta-serv">
            <tr>
                <td class="titulo"><p class="derecha">Orden de Servicio : </p></td>
                <td class=input>
                    <input type="number" placeholder="# Orden de Servicio" name="num_orden" required>
                </td>
                <td class="titulo"><p class="derecha">Unidad : </p></td>
                <td class=input>
                    <select name="id_unidad_servicio" id="id_unidad_servicio">
                        <?php 
                        $vistaUsuario = new MvcController();
                        $vistaUsuario -> vistaUnidadesSelectController();
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="titulo"><p class="derecha">Operador : </p></td>
                <td class=input>
                    <input type="text" placeholder="Nombre del Operador" name="operador" required>
                </td>
                <td class="titulo"><p class="derecha">Capturo : </p></td>
                <td class=input>
                    <select name="captura" id="captura" required> 
                        <option value="" selected disabled>Selecciona un capturista...</option>
                        <option value="ERICK">ERICK</option>
                        <option value="ARMAC">ARMAC</option>
                        <option value="JAIR">JAIR</option>
                    </select>
                </td>
            </tr>
            <tr> 
                <td class="titulo"><p class="derecha">Fecha Orden : </p></td>
                <td class=input>
                    <input type="date" placeholder="Fecha de la Orden" name="fecha_orden" required>
                </td>
                <td class="titulo"><p class="derecha">Kilometraje : </p></td>
                <td class=input>
                    <input type="number" placeholder="Kilometraje" name="kilometraje" required>
                </td>
            </tr>
            <tr>
                <td class="titulo"><p class="derecha">Servicio : </p></td>
                <td class=input>
                    <select name="servicio" id="servicio">
                        <option value="" selected disabled>Selecciona el servicio a realizar...</option>
                        <option value="CORRECTIVO">Correctivo</option>
                        <option value="GARANTIA">Garantia</option>
                        <option value="PREVENTIVO">Preventivo</option>
                        <option value="PREVENTIVO-CORRECTIVO">Preventivo-Correctivo</option>
                        <option value="TALACHAS">Talachas</option>
                    </select>
                </td>
                <td class="titulo"><p class="derecha">Tipo de Servicio : </p></td>
                <td class=input>
                    <select name="tipo_servicio" id="tipo_servicio"></select>
                </td>
            </tr>   
    </table>
    <table class="tabla-alta-serv">
        <tr>
            <td class="derecha"><input type="button" value="+" class="btn-modal"  onclick="ventanaNueva('index?action=ServiciosAtr/altaServicioAtr')"></td>
            <td class="titulo"><p class="derecha">Codigo Servicio : </p></td>
            <td>
                <select name="codigo_atr_serv" id="codigo_atr_serv">
                    <?php
                        $vistaUsuario = new MvcController();
                        $vistaUsuario -> vistaServiciosAtrSelectController();
                    ?>
                </select>
               
            </td>
            <td class="titulo"><p class="derecha">Comentarios : </p></td>
            <td>
                <input type="text" name="observaciones" id="observaciones-serv">
            </td>
            <td>
                <input class="btn-agregar-serv" type="button" value="Añadir" name="agregar-serv" id="agregar-serv">
            </td>
        </tr>
    </table>
    <table class="listado-previo" id="tabla-servicios-pre">
        <thead>
            <th class="listado-th">#</th>
            <th class="listado-th">Codigo</th>
            <th class="listado-th">Descripcion</th>
            <th class="listado-th">Observaciones</th>
            <th class="listado-th">Eliminar</th>
        </thead>
        <tbody>
        </tbody>
    </table>
    <input class="btn-registrar" type="submit" value="REGISTRAR">
</form>
</div>
<?php

/*ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);*/

$registro = new MvcController();

$registro -> registroOSAtrController();




?>

