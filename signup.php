<?php require_once './connection.php';?>

<?php include './head.php' ?>

<body>
  <div class="container">
    <div class="row-auto ">
      <div class="col-auto">
        <div class="d-flex justify-content-center align-items-center">
          <div class="border border-3 rounded-3 border-dark p-3 ">
            <h5>Regístrate</h5>
            <form class="d-flex flex-column" action="signup.php" method="POST">
              <label class="form-label w-auto" for="">Usuario
                <input class="form-control w-auto" type="text" name="user_name" required>
              </label>
              <label class="form-label" for="">Contraseña
                <input class="form-control w-auto" type="password" name="password" required>
              </label>
              <input class="btn btn-success w-auto" type="submit" value="Registrarme">
            </form>
          </div>

        </div>

      </div>
    </div>

  </div>

  <?php

    if(isset($_POST['user_name']) && isset($_POST['password']))
    {
      $user_name = mysql_entities_fix_string($connection, $_POST['user_name']);
      $tmp_password = mysql_entities_fix_string($connection, $_POST['password']);

      $password = password_hash($tmp_password, PASSWORD_DEFAULT);

      $query = "INSERT INTO users (user_name, password)
                VALUES('$user_name','$password')";

      $result = $connection->query($query);
      if(!$result){
        die ('Falló registro');
      }
      else{
        header('Location: index.php');

      }

    }

    function mysql_entities_fix_string($connection, $string)
    {
        return htmlentities(mysql_fix_string($connection, $string));
    }

    function mysql_fix_string($connection, $string)
    {
        if (get_magic_quotes_gpc()) $string = stripslashes($string);
        return $connection->real_escape_string($string);
    }

  ?>

</body>
</html>
