<?php

require_once './connection.php';
require_once './add_task.php';
include './head.php';

session_start();

$user_id = htmlspecialchars($_SESSION['user_id']);
$now = date('Y-m-d');
$deadline_status = '';
$alert_color = '';
$badge_color = '';
$where= "where user_id = '$user_id' and state = 1 order by deadline ASC ";

if (isset($_POST['filter_tasks'])){
  $option=$_POST['filter'];
  switch ($option) {
    case 'vencidas':
      $where = "where user_id = '$user_id' and deadline < '$now' ";
      $deadline_status = 'none';
      $alert_color = 'alert-danger';
      break;
    case 'archivadas':
      $where = "where user_id = '$user_id' and state = 0 ";
    break;
    default:
      $where = "where user_id = '$user_id' and state = 1 order by deadline ASC ";
      break;
  }
}

$query = "SELECT tasks_id, title,content, DATE_FORMAT(created_at,'%Y-%m-%d'), DATE_FORMAT(deadline,'%Y-%m-%d'), user_id, priority, state FROM tasks $where";
$result_tasks = $connection->query($query);

?>

<body>
  <nav class="navbar navbar-expand-lg mb-4 navbar-light bg-light">
    <div class="container-fluid">
       <?php

      if (isset($_SESSION['user_name']))
      {
          $user_name = htmlspecialchars($_SESSION['user_name']);
          echo "<h3 class='navbar-brand'> Bienvenido otra vez $user_name</h3>
                <a class='btn btn-outline-success' href=logout.php>Cerrar sesion</a>";
      } else {

        header('Location: signin.php');
      }
      ?>

    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-3 ">
        <form action="" method="POST">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="title" placeholder="Titulo" required>
            <label>Titulo:</label>
          </div>
          <div class="form-floating mb-3">
            <textarea class="form-control style="height: 100px" name="content" id="floatingTextarea2" style="height: 100px" placeholder="Contenido" required></textarea>
            <label>Contenido:</label>
          </div>
          <div class="form-floating mb-3">
            <input class="form-control" type="text" name="created_at"  value="<?php echo $now ?>" required>
            <label >Fecha inicio:</label>
          </div>
          <div class="form-floating mb-3">
            <input class="form-control" type="text" name="deadline" placeholder="<?php echo $now ?>" required>
            <label for="">Fecha fin:</label>
          </div>
          <div class="form-floating mb-3">
            <select class="form-select" name="priority" id="priority" required>
              <option value="urgente" >Urgente</option>
              <option value="medio" >Medio</option>
              <option selected value="bajo" >Bajo</option>
            </select>
            <label class="form-label" for="priority">Prioridad :</label>
          </div>
          <input class="btn btn-success" type="submit" value="Añadir" name="save_task">
        </form>
      </div>
      <div class="col">
         <form class="row-cols-md-4  d-flex align-items-center" action="" method="POST">
            <div class="form-floating ">
              <select class="form-select" name="filter" id="">
                <option value="todos">Todos</option>
                <option value="pendientes">Pendientes</option>
                <option value="vencidas">Vencidas</option>
                <option value="archivadas">Archivadas</option>
              </select>
              <label for="">Filtrar por: </label>
            </div>
            <div class="w-auto">
              <input class="btn btn-dark w-auto ms-3" type="submit" value="Filtrar" name="filter_tasks">
            </div>
        </form>

        <table class="table table-hover">
          <thead class="">
            <tr>
              <th>Titulo</th>
              <th>Contenido</th>
              <th>Fecha inicio</th>
              <th>Fecha fin</th>
              <th>Prioridad</th>
              <th>Accciones</th>
            </tr>
          </thead >
          <tbody>
            <?php
                while($row = $result_tasks->fetch_array(MYSQLI_NUM)){

                  if ($row[6]=='urgente'){
                    $badge_color = 'bg-danger';
                  }elseif($row[6]=='medio'){
                    $badge_color= 'bg-warning text-dark';
                  }else{
                    $badge_color = 'bg-info text-dark';
                  }

                  ?>

                  <tr class="alert <?php echo $alert_color?>" >
                    <td><?php echo $row[1]?></td>
                    <td><?php echo $row[2]?></td>
                    <td><?php echo $row[3]?></td>
                    <td><?php echo $row[4]?></td>
                    <td><span class="badge <?php echo $badge_color?>"><?php echo $row[6]?></span></td>
                    <td>
                      <a style="pointer-events: <?php echo $deadline_status?>" href="update.php?tasks_id=<?php echo $row[0]?>" class="btn btn-primary" >
                        <i class="fas fa-marker"></i>
                      </a>
                       <a href="delete_task.php?tasks_id=<?php echo $row[0]?>" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i>
                      </a>
                      <a href="archive.php?tasks_id=<?php echo $row[0]?>" class="btn btn-secondary">
                        <i class="fas fa-archive"></i>
                      </a>
                    </td>
                  </tr>

            <?php  } ?>

          </tbody>
        </table>
      </div>
    </div>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/d98197d415.js" crossorigin="anonymous"></script>
</body>
</html>