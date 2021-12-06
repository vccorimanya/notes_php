<?php 

date_default_timezone_set("America/Lima");
require_once './connection.php';
require_once './add_task.php' ;

include './head.php';


 session_start();
 $user_id = $_SESSION['user_id'];

 $where="WHERE user_id = '$user_id' and state= 1 ORDER BY deadline ASC ";
 $estado = "";

 $now = date("Y-m-d");



 if (isset($_POST['filter_tasks']))
{
  $fl = $_POST['filter'];
	if ($fl == 'vencidas')
	{
		$where="WHERE user_id = $user_id AND deadline < '$now'";
    $estado = "none";

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


$query = "SELECT  tasks_id, title,content, DATE_FORMAT(created_at, '%Y-%m-%e'), DATE_FORMAT(deadline, '%Y-%m-%e'),user_id,priority, state FROM tasks $where";
               
 
$result_tasks = $connection->query($query);
if(mysqli_num_rows($result_tasks)==0){
    $mensaje="<h1>No hay registros </h1>";
  }

 ?>


<body>

  <nav >
    <div >
       <?php

      if (isset($_SESSION['user_name']))
      {
          $user_name = htmlspecialchars($_SESSION['user_name']);
          echo "<h3> Bienvenido otra vez $user_name</h3>
                <a  href=logout.php>Cerrar sesion</a>";
      } else {

        header('Location: signin.php');
      }
      ?>

    </div>
  </nav>

  
    
     
        <form action="" method="POST">
          <label for="" >Titulo: <input type="text"  name="title" required></label><br>
          <textarea name="content" id="" cols="30" rows="10" placeholder="Contenido" required></textarea><br>
          <label >Fecha inicio: <input  type="text" value="<?php echo $now ?>" name="created_at" required></label><br>
          <label for="">Fecha fin : <input  type="text" placeholder="<?php echo $now ?>" name="deadline" required></label><br>
          <label  for="priority">Prioridad :
            <select  name="priority" id="priority" required>
              <option value="urgente" >Urgente</option>
              <option value="medio" >Medio</option>
              <option selected value="bajo" >Bajo</option>
            </select>
          </label><br>
          <input  type="submit" value="Añadir" name="save_task">
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
     
      
        <table border>
          <thead>
            <tr>
              <th>Titulo</th>
              <th>Contenido</th>
              <th>Fecha inicio</th>
              <th>Fecha fin</th>
              <th>Prioridad</th>
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
                    <td>
                      <a  style="pointer-events:<?php echo $estado?>" href="update.php?tasks_id=<?php echo $row[0]?>" class="btn btn-primary">
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
      

 
  <script src="https://kit.fontawesome.com/d98197d415.js" crossorigin="anonymous"></script>
</body>
</html>