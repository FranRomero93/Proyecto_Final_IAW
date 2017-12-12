<?php

    session_start();
    include_once ('library/conexion-bd.php');

    $query = "select a.nombre, count(l.id_autor) as num
              from libro as l, autor as a
              where l.id_autor = a.id_autor
              group by l.id_autor";

    $array = array();
    if ($result = $connection->query($query)) {
      $array['cols'] = array();
      $array['cols'][] = array(
        'id' => '',
        'label' => 'nombre',
        'pattern' => '',
        'type' => 'string'
      );
      $array['cols'][] = array(
        'id' => '',
        'label' => 'id_autor',
        'pattern' => '',
        'type' => 'string'
      );
      $array['rows'] = array();
      while($obj = $result->fetch_object()) {
        $array['rows'][]['c'] = array(
          array(
            'v' => $obj->nombre,
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
      
      die(json_encode($array,JSON_NUMERIC_CHECK));
    }
?>