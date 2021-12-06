<?php

include_once './connection.php';

$state=0;

  if (isset($_GET['tasks_id'])) {
    
    $task_id = $_GET['tasks_id'];

    $query = "UPDATE tasks SET state = '$state' WHERE tasks_id=$task_id";
    $result = $connection->query($query);

    if(!$result){

        echo "Error";
    }else {

        $_SESSION['message'] = 'Task Updated Successfully';
        $_SESSION['message_type'] = 'warning';
        header('Location: index.php');
    }
  }


?>