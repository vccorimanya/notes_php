<?php
    session_start();

    if (isset($_SESSION['user_name']))
    {
        $user_name = $_SESSION['user_name'];

        destroy_session_and_data();

        header('Location: signin.php');

    }
    else echo "Por favor <a href='signin.php'>Click aqui</a>
                para iniciar sesion";

    function destroy_session_and_data()
    {
        //session_start();
        $_SESSION = array();
        setcookie(session_name(), '', time()-2592000, '/');
        session_destroy();
    }
?>
