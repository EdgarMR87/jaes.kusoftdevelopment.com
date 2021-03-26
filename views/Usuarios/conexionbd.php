<?php
$con = new mysqli("65.99.225.36", "kusoftde_edgar_edmin", "mZz{mQ,GU0kr", "kusoftde_jaes_pruebas");
if ($con->connect_errno)
{
    echo "Fallo al contenctar a MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
    exit();
}
else
@mysqli_query($con, "SET NAMES 'utf8'");
?>
