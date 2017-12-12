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
                            <li><a href="autores.php">Autores</a></li>
                            <li><a href="estadisticas.php">Estadisticas</a></li>
                            <?php                              
                                if(isset($_SESSION["user"])){
                                    $consulta="select nivel_usuario from usuarios where
    nombre='".$_SESSION["user"]."'";
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
                 if (isset($_GET["id_libro"])) {
                    $consulta="select * from libro where id_libro='".$_GET['id_libro']."'";
                    $result = $connection->query($consulta);
                    $obj = $result->fetch_object();
                    
                    $result = $connection->query($consulta);
                    echo "<div class='libro libro_detalles .col-md-8'>";
                    echo "<img class='imagen_libro_detalles' src='.$obj->imagen'><img>";
                    echo "<h4><br>$obj->titulo <small><i>$obj->fecha_lanzamiento</i></small></h4>";
                    echo "<p>$obj->descripcion</p>";
                    echo "<p>Editorial: $obj->editorial</p>";
                    echo "<p>Fecha_lanzamiento: $obj->fecha_lanzamiento</p>";
                    echo "<p>Disponibles: $obj->disponibles</p>";
                    $disponibles=$obj->disponibles;
                    if(isset($_SESSION["user"])){
                        if ($disponibles>0){
                            echo "<a href='reserva.php?id_libro=$obj->id_libro'><button class='pull-right' type='button' class='btn btn-default btn-lg btn-block'
                            >Reservar</button></a>";
                        } else {
                            echo "No hay disponibles";
                        }
                    }
                    echo "</div>";
                    echo "</div>";
                    
                    $result->close();
                    unset($obj);
                    unset($result);
                     
            ?>
            <div id="comentarios" class="col-md-8">
                <h4><b>Comentarios</b></h4><br>
                <?php
                    $consulta="SELECT * from comentarios c inner join libro l on c.id_libro=l.id_libro inner join usuarios u on c.id_usuario=u.id_usuario where l.id_libro=".$_GET['id_libro'].";";
                    $result = $connection->query($consulta);
                     
                    while($obj = $result->fetch_object()){
                        echo "<div class='.col-md-8 comentario'>";
                        echo "<h4>".$obj->nombre."</h4>";
                        echo "<p>".$obj->contenido."</p>";
                        if ($obj->id_usuario==$_SESSION["id_usuario"] or $nivel==1){
                            echo "<p><a href='eliminar_comentario.php?id_comentario=".$obj->id_comentario."&id_libro=".$_GET["id_libro"]."'>Eliminar comentario</a></p>";
                        }
                        echo "</div>";
                    }
                     
                    $result->close();
                    unset($obj);
                    unset($result);
                ?>
                <br>
            </div>
            <div id="dejar_comentario" class="col-md-8">
                
                    <?php
                     if(isset($_SESSION["user"])){
                        echo "<form action='dejar_comentario.php?id_libro=".$_GET['id_libro']."' class='form-horizontal' role='form' method='post'>"
                    ?>
                    <form accept-charset="UTF-8" role="form" method="post">
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                            <label for="message" class="col-sm-2 control-label">Comentario</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="4" name="comentario" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <input id="submit" name="submit" type="submit" value="Dejar comentario" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
            <?php
                    }else {
                        echo "<p><b>Inicie sesión para añadir comentarios y/o reservar</b></p>";
                    }
                } else {
                    header("Location:index.php");
                }
            ?>
            </div>
        </div>
</body>
</html>