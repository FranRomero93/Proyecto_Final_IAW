<?php
    session_start();
    include_once ('library/conexion-bd.php');
    include_once("library_to_pdf/fpdf.php");
    if ($_GET["toprint"] == 'users' ) {
        $query="SELECT * from usuarios where id_usuario=".$_SESSION["id_usuario"];
        $result = $connection->query($query);
        $obj = $result->fetch_object();
        $query="SELECT * FROM prestamo p INNER JOIN libro l ON p.id_libro=l.id_libro where id_usuario=".$_SESSION["id_usuario"].";";
        class PDF extends FPDF
          {
            function Footer ()
            {
              $this->SetY(-10);
              $this->SetFont('Arial','I',10);
              $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
            }
          }
          $pdf=new FPDF('L','mm','A4');
          $pdf->AddPage();
          $pdf->SetFont('Arial','',10);
          $pdf->Cell(46,5,"Nombre");
          $pdf->Cell(46,5,"Apellidos");
          $pdf->Cell(46,5,"DNI");
          $pdf->Cell(46,5,"Telefono");
          $pdf->Cell(46,5,"Direccion");
          $pdf->ln();                               
          $pdf->Cell(46,5,$obj->nombre,1,0,'C');
          $pdf->Cell(46,5,$obj->apellidos,1,0,'C');
          $pdf->Cell(46,5,$obj->dni,1,0,'C');
          $pdf->Cell(46,5,$obj->telefono,1,0,'C');
          $pdf->Cell(46,5,$obj->direccion,1,0,'C');
          $pdf->ln();
          $pdf->ln();       
          $pdf->Cell(46,5,"Libro");
          $pdf->Cell(46,5,"Fecha inicial");
          $pdf->Cell(46,5,"Fecha final");
          $pdf->ln();  
          $result2 = $connection->query($query);
            while ($obj2 = $result2 -> fetch_object()) {
              $pdf->Cell(46,5,$obj2->titulo,1,0,'C');
              $pdf->Cell(46,5,$obj2->fecha_ini,1,0,'C');
              $pdf->Cell(46,5,$obj2->fecha_fin,1,0,'C');
              $pdf->ln();
            }
        $pdf->output();
    }    

 ?>