<?php 
    session_start();
    include_once('../model/banco.php');

    if(isset($_GET['a'])){
        $param = $_GET['a'];

        $login = $_POST['usuario'];
        $entrar = $_POST['entrar'];
        $senha = md5($_POST['senha']);

        $tecnico = false;
        if($param == 'login-tecnico'){
            $tecnico = true;
        }
        
        //Verificação do ID do Usuário para FK
        if($tecnico == false){
            $checkId = mysqli_query($conexao, "SELECT id_usuario,grupo FROM usuario WHERE usuario = '$login'");
        } else{
            $checkId = mysqli_query($conexao, "SELECT id_tecnico,grupo FROM tecnico WHERE usuario = '$login'");
        }
        $dados_id = mysqli_fetch_assoc($checkId);
        if($dados_id['grupo'] == 'tecnico'){
            $_SESSION['id_usuario'] = $dados_id['id_tecnico'];
        } else{
            $_SESSION['id_usuario'] = $dados_id['id_usuario'];
        }
        $_SESSION['grupo_usuario'] = $dados_id['grupo'];
        $_SESSION['nome'] = $login;

        //Verifica se o login está correto
        if($tecnico == false){
            $verifica = mysqli_query ($conexao,"SELECT usuario,senha FROM usuario WHERE usuario = '$login' AND senha = '$senha'") or die("erro ao selecionar");
        } else{
            $verifica = mysqli_query ($conexao,"SELECT usuario,senha FROM tecnico WHERE usuario = '$login' AND senha = '$senha'") or die("erro ao selecionar");
        }
        if (mysqli_num_rows($verifica) > 0){
            $_SESSION["login"] = $login;
            $_SESSION["senha"] = $senha;
            header("Location:/helpdesk/home.php?login=sucesso");
        } else{
            unset($_SESSION['login']);
            unset($_SESSION['senha']);
            if($tecnico == false){
                header("Location:/helpdesk/index.php?erro=login-incorreto");
            } else{
                header("Location:/helpdesk/admin/index.php?erro=login-incorreto");
            }
        }
    }
?>