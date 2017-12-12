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
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript">
         
         google.charts.load('current', {'packages':['corechart']});
         
         google.charts.setOnLoadCallback(drawChart);
         google.charts.setOnLoadCallback(drawChart2);
         function drawChart() {
           var jsonData = $.ajax({
               url: "getData1.php",
               dataType: "json",
               async: false
               }).responseText;
           
           var data = new google.visualization.DataTable(jsonData);
          
           var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
           chart.draw(data, {width: 340, height: 200});
         }
            function drawChart2() {
           var jsonData = $.ajax({
               url: "getData2.php",
               dataType: "json",
               async: false
               }).responseText;
           
           var data = new google.visualization.DataTable(jsonData);
           
           var chart = new google.visualization.PieChart(document.getElementById('chart_div2'));
           chart.draw(data, {width: 340, height: 200});
         }
        </script>
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
                            <li class="active"><a href="estadisticas.php">Estadisticas</a></li>
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
            <div class="generos" style="width: 400px;">
                <h3>Libros por Genero</h3>
                <div id="chart_div"></div>  
            </div>
            <div class="autores" style="width: 400px; float: left">
                <h3>Libros por autor</h3>
                <div id="chart_div2"></div>
            </div>
        </div>
</body>
</html>