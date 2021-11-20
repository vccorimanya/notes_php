<?php require_once './querys.php'; ?>
<?php require_once './insert.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>
</head>
<body>
  <h6>Login</h6>
  <form action="index.php" method="POST">
    <label for="">Usuario:<input type="text" name="user_name"></label><br>
    <label for="">Contraseña:<input type="password" name="password"></label><br>
    <input type="submit" value="Registrarme" name="save_user">
  </form>

  <form action="index.php" method="POST">
    <label for="">Titulo: <input type="text" name="title"></label><br>
    <textarea name="content" id="" cols="30" rows="10">Contenido: </textarea><br>
    <label for="">Fecha inicio: <input type="text" name="added_date"></label><br>
    <label for="">Fecha fin : <input type="text" name="deadline"></label><br>
    <label for="">Prioridad :
      <select name="priority" id="">
        <option value="urgente">Urgente</option>
        <option value="medio">Medio</option>
        <option value="bajo">Bajo</option>
      </select>
    </label><br>
    <input type="submit" value="Añadir" name="save_task">
  </form>
</body>
</html>