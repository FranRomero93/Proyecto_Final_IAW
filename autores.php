<?php
      session_start();
?>

<!doctype html>
<html class="no-js" lang="">
 
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca Virtual</title> 

    <!-- CSS Needed for BooStrap -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

    <!-- My own CSS -->
    <link rel="stylesheet" href="css/style.css">

    <?php
        include_once ('library/conexion-bd.php');
    ?>
</head>

<body>
    <?php
        if(isset($_SESSION["user"])){
                                    $consulta="select interfaz from usuarios where
    nombre='".$_SESSION["user"]."'";
                                    $result = $connection->query($consulta);
                                    $obj = $result->fetch_object();
                                    $interfaz=$obj->interfaz;
                                    if($interfaz==1){
                                        $background='aliceblue';
                                    }elseif($interfaz==2)  {
                                        $background='lightgoldenrodyellow';
                                    }else {
                                        $background='lightseagreen';
                                    }
            
                                }else{
                    $background='aliceblue';
        }
    ?>
    <?php
        echo "<div class='container background' style='background-color:$background;'>"
    ?>
        <div id="header" class="header">
            <h1><a href="index.php">Biblioteca Virtual</a></h1>
            <?php
                if (!isset($_SESSION["user"])){
                    echo "<p class='navbar-text pull-right'><a  href='login.php'>Iniciar Sesión</a> | <a     href=registro.php>Registrarte</a></p>";
                } else {
                    $user=$_SESSION["user"];
                    echo "<p class='navbar-text pull-right'>Conectado como <a href='panel-usuario.php' class='navbar-   link'>$user</a> | <a href=logout.php>Cerrar    Sesion</a></p>";
                }
            ?> 
        </div>
        <div id="nav-">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="index.php">BV</a>
                    </div>
                        <ul class="nav navbar-nav">
                            <li><a href="index.php">Novedades </a></li>
                            <li><a href="categorias.php">Categorias</a></li>
                            <li class="active"><a href="autores.php">Autores</a></li>
                            <li><a href="estadisticas.php">Estadisticas</a></li>
                            <?php                              
                                if(isset($_SESSION["user"])){
                                    $consulta="select nivel_usuario from usuarios where nombre='".$_SESSION["user"]."'";
                                    $result = $connection->query($consulta);
                                    $obj = $result->fetch_object();
                                    $nivel=$obj->nivel_usuario;
                                    if ($nivel==1){
                                        echo "<li><a href='administracion.php'>Administración</a></li>";
                                    }
                                    $result->close();
                                    unset($obj);
                                    unset($result);
                                }

                            ?>
                        </ul>
                </div>
            </nav> 
        </div>
        <div class="content">
            <?php
                 if (isset($_GET["autor"])) {                    
                    echo "<a href='autores.php' class='pull-right'><p>Volver a autores</p></a>";
                    echo "<h3>".$_GET['autor']."</h3>";
                    echo "<div class='.col-md-8'>";
                    $consulta="select * from libro l inner join autor a ON l.id_autor=a.id_autor where a.nombre='".$_GET["autor"]."'";
                    $result = $connection->query($consulta);
                
                    while($obj = $result->fetch_object()) {
                        echo "<div class='libros .col-md-8'>";
                        echo "<a href='libro.php?id_libro=$obj->id_libro' style='float: left;'><img class='imagen_libro' src='.$obj->imagen'><img></a>";
                        echo "<a href='libro.php?id_libro=$obj->id_libro'><h4><br>$obj->titulo </a><small><i>$obj->fecha_lanzamiento</i></small></h4>";
                        echo "<p>$obj->descripcion</p>";
                        echo "</div>";
                    }
                    echo "</div>";
                    $result->close();
                    unset($obj);
                    unset($result);
                } else {
                    $consulta="select * from autor";
                    $result = $connection->query($consulta);
                    echo "<ul class='list-unstyled'>";
                    
                    while($obj = $result->fetch_object()) {
                        echo "<a href='autores.php?autor=".$obj->nombre."'><li>".$obj->nombre."  ".$obj->apellidos."</li>";
                    }
                    echo "</ul>";
                    $result->close();
                    unset($obj);
                    unset($result);
                }
            ?>
        </div>
</body>
</html>