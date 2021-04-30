<script>
$(document).ready(function(){
    $('#adjuntos').change(function(){
        var fileLength = this.files.length;
        var match= ["image/jpeg","image/png","image/jpg","image/gif"];
        var i;
        for(i = 0; i < fileLength; i++){ 
            var file = this.files[i];
            var imagefile = file.type;
            if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]) || (imagefile==match[3]))){
                alert('Por favor selecciona una tipo de imagen valida (JPEG/JPG/PNG/GIF).');
                $("#adjuntos").val('');
                return false;
            }
        }
    });
});
</script>

<div class="tablas-listado" id="contenido">
    <h1>REGISTRO PENDIENTE</h1>
    <form method="post" class="form-alta-serv" enctype="multipart/form-data">
        <table class="tabla-alta-serv">
            <tr>
                <td class="titulo"><p class="derecha">Fecha : </p></td>
                <td class=input>
                <?php
                    date_default_timezone_set('America/Mexico_City');
                 ?>
                    <input type="datetime-local" value="<?php echo date('Y-m-d\TH:i');?>" name="fecha_pendiente">
                </td>
                <td class="titulo"><p class="derecha">Unidad : </p></td>
                <td class="input">
                <select name="unidad_pendiente">
                    <?php
                    $vistaUnidades = New MvcController();
                    $vistaUnidades->vistaUnidadesSelectController();
                    ?>
                </select>
                </td>
            </tr>
            <tr>
                <td class="titulo"><p class="derecha">Información del pendiente : </p></td>
                <td class="input">
                    <textarea name="detalle_informacion" cols="100" rows="10"></textarea>
                </td>
                <td class="titulo"><p class="derecha">Adjuntar Información : </p></td>
                <td class="titulo">
                    <input type="file" name="adjuntos[]" id="adjuntos" multiple>
                    <table id="lista_adjuntos">
                        <tbody></tbody>
                    </table>
                </td>
            </tr>
        </table>
        <input class="btn-registrar" type="submit" value="REGISTRAR">
    </form>
</div>