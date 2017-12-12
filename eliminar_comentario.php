<?php
    session_start();
    include_once ('library/conexion-bd.php');

    if (empty($_GET) and isset($_SESSION)) {
        
     header("Location: index.php");
        
    } else {
        if (isset($_GET["id_comentario"])){
            $query="delete from comentarios where id_comentario=".$_GET["id_comentario"].";";
            
            if ($result = $connection->query($query)) {
                header("location:libro.php?id_libro=".$_GET["id_libro"]);
            } else {
                echo"QUERY ERRÓNEO";
                var_dump($query);
            }
        }
    }
?>