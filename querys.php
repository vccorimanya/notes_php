<?php

  require_once './connection.php';

  if(isset($_POST['save_user'])){
    $user_name = filter_var($_POST['user_name'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    $query = "INSERT INTO users(user_name, password)
              VALUES ('$user_name',SHA2('$password',512))";

    $result = mysqli_query($connection, $query);
    if(!$result){
      die("Fallo al registrar usuario");
    }else {
      $_SESSION['message'] = 'Te registraste exitosamente';
      $_SESSION[''] = 'Succes';
    }
  }
?>