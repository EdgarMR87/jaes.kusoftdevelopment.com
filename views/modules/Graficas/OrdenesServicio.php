<script>



</script>

<div class="tablas-listado" id="contenido">
    <h1>Graficas OS</h1>
    <form  method="POST">
        <table>
            <input type="date" name="fecha_inicio" id="fecha_inicio" value="<?php echo $_SESSION['fecha_inicio'] ?? '' ?>">
            <input type="date" name="fecha_termino" id="fecha_termino" value="<?php echo $_SESSION['fecha_termino'] ?? '' ?>">
            <input class="btn-agregar" type="submit" value="GRAFICAR" onclick="ventanaNueva()">
            <input class="btn-agregar" type="submit" value="Unidades Totales Taller" onclick="graficasUnidadesTaller()">
            <input class="btn-agregar" type="submit" value="Mayor Tiempo Taller" onclick="mayorTiempoTaller()">
            <input class="btn-agregar" type="submit" value="Menor Tiempo Taller" onclick="menorTiempoTaller()">
            <input class="btn-agregar" type="submit" value="Tiempo Registro-Libreacion" onclick="TiempoRegistroLiberacionTaller()">
        </table>
    </form>
</div>
