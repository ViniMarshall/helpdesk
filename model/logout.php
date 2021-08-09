<?php
    session_start();
    $token = md5(session_id());
    if(isset($_GET['token']) && $_GET['token'] === $token){
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        unset($_SESSION['id_usuario']);
        session_destroy();
        header("Location: /helpdesk/index.php");
        exit();
    }
?>