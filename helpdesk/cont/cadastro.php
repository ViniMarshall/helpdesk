<?php 
    session_start();
    
    if(isset($_GET['a'])){
        $param = $_GET['a'];
        if($param == 'cadastro'){
            //Banco de dados
            include_once('../model/banco.php');

            //Dados do formulário
            $login_usuario = $_POST['usuario'];
            $email_usuario = $_POST['email'];
            $senha_usuario = MD5($_POST['senha']);
            $nome_usuario = $_POST['nome'];
            $sexo_usuario = $_POST['sexo'];
            $grupo_usuario = $_POST['grupo'];

            //Checa se já existe no banco
            $checkUser = "SELECT usuario,email FROM usuario WHERE usuario = '$login_usuario' AND email = '$email_usuario'";
            $rowCheck = mysqli_query($conexao,$checkUser);
            if(mysqli_num_rows($rowCheck) != 0){
                header("Location: /helpdesk?erro=usuario-cadastrado");
            } else{
                //Comando para inserir no banco
                $result_usuario = "INSERT INTO usuario(nome,email,usuario,senha,sexo,grupo) VALUES ('$nome_usuario','$email_usuario','$login_usuario','$senha_usuario','$sexo_usuario','$grupo_usuario')";
                //Envio para o banco
                $post_usuario = mysqli_query($conexao,$result_usuario);
                //Redirecionamento
                if(mysqli_affected_rows($conexao) != 0){
                    header("Location: /helpdesk?cadastro=sucesso");
                }else{
                    header("Location: /helpdesk?cadastro=erro");
                }
            }
        }
    }
?>