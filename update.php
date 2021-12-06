<?php 
include_once './head.php';
include_once './connection.php';
$title='';
$content='';
$create_at='';
$deadline='';
$priority='';

if  (isset($_GET['tasks_id'])) {
    $tasks_id = $_GET['tasks_id'];
    $query = "SELECT title,content,created_at,deadline,priority FROM tasks WHERE tasks_id=$tasks_id";
    $result = $connection->query($query);
    if (!$result) {
       echo "ddd";
    }elseif($result->num_rows){
        $row = $result->fetch_array(MYSQLI_NUM);
        $result->close();

        
        $title = $row[0];
        $content = $row[1];
        $created_at = $row[2];
        $deadline = $row[3];
        $priority = $row[4];
        echo "$title $content";
    }
  }

  if (isset($_POST['update'])) {
    $tasks_id = $_GET['tasks_id'];
    $title= $_POST['title'];
    $content = $_POST['content'];
    $created_at = $_POST['created_at'];
    $deadline = $_POST['deadline'];
    $priority = $_POST['priority'];
  
    $query = "UPDATE tasks SET title = '$title', content = '$content', created_at = '$created_at', deadline = '$deadline', priority = '$priority' WHERE tasks_id=$tasks_id";
    mysqli_query($connection, $query);
    $_SESSION['message'] = 'Task Updated Successfully';
    $_SESSION['message_type'] = 'warning';
    header('Location: index.php');
  }


?>


 <div class="container">
    <div class="row">
      <div class="col-3 ">
        <form action="" method="POST">
          <label for="" class="form-label">Titulo: <input type="text" class="form-control" name="title" value="<?php echo $title; ?>" required></label>
          <textarea class="form-control" name="content" id="" cols="30" rows="10" placeholder="Contenido" required> <?php echo $title; ?></textarea>
          <label >Fecha inicio: <input class="form-control" type="text" name="created_at" value="<?php echo $created_at; ?>" required></label>
          <label for="">Fecha fin : <input class="form-control" type="text" name="deadline" value="<?php echo $deadline; ?>" required></label>
          <label class="form-label" for="priority">Prioridad :
            <select class="form-select" name="priority" id="priority" required>
              <option value="urgente" >Urgente</option>
              <option value="medio" >Medio</option>
              <option selected value="<?php echo $priority; ?>" >Bajo</option>
            </select>
          </label><br>
          <input class="btn btn-success" type="submit" value="Actualizar" name="update">
        </form>
      </div>
    </div>
  </div>
