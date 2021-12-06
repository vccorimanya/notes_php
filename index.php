<?php 

date_default_timezone_set("America/Lima");
require_once './connection.php';
require_once './add_task.php' ;

 include './head.php';


 session_start();
 $user_id = $_SESSION['user_id'];

 $where="WHERE user_id = '$user_id' and state= 1 ORDER BY deadline ASC ";
 $now = date("Y-m-d");



 if (isset($_POST['filter_tasks']))
{
  $fl = $_POST['filter'];
	if ($fl == 'vencidas')
	{
		$where="WHERE user_id = $user_id AND deadline < '$now'";
	}
	else if ($fl == 'archivadas')
	{
		$where="WHERE user_id = $user_id AND state= 0";
	}	
  else if ($fl == 'pendientes')
	{
		$where="WHERE user_id = $user_id AND state= 1";
	}
	else
	{
		$where="WHERE user_id = '$user_id' ORDER BY deadline ASC";
	}
}


$query = "SELECT * FROM tasks $where";
               
 
$result_tasks = $connection->query($query);
if(mysqli_num_rows($result_tasks)==0){
    $mensaje="<h1>No hay registros </h1>";
  }

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
          <label for="" class="form-label">Titulo: <input type="text" class="form-control" name="title" required></label>
          <textarea class="form-control" name="content" id="" cols="30" rows="10" placeholder="Contenido" required></textarea>
          <label >Fecha inicio: <input class="form-control" type="text" name="created_at" required></label>
          <label for="">Fecha fin : <input class="form-control" type="text" name="deadline" required></label>
          <label class="form-label" for="priority">Prioridad :
            <select class="form-select" name="priority" id="priority" required>
              <option value="urgente" >Urgente</option>
              <option value="medio" >Medio</option>
              <option selected value="bajo" >Bajo</option>
            </select>
          </label><br>
          <input class="btn btn-success" type="submit" value="Añadir" name="save_task">
        </form>
        <form action="" method="POST">
            <label for="">Filtrar por: </label>
            <select name="filter" id="">
              <option value="todos">Todos</option>
              <option value="pendientes">Pendientes</option>
              <option value="vencidas">Vencidas</option>
              <option value="archivadas">Archivadas</option>
            </select>
          <input type="submit" value="Filtrar" name="filter_tasks">

        </form>
      </div>
      <div class="col">
        <table class="table table-hover">
          <thead class="">
            <tr>
              <th>Titulo</th>
              <th>Contenido</th>
              <th>Fecha inicio</th>
              <th>Fecha fin</th>
              <th>Prioridad</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>
          
          <?php

            while ($row = $result_tasks->fetch_array(MYSQLI_NUM))
            {?>

              <tr>
                    <td><?php echo $row[1]?></td>
                    <td><?php echo $row[2]?></td>
                    <td><?php echo $row[3]?></td>
                    <td><?php echo $row[4]?></td>
                    <td><?php echo $row[6]?></td>
                    <td><?php echo $row[7]?></td>
                    <td>
                      <a href="update.php?tasks_id=<?php echo $row[0]?>" class="btn btn-primary">
                        <i class="fas fa-marker"></i>
                      </a>
                    </td>
                    <td>
                      <a href="delete_task.php?tasks_id=<?php echo $row[0]?>" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i>
                      </a>
                    </td>
                    <td>
                      <a href="archive.php?tasks_id=<?php echo $row[0]?>" class="btn btn-secondary">
                        <i class="fas fa-archive"></i>
                      </a>
                    </td>
                  </tr>
           <?php } ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/d98197d415.js" crossorigin="anonymous"></script>
</body>
</html>