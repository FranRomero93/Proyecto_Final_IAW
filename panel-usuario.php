<?php
    session_start();
    if (!isset($_SESSION)) {
     header("Location: index.php");
    }
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
            <h1><a href="index.php">Biblioteca Virtual</a><small> Panel de usuario</small></h1>
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
                                } else {
                                    header("Location: index.php");
                                }

                            ?>
                        </ul>
                </div>
            </nav>
        </div>
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">Datos de usuario</div> 
                    <?php
                        $query="SELECT * from usuarios where id_usuario=".$_SESSION["id_usuario"];
                        $result = $connection->query($query);
                    ?>
                    <table class="table">
                    <thead>
                            <tr>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>DNI</th>
                            <th>Mail</th>
                            <th>Teléfono</th>
                            <th>Direccion</th>
                        </thead>
                        <tbody>

                        <?php
                            while($obj = $result->fetch_object()){
                                echo "<tr>";
                                echo "<td><p type='text' >".$obj->nombre."</p></td>";
                                echo "<td><p type='text' >".$obj->apellidos."</p></td>";
                                echo "<td><p type='text' >".$obj->dni."</p></td>";
                                echo "<td><p type='text' >".$obj->email."</p></td>";
                                echo "<td><p type='text' >".$obj->telefono."</p></td>";
                                echo "<td><p type='text' >".$obj->direccion."</p></td>";
                                echo "</tr>";
                            }
                            
                            $result->close();
                            unset($obj);
                            unset($result);
                            unset($query);

                        ?>
                        </tbody>
                    </table>
            </div>
             
            <div class="panel panel-default">
                <div class="panel-heading">Prestamos</div> 
                    <?php
                        $query="SELECT * FROM prestamo p INNER JOIN libro l ON p.id_libro=l.id_libro where id_usuario=".$_SESSION["id_usuario"].";";
                        $result2 = $connection->query($query)
                    ?>
                    <table class="table">
                    <thead>
                            <tr>
                            <th>Libro</th>
                            <th>Fecha Inicial</th>
                            <th>Fecha Final</th>
                        </thead>
                        <tbody>

                        <?php
                            while($obj2 = $result2->fetch_object()){
                                echo "<tr>";
                                echo "<td><p type='text' >".$obj2->titulo."</p></td>";
                                echo "<td><p type='text' >".$obj2->fecha_ini."</p></td>";
                                echo "<td><p type='text' >".$obj2->fecha_fin."</p></td>";
                                echo "</tr>";
                            }
                            
                            $result2->close();
                            unset($obj2);
                            unset($result2);
                            unset($query);

                        ?>
                        </tbody>
                    </table>
            </div>
            <div>
                <form action="cambiointerfaz.php" accept-charset="UTF-8" role="form" method="post">
                        <div class="form-group">
                            <label for="message" class="col-sm-2 control-label">Interfaz</label>
                            <div class="col-sm-10">
                                <select name="color" value="">
                                    <option></option>
                                    <option>amarillo</option>
                                    <option>verde</option>
                                    <option>azul</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <input id="submit" name="submit" type="submit" value="Seleccionar Interfaz" class="btn btn-primary">
                                <a class="btn btn-primary pull-right" href="pdf-usuario.php?toprint=users">Print to PDF</a>
                            </div>
                        </div>
                    </form>
            </div>
        </div>  
</body>
</html>