<?php require_once './connection.php'; ?>

<?php include './head.php' ?>

<body>
  <div class="container">
    <div class="row-auto">
      <div class="col-auto">
        <div class="d-flex justify-content-center align-items-center">
          <div class="border border-3 rounded-3 border-dark p-3 ">
            <h6>Login</h6>
            <form class="d-flex flex-column" action="" method="POST">
              <label class="form-label w-auto" for="">Usuario
                <input class="form-control w-auto" type="text" name="user_name" required>
              </label>
              <label class="form-label w-auto" for="">Contraseña
                <input class="form-control w-auto" type="password" name="password" required>
              </label>
              <input class="btn btn-success w-auto" type="submit" value="Login" > <span>ó</span>
              <a class="btn btn-primary w-auto" href="signup.php">Regístrate</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php

    if(isset($_POST['user_name']) && isset($_POST['password']))
    {
      $tmp_user_name = mysql_entities_fix_string($connection, $_POST['user_name']);
      $tmp_password = mysql_entities_fix_string($connection, $_POST['password']);

      $query = "SELECT * FROM users WHERE user_name = '$tmp_user_name' ";
      $result = $connection->query($query);

      if(!$result) die ("Usuario no encontrado");
      elseif ($result->num_rows)
      {
        $row = $result->fetch_array(MYSQLI_NUM);
        $result->close();

        if(password_verify($tmp_password,$row[2]))
        {
          session_start();
          $_SESSION['user_id']=$row[0];
          $_SESSION['user_name']=$row[1];
          echo "asdasd  $row[0]";
          header('Location: index.php');
        }
        else {
          echo "Usuario/password incorrecto";
        }
      }
      else {
        echo "Usuario/password incorrecto";
      }
    }

    $connection->close();


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
</body>
</html>