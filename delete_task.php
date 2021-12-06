<?php

require_once './connection.php';

if ( isset($_GET['tasks_id']))
{   
    session_start();
    $user_name=$_SESSION['user_id'];
    $task_id = $_GET['tasks_id'];
    $query = "DELETE FROM tasks WHERE tasks_id='$task_id' and user_id='$user_name'";
    $result = $connection->query($query);
    if (!$result) {
        echo "Fallo";
        }
    else{
        header('Location: index.php');
    }
}




?>