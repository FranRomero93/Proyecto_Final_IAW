<?php
    session_start();
    include_once ('library/conexion-bd.php');

    if (empty($_GET) and isset($_SESSION) and empty($_POST)) {
        
     header("Location: index.php");
        
    } else {
        if (isset($_GET["id_libro"])){
            $query="insert into `comentarios` (`id_libro`, `id_usuario`, `contenido`) values ('".$_GET['id_libro']."', '".$_SESSION["id_usuario"]."', '".$_POST["comentario"]."');";
            
            if ($result = $connection->query($query)) {
                header("location:libro.php?id_libro=".$_GET["id_libro"]);
            } else {
                echo"QUERY ERRÓNEO";
                var_dump($query);
            }
        }
    }
?>