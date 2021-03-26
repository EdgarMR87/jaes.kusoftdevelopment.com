<?php 
    session_start();
    session_unset();
    echo "<script>alert('Adios');
            window.location.href = 'index.php';</script>";
   
   
?>