<?php

    $connection = new mysqli("localhost", "user", "2asirtriana", "biblioteca");

    if ($connection->connect_errno) {
      printf("Connection failed: %s\n", $connection->connect_error);
      exit();
    }
?>