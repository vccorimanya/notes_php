<?php
  require_once './database.php';

  session_start();

  $connection = mysqli_connect($host, $user, $database, $password);
  if ($connection -> connect_error) die ("Fatal error");

?>