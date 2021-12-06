<?php

require_once './connection.php';


  if(isset($_POST['save_task'])){
    session_start();
    $user_id = htmlspecialchars($_SESSION['user_id']);

    $title = mysql_entities_fix_string($connection, $_POST['title']);
    $content = mysql_entities_fix_string($connection, $_POST['content']);
    $created_at = mysql_entities_fix_string($connection, $_POST['created_at']);
    $deadline = mysql_entities_fix_string($connection,$_POST['deadline']);
    $priority = mysql_entities_fix_string($connection,$_POST['priority']);

    $query = "INSERT INTO tasks (title,content,created_at,deadline,user_id,priority)
              VALUES('$title','$content','$created_at','$deadline','$user_id','$priority')";

    $result = $connection->query($query);
    echo "$user_id";
    if(!$result){
      die("Fallo al añadir el pendiente");
    }else {
      header('Location: index.php');
      $_SESSION['message'] = 'Pendiente añadido';
      $_SESSION[''] = 'Succes';
    }
  }

  function mysql_entities_fix_string($connection, $string)
  {
      return htmlentities(mysql_fix_string($connection, $string));
  }

  function mysql_fix_string($connection, $string)
  {
      //if (get_magic_quotes_gpc()) $string = stripslashes($string);
      return $connection->real_escape_string($string);
  }

?>