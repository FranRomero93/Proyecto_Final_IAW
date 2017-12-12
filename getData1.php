<?php

    session_start();
    include_once ('library/conexion-bd.php');

    // Consulta que genera los valores de la grafica
    $query = "select c.nombre_categoria, count(l.id_categoria) as num
              from libro as l, categoria as c
              where l.id_categoria = c.id_categoria
              group by l.id_categoria";
      /*$query="select tipo as valor, count(idUsuario) as num
      from usuarios group by tipo"; */       
    // Inicializamos el array
    $array = array();
    if ($result = $connection->query($query)) {
      // Construimos primero las columnas, estaticas
      $array['cols'] = array();
      $array['cols'][] = array(
        'id' => '',
        'label' => 'categoria',
        'pattern' => '',
        'type' => 'string'
      );
      $array['cols'][] = array(
        'id' => '',
        'label' => 'id_categoria',
        'pattern' => '',
        'type' => 'string'
      );
      // Ahora hacemos las columnas, dinamicas desde la base de datos
      $array['rows'] = array();
      while($obj = $result->fetch_object()) {
        $array['rows'][]['c'] = array(
          array(
            'v' => $obj->nombre_categoria,
            'f' => null
          ),
          array(
            'v' => $obj->num,
            'f' => null
          )
        );
      };
      unset($obj);
      unset($connection);
      // Devolvemos al ajax el json listo para pintar. JSON_NUMERIC_CHECK es necesario para que los strings numericos los deje como esté y no los converta a string con comillas.
      die(json_encode($array,JSON_NUMERIC_CHECK));
    }
?>