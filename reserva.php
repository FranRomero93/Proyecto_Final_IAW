<?php
    session_start();
    include_once ('library/conexion-bd.php');
    if (!isset($_SESSION)) {
     header("Location: index.php");
    }

    if (empty($_GET)) {
        
     header("Location: index.php");
        
    } else {
        $hoy = getdate();
        $fecha = date ($hoy);
        $fechafin = date('Y-m-d', strtotime("$fecha + 10 day"));
        var_dump($fechafin);
        
        $consulta1="INSERT INTO `prestamo`(`id_usuario`, `id_libro`, `fecha_ini`, `fecha_fin`) VALUES (".$_SESSION["id_usuario"].",".$_GET["id_libro"].",'".$hoy["year"]."-".$hoy["mon"]."-".$hoy["mday"]."', '$fechafin')";
        echo "$consulta1";
        $result = $connection->query($consulta1);
        unset($result);
        
        $consulta2="UPDATE `libro` SET `disponibles`=`disponibles`-1 where id_libro=".$_GET["id_libro"]."";
        echo "$consulta2";
        $result = $connection->query($consulta2);
        unset($result);
        
        header("Location: panel-usuario.php");
    }
?>