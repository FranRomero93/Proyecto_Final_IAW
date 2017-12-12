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

    <!-- JS -->
    <script src="../Prueba/js/jquery-3.1.1.js"></script>
    <!-- <script src="../Prueba/js/check.js"></script>
    <script>
    </script>
    -->
    
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
            <h1><a href="index.php">Biblioteca Virtual</a><small> Registro</small></h1>
        </div>
        <div id="nav-">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="index.php">BV</a>
                    </div>
                </div>
            </nav>
        </div>
        <div class="container">
            <div class="row centered-form">
                <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	       <div class="panel panel-default">
                        <div class="panel-heading">
			    		   <h3 class="panel-title">Regístrese <small>It's free!</small></h3>
                        </div>
			 			<div class="panel-body">
			    		<form role="form" action="registro.php" method="post">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			                <input type="text" name="user" class="form-control input-sm" placeholder="Nombre" required>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="apellidos" class="form-control input-sm" placeholder="Apellidos" required>
			    					</div>
			    				</div>
			    			</div>

			    			<div class="form-group">
			    				<input type="email" name="mail"  class="form-control input-sm" placeholder="Email" required>
			    			</div>

                            <div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="dni" class="form-control input-sm" placeholder="DNI" required>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="tel" name="telefono" class="form-control input-sm" placeholder="Teléfono" required>
			    					</div>
			    				</div>
			    			</div>
                            
                            <div class="form-group">
			    				<input type="text" name="direccion" class="form-control input-sm" placeholder="Dirección" required>
			    			</div>
                            
                            <div class="form-group">
                                <input type="password" name="password"  class="form-control input-sm" placeholder="Password" required>
                            </div>
			    			<p class="pull-left">Si ya estás registrado, <a href="login.php">Inicia Sesión</a></p>
			    			<input type="submit" value="Registro" class="btn btn-info btn-block">
			    		</form>
    
    <?php 
        if (isset($_POST["user"])) {
                    
            $user=$_POST["user"];
            $apellidos=$_POST["apellidos"];
            $dni=$_POST["dni"];
            $mail=$_POST["mail"];
            $telefono=$_POST["telefono"];
            $direccion=$_POST["direccion"];
            $password=$_POST["password"];

            $consulta="insert into usuarios (nombre, apellidos, dni, email, telefono, direccion, password) values ('$user', '$apellidos', '$dni', '$mail', $telefono, '$direccion', md5('$password'));";


            if ($result = $connection->query($consulta)) {
                unset($obj);
                unset($result);
                
                $consulta="Select id_usuario from usuarios where email='$mail'";
                
                if ($result = $connection->query($consulta)) {
                    $obj = $result->fetch_object();
                    $_SESSION["user"]=$_POST["user"];
                    $_SESSION["id_usuario"]=$obj->id_usuario;
                    header("Location: index.php");
                } 

            }else {
                echo "<p>DATOS INVÁLIDOS</p>";
            }
        }
    ?>
			    	</div>
	    		</div>
    		  </div>
    	   </div>
        </div>
</body>
</html>