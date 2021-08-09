<?php 
    session_start();
    include_once('../model/banco.php');

    if(isset($_GET['a'])){
        $param = $_GET['a'];
        if($param == 'login'){
            $login = $_POST['usuario'];
            $entrar = $_POST['entrar'];
            $senha = md5($_POST['senha']);
            
            //Verificação do ID do Usuário para FK
            $checkId = mysqli_query($conexao, "SELECT id_usuario,grupo FROM usuario WHERE usuario = '$login'");
            $dados_id = mysqli_fetch_assoc($checkId);
            $_SESSION['id_usuario'] = $dados_id['id_usuario'];
            $_SESSION['grupo_usuario'] = $dados_id['grupo'];
            $_SESSION['nome'] = $login;

            //Verifica se o login está correto
            $verifica = mysqli_query ($conexao,"SELECT usuario,senha FROM usuario WHERE usuario = '$login' AND senha = '$senha'") or die("erro ao selecionar");
            if (mysqli_num_rows($verifica) > 0){
                $_SESSION["login"] = $login;
                $_SESSION["senha"] = $senha;
                header("Location:/helpdesk/home.php?login=sucesso");
            } else{
                unset($_SESSION['login']);
                unset($_SESSION['senha']);
                header("Location:/helpdesk/index.php?erro=login-incorreto");
            }
        }
    }
?>