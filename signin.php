<?php require_once './connection.php'; ?>

<?php include './head.php' ?>

            <h6>Login</h6>
            <form  action="" method="POST">
              <label  for="">Usuario
                <input  type="text" name="user_name" required>
              </label><br>
              <label  for="">Contraseña
                <input  type="password" name="password" required>
              </label><br>
              <input  type="submit" value="Login" > <span>ó</span>
              <a  href="signup.php">Regístrate</a>
            </form>
         
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