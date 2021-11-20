<?php

require_once './connection.php';

if(isset($_POST['save_task'])){
  $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
  $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
  $added_date = filter_var($_POST['added_date'], FILTER_SANITIZE_STRING);
  $deadline = filter_var($_POST['deadline'], FILTER_SANITIZE_STRING);
  $priority = $_POST(['priority']);

  $query = "INSERT INTO pendents (title,content,added_date,deadline,priority)";

  $result = mysqli_query($connection, $query);
  if(!$result){
    die("Fallo al añadir el pendiente");
  }else {
    $_SESSION['message'] = 'Pendiente añadido';
    $_SESSION[''] = 'Succes';
  }
}

?>