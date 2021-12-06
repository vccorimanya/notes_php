<?php
  require_once './database_params.php';

  $connection = new mysqli($host, $user, $password, $database);

  if ($connection->connect_errno){
    throw new RuntimeException('Error al conectar a la base de datos' . $connection-> connect_error);
  }
?>