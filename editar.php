<?php
    session_start();

    include_once ('library/conexion-bd.php');

    if (empty($_POST) or !isset($_SESSION)) {
        
     header("Location: index.php");
        
    } else {
        if (isset($_GET["id_usuario"])){
            $query="UPDATE usuarios SET nombre='".$_POST['nombre']."', apellidos='".$_POST['apellidos']."', dni='".$_POST['dni']."', email='".$_POST['email']."', telefono=".$_POST['telefono'].", direccion='".$_POST['direccion']."', nivel_usuario=".$_POST['nivel_usuario']." WHERE id_usuario='".$_GET['id_usuario']."';";
            
            if ($result = $connection->query($query)) {
                header("location:administracion.php");
                
                $result->close();
                unset($result);
                unset($query);
                
            } else {
                echo"QUERY ERRÓNEO";
                var_dump($query);
                var_dump($_POST);
                var_dump($_GET);
            }
        }
        
        if (isset($_GET["id_libro"])){
            $query="UPDATE libro SET titulo='".$_POST['titulo']."', editorial='".$_POST['editorial']."', descripcion='".$_POST['descripcion']."', disponibles=".$_POST['disponibles'].", fecha_lanzamiento='".$_POST['fecha_lanzamiento']."', imagen='".$_POST['imagen']."' WHERE id_libro='".$_GET['id_libro']."';";
            
            if ($result = $connection->query($query)) {
                header("location:administracion.php");
            } else {
                echo"QUERY ERRÓNEO";
                var_dump($query);
                var_dump($_POST);
                var_dump($_GET);
            }
        }
        
        if (isset($_GET["id_autor"])){
            $query="UPDATE autor SET nombre='".$_POST['nombre']."', apellidos='".$_POST['apellidos']."' WHERE id_autor='".$_GET['id_autor']."';";
            
            if ($result = $connection->query($query)) {
                header("location:administracion.php");
            } else {
                echo"QUERY ERRÓNEO";
                var_dump($query);
                var_dump($_POST);
                var_dump($_GET);
            }
        }
        
        if (isset($_GET["id_categoria"])){
            $query="UPDATE categoria SET nombre_categoria='".$_POST['nombre_categoria']."' WHERE id_categoria='".$_GET['id_categoria']."';";
            
            if ($result = $connection->query($query)) {
                header("location:administracion.php");
            } else {
                echo"QUERY ERRÓNEO";
                var_dump($query);
                var_dump($_POST);
                var_dump($_GET);
            }
        }
        if (isset($_GET["id_comentario"])){
            $query="UPDATE comentarios SET contenido='".$_POST['comentario']."' WHERE id_comentario='".$_GET['id_comentario']."';";
            
            if ($result = $connection->query($query)) {
                header("location:administracion.php");
            } else {
                echo"QUERY ERRÓNEO";
                var_dump($query);
                var_dump($_POST);
                var_dump($_GET);
            }
        }
        if (isset($_GET["id_prestamo"])){
            var_dump($_GET["id_prestamo"]);
            $query="UPDATE prestamo SET fecha_fin='".$_POST['fecha_fin']."' WHERE id_prestamo='".$_GET['id_prestamo']."'";
            
            if ($result = $connection->query($query)) {
                header("location:administracion.php");
            } else {
                echo"QUERY ERRÓNEO";
                var_dump($query);
                var_dump($_POST);
                var_dump($_GET);
            }
        }
    }
?>