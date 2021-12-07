<?php

include_once './head.php';
include_once './connection.php';

$title='';
$content='';
$create_at='';
$deadline='';
$priority='';

if (isset($_GET['tasks_id'])){
  $tasks_id = $_GET['tasks_id'];

  $query = "SELECT title, content, DATE_FORMAT(created_at,'%Y-%m-%d'), DATE_FORMAT(deadline,'%Y-%m-%d'), priority FROM tasks WHERE tasks_id=$tasks_id";
  $result = $connection->query($query);
  if(!$result){
    echo "Fail to get contents";
  }elseif($result->num_rows){
    $row = $result->fetch_array(MYSQLI_NUM);
    $result->close();

    $title = $row[0];
    $content = $row[1];
    $created_at = $row[2];
    $deadline = $row[3];
    $priority = $row[4];
  }
}

if (isset($_POST['update'])){

  $tasks_id = $_GET['tasks_id'];
  $title= $_POST['title'];
  $content = $_POST['content'];
  $created_at = $_POST['created_at'];
  $deadline = $_POST['deadline'];
  $priority = $_POST['priority'];

  $query = "UPDATE tasks SET title = '$title', content = '$content', created_at = '$created_at', deadline = '$deadline', priority = '$priority' WHERE tasks_id=$tasks_id";

  $result = $connection->query($query);

  if (!$result){
    echo "Error";
  }else{
    $_SESSION['message'] = 'Task Updated Successfully';
    $_SESSION['message_type'] = 'warning';
    header('Location: index.php');
  }

}

?>
<div class="container">
  <div class=" row-cols-md-3 g-2 ">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Editar</h5>
        <form class="row g-3" action="" method="POST">
          <div class="form-floating">
            <input class="form-control" id="floatingInputInvalid" type="text"  name="title" value="<?php echo $title; ?>" placeholder="Titulo" required>
            <label for="floatingInputInvalid">Titulo:</label>
          </div>
          <div class="form-floating">
            <textarea class="form-control"  name="content" id="floatingTextarea2" style="height: 100px" required><?php echo $title; ?></textarea>
            <label for="floatingTextarea">Contenido:</label>
          </div>
          <div class="form-floating">
            <input class="form-control" type="text" name="created_at" value="<?php echo $created_at; ?>" required>
            <label>Fecha inicio:</label>
          </div>
          <div class="form-floating">
            <input class="form-control"  type="text" name="deadline" value="<?php echo $deadline; ?>" required>
            <label for="">Fecha fin:</label>
          </div>
          <div class="form-floating">
             <select class="form-select"  name="priority" id="priority" required>
              <option value="urgente" >Urgente</option>
              <option value="medio" >Medio</option>
              <option selected value="<?php echo $priority; ?>" >Bajo</option>
            </select>
            <label  for="priority">Prioridad :</label>
          </div>
          <input class="btn btn-primary" type="submit" value="Actualizar" name="update">
        </form>
      </div>
    </div>
  </div>
</div>
