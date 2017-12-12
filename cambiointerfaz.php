<?php
    session_start();

    include_once ('library/conexion-bd.php');

    if (empty($_POST) or !isset($_SESSION)) {
        
     header("Location: index.php");
        
    } else {
        $color=$_POST['color'];
        if($color=='amarillo'){
            $query="UPDATE usuarios SET interfaz=2 WHERE id_usuario='".$_SESSION["id_usuario"]."';";
        } elseif($color=='verde') {
            $query="UPDATE usuarios SET interfaz=3 WHERE id_usuario='".$_SESSION["id_usuario"]."';";
        } elseif($color=='azul') {
            $query="UPDATE usuarios SET interfaz=1 WHERE id_usuario='".$_SESSION["id_usuario"]."';";
        } 
        echo $query;
        if ($result = $connection->query($query)) {
            header("location:panel-usuario.php");
        } else {
            echo"No se ha podido realizar la operación. <a href='panel-usuario.php'>Volver<a>";
        }
    }
?>