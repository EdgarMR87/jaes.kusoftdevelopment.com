<script>

window.document.title = 'ALTA ORDEN-SERVICIO';
    function actualizarFilas(){
        var nFilas = $("#tabla-servicios-pre tr").length;
        var table = document.getElementById("tabla-servicios-pre");
        let valor =1;
        for(i=0; i<= nFilas ; i++){
            $("#tabla-servicios-pre tr:eq("+i+")").find("td:eq(0)").text(i);

        }

    }

//EVENTO DEL BOTON ELIMINAR FILA
$(document).on('click', '.borrar', function (event) {
    event.preventDefault();
    $(this).closest('tr').remove(); //ELIMINAS FILA
    actualizarFilas(); //REORDENAMOS LOS NUMEROS DE CONSECUTIVO
});


$(document).ready(function(){
    $("#agregar-proceso").click(function(){
        var nFilas = $("#tabla-servicios-pre tr").length;
        var htmlTags = '<tr>'+
            '<td>' + nFilas + '<input type="hidden" name="consecutivo[]" value="' + nFilas + '"></td>'+
            '<td>' + $("#codigo_proceso").val() + '<input type="hidden" name="partidas[]" value="'+$("#codigo_proceso").val()+'"> </td>'+
            '<td>' + $("#codigo_proceso option:selected").attr('data-name') + '</td>'+
            '<td>' + $("#observaciones-serv").val() + '<input type="hidden" name="observacionesPartidas[]" value="'+$("#observaciones-serv").val()+'"></td>'+
            '<td><a class="borrar"><img src="/views/img/eliminar.png" class="img-25"></img></a></td>'+
           '</tr>';
        $('#tabla-servicios-pre tbody').append(htmlTags);
        $("#observaciones-serv").val('');
        $("#codigo_atr_serv").focus();
        actualizarFilas(); //REORDENAMOS LOS NUMEROS DE CONSECUTIVO
    });
});

</script>
<div class="tablas-listado" id="contenido">
    <h1>Registro Proyecto Nuevo</h1>  
    <form method="post" id="dos-columnas">
        <table class="tabla-alta">
            <tr>
                <td class="derecha"><p>Cliente : </p></td>
                <td>
	                <select name="cliente_proyecto" id="cliente_proyecto"></select>
                </td>
           
                <td class="derecha"><p>Codigo Proyecto : </p></td>
                <td>
                    <input class="mayusculas" type="text" placeholder="ATRNV-00000" name="codigo_proceso" required>
                </td>
            </tr>
            <tr>
                <td class="derecha"><p>Fecha Creación : </p></td>
                <td>
                    <?php
                        date_default_timezone_set('America/Mexico_City');
                    ?>
                   <input type="datetime-local" value="<?php echo date('Y-m-d\TH:i'); ?>" name="fecha_creacion" id="fecha_creacion" readonly>
                </td>
                <td class="derecha"><p>Fecha Entrega : </p></td>
                <td>
                    <input type="datetime-local" name="fecha_entrega" id="fecha_entrega">
                </td>
            </tr>
            <tr>
                <td class="derecha"><p>Descripción Proyecto : </p></td>
                <td>
                    <textarea class="mayusculas" placeholder="Nombre del proyecto a realizar ..." cols="30" rows="10" name="comentarios_proceso" ></textarea>
                </td>
            </tr>
        </table>

        <table class="tabla-alta-serv" id="listado-procesos">
        <tr>
            <td class="titulo"><p class="derecha">Procesos : </p></td>
            <td>
                <select name="codigo_proceso" id="codigo_proceso">
                    <?php
                        $vistaUsuario = new MvcController();
                        $vistaUsuario -> vistaProcesosSelectController();
                    ?>
                </select>
            </td>
            <td class="titulo"><p class="derecha">Comentarios : </p></td>
            <td>
                <input class="mayusculas" type="text" name="observaciones" id="observaciones-serv">
            </td>
            <td>
                <input class="btn-agregar-serv" type="button" value="+" name="agregar-proceso" id="agregar-proceso">
            </td>
        </tr>
    </table>
    <table class="listado-previo" id="tabla-servicios-pre">
        <thead>
            <th class="listado-th">#</th>
            <th class="listado-th">Codigo Proceso</th>
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
    $registro = new MvcController();
    $registro -> registroProcesoController();
?>
