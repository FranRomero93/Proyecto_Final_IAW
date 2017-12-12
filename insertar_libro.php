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
    
    <?php
        include_once ('library/conexion-bd.php');
        include_once ('library/replace_caracteres.php');
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
            <h1><a href="index.php">Biblioteca Virtual</a><small> Añadir Libro</small></h1>
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
			    		   <h3 class="panel-title">Datos del nuevo libro</h3>
                        </div>
			 			<div class="panel-body">
                            <form action="insertar_libro.php" method="post" enctype="multipart/form-data">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			                             <input type="text" name="titulo" class="form-control input-sm" placeholder="Titulo" required>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="editorial" class="form-control input-sm" placeholder="Editorial" required>
			    					</div>
			    				</div>
			    			</div>

                            <div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
                                        <input type="text" list="autores" name="nom_autor"  class="form-control input-sm" placeholder="Nombre Autor" required>
                                        <?php
                                            $consulta="Select nombre from autor";
                                            echo "<datalist id='autores'>";
                                            var_dump($consulta);
                                            if ($result = $connection->query($consulta)) {
                                                while($obj = $result->fetch_object()) {
                                                    echo "<option value='".$obj->nombre."'>";
                                                    if (isset($_POST["titulo"])){
                                                        if ($_POST["nom_autor"]==$obj->nombre){
                                                            $nom_check=1;
                                                        }
                                                    }
                                                }
                                                echo"</datalist>";
                                            }
                                            $result->close();
                                            unset($obj);
                                            unset($result);
                                            unset($consulta);
                                        ?>
                                    </div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
                                        <input type="text" list="ape_autores" name="ape_autor"  class="form-control input-sm" placeholder="Apellido Autor" required>
                                        <?php
                                            $consulta="Select apellidos from autor";
                                            echo "<datalist id='ape_autores'>";
                                            var_dump($consulta);
                                            if ($result = $connection->query($consulta)) {
                                                while($obj = $result->fetch_object()) {
                                                    echo "<option value='".$obj->apellidos."'>";
                                                    if (isset($_POST["titulo"])){
                                                        if ($_POST["ape_autor"]==$obj->apellidos){
                                                            $ape_check=1;
                                                        }
                                                    }
                                                }
                                                echo"</datalist>";
                                            }
                                            $result->close();
                                            unset($obj);
                                            unset($result);
                                            unset($consulta);
                                        ?>
                                    </div>
			    				</div>
			    			</div>
                            
			    			<div class="form-group">
			    				<input type="text" list="categorias" name="categoria"  class="form-control input-sm" placeholder="Categoria" required>
                            <?php
                                $consulta="Select nombre_categoria from categoria";
                                echo "<datalist id='categorias'>";
                                var_dump($consulta);
                                if ($result = $connection->query($consulta)) {
                                    while($obj = $result->fetch_object()) {
                                        echo "<option value='".$obj->nombre_categoria."'>";
                                        if (isset($_POST["titulo"])){
                                            if ($_POST["categoria"]==$obj->nombre_categoria){
                                                $cate_check=1;
                                            }
                                        }
                                    }
                                    echo"</datalist>";
                                }
                                $result->close();
                                unset($obj);
                                unset($result);
                                unset($consulta);
                            ?>
			    			</div>

			    			<div class="form-group">
			    				<input type="number" name="disponibles"  class="form-control input-sm" placeholder="Disponibles" required>
			    			</div>
                                
                            <div class="form-group">
			    				<input type="text" name="descripcion"  class="form-control input-sm" placeholder="Descripcion" required>
                            </div>  
                                
                            <div class="form-group">
			    				<input type="date" name="fecha_lanzamiento"  class="form-control input-sm" placeholder="Fecha lanzamiento" required>
                            </div>  
                                
                            <div class="form-group">
			    				<p>Selecciona una imagen para subir:</p>
                                <input type="file" name="imagen" id="fileToUpload" required>
                            </div>
        
			    			<input type="submit" value="Añadir" class="btn btn-info btn-block">
                       </form>
    
    <?php
         if (isset($_POST["titulo"])) {
            if (!isset($cate_check)){
                $cate_check=0;
            }
            if (!isset($nom_check)){
                $nom_check=0;
            }
            if (!isset($ape_check)){
                $ape_check=0;
            }
             
            $titulo=$_POST["titulo"];
            $editorial=$_POST["editorial"];
            $nom_autor2=$_POST["nom_autor"];
            $ape_autor2=$_POST["ape_autor"];
            $categoria=$_POST["categoria"];
            $disponibles=$_POST["disponibles"];
            $descripcion1=$_POST["descripcion"];
            $descripcion=function limpiar_caracteres_especiales($descripción1);
            $fecha_lanzamiento=$_POST["fecha_lanzamiento"];

            
            $target_dir = "img/";
            $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            // Comprobar imagen
            $check = getimagesize($_FILES["imagen"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
            // Comprobar si ya existe la imagen
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Comprobar size
            if ($_FILES["imagen"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Permitir determinados formatos de imagen.
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Comprobar la varible $uploadOk esta en 0 a causa de un error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // Si todo está bien se sube el archivo.
            } else {
                if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
                    echo "The file ". basename( $_FILES["imagen"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } 
             
            if($nom_check!=1 and $ape_check!=1){
                $consulta="insert into `autor` (`id_autor`, `nombre`, `apellidos`) values ('', '".$_POST["nom_autor"]."', '".$ape_autor2=$_POST["ape_autor"]."');";
                $result = $connection->query($consulta);
                unset($obj);
                unset($result);
                unset($consulta);
            }
             
            $consulta="select id_autor from autor where nombre='".$_POST["nom_autor"]."';";
            if ($result = $connection->query($consulta)) {
                while($obj = $result->fetch_object()) {
                    $id_autor=$obj->id_autor;
                }
            }
            unset($obj);
            unset($result);
            unset($consulta);
             
            if($cate_check!=1){
                $consulta="insert into `categoria` (`id_categoria`, `nombre_categoria`) values (null, '".$_POST["categoria"]."');";
                $result = $connection->query($consulta);
                unset($obj);
                unset($result);
                unset($consulta);
            } 
            
            $consulta="select id_categoria from categoria where nombre_categoria='".$_POST["categoria"]."';";
            if ($result = $connection->query($consulta)) {
                while($obj = $result->fetch_object()) {
                    $id_categoria=$obj->id_categoria;
                }
            }
            unset($obj);
            unset($result);
            unset($consulta);
             
             
            $consulta="insert into `libro` (`id_libro`, `id_autor`, `id_categoria`, `titulo`, `editorial`, `descripcion`, `disponibles`, `fecha_lanzamiento`, `imagen`) values (null, '$id_autor', '$id_categoria', '$titulo', '$editorial', '$descripcion', '$disponibles', '$fecha_lanzamiento', '/img/".$_FILES["imagen"]["name"]."');";
            $result = $connection->query($consulta);
            unset($obj);
            unset($result);
            unset($consulta);
            
        }
    ?>

			    	</div>
	    		</div>
    		  </div>
    	   </div>
        </div>
</body>
</html>