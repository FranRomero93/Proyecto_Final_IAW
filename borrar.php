<?php
    session_start();
    include_once ('library/conexion-bd.php');
    if (!isset($_SESSION)) {
     header("Location: index.php");
    }

    if (empty($_GET)) {
        
     echo "NOTHING HAS BEEN SENT";
        
    } else {
        $query="DELETE from ".$_GET['tabla']." where ".$_GET['campo']."='".$_GET['id']."'";
        if ($result = $connection->query($query)) { 
            header("Location: administracion.php");
        } else {
            echo"No se ha podido realizar la operación. <a href='administracion.php'>Volver<a>";
        }
    }
?>