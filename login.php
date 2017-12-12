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

    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

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
            <h1><a href="index.php">Biblioteca Virtual</a><small> Inicio Sesión</small></h1>
        </div>
        <div id="nav-">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="index.php">BV</a>
                    </div>
                        <ul class="nav navbar-nav">
                        </ul>
                </div>
            </nav>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Introduca los datos</h3>
                        </div>
                        <div class="panel-body">
                            <form accept-charset="UTF-8" role="form" method="post">
                                <fieldset>
                                    <div class="form-group">
                                       <input class="form-control" placeholder="E-mail" name="mail" type="email" required>
                                    </div>
                                    <div class="form-group">
                                      <input class="form-control" placeholder="Password" name="password" type="password" value="" required>
                                    </div>
                                    <p class="pull-left">Si aún no estás registrado, <a href="registro.php">Regístrate</a></p>
                                    <input class="btn btn-lg btn-success btn-block" type="submit" value="login">
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    <?php if (isset($_POST["mail"])) {
                $consulta="select * from usuarios where
          email='".$_POST["mail"]."' and password=md5('".$_POST["password"]."');";
                if ($result = $connection->query($consulta)) {
                    $obj = $result->fetch_object();
                    
                    //No rows returned
                    if ($result->num_rows===0) {
                        echo "LOGIN INVALIDO";
                    } else {
                        //VALID LOGIN. SETTING SESSION VARS
                        $_SESSION["mail"]=$_POST["mail"];
                        $_SESSION["user"]=$obj->nombre;
                        $_SESSION["id_usuario"]=$obj->id_usuario;
                        header("Location: index.php");
                    } 

                }else {
                    echo "Wrong Query";
                    var_dump($consulta);
                }
            }
        ?>
    <?php 
        echo "</div>";
    ?>
</body>
</html>