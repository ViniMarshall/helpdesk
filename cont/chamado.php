<?php 
    session_start();
    //Banco de dados
    include_once('../model/banco.php');

    if(isset($_GET['query'])){
        if($_GET['query'] == 'abrir'){
            unset($_POST['abrir-chamado']);
            if(empty(array_filter($_POST))){
                echo "erro 1";
            } else{
                //Foreign Key
                $fk_usuario = $_SESSION['id_usuario'];

                //Dados do formulário
                $titulo = $_POST['titulo'];
                $categoria = $_POST['categoria'];
                $descricao = $_POST['descricao'];
                $data_chamado_abertura = $_POST['data'];
                $data_chamado_resolucao = $_POST['data'];
                $status_chamado = $_POST['status'];

                //Envio para o banco
                if($_SESSION['grupo_usuario'] == 'tecnico'){
                    $insert = "INSERT INTO chamado(fk_tecnico,titulo_chamado,categoria_chamado,descricao_chamado,data_chamado_abertura,data_chamado_resolucao,status_chamado) VALUES ('$fk_usuario','$titulo','$categoria','$descricao','$data_chamado_abertura','$data_chamado_resolucao','$status_chamado')";
                } else{
                    $insert = "INSERT INTO chamado(fk_usuario,titulo_chamado,categoria_chamado,descricao_chamado,data_chamado_abertura,data_chamado_resolucao,status_chamado) VALUES ('$fk_usuario','$titulo','$categoria','$descricao','$data_chamado_abertura','$data_chamado_resolucao','$status_chamado')";
                }
                $envio = mysqli_query($conexao,$insert);
                // Redirecionamento
                if(mysqli_affected_rows($conexao) != 0){
                    header("Location: /helpdesk/chamados.php?sucesso=1");
                }else{
                    header("Location: /helpdesk/chamados.php?erro=1");
                }
            }
        } else{
            if(empty(array_filter($_POST))){
                echo "erro 2";
            } else{
                if(isset($_GET['id'])){
                    $idChamado = $_GET['id'];
                }
                //Foreign Key
                if($_SESSION['grupo_usuario'] == 'tecnico'){
                    $fk_tecnico = $_SESSION['id_usuario'];
                }

                //Dados do formulário
                $titulo = $_POST['titulo'];
                $categoria = $_POST['categoria'];
                $descricao = $_POST['descricao'];
                $data_chamado_abertura = $_POST['data'];
                $data_chamado_resolucao = $_POST['data'];
                $status_chamado = $_POST['status'];
                $mensagem_chamado = $_POST['mensagem'];

                if($status_chamado == '3' || $status_chamado == '4'){
                    date_default_timezone_set('America/Sao_Paulo');
                    $data = new DateTime();
                    $data_resolvido = $data->format('Y-m-d H:i:s');
                    $data_chamado_resolucao = $data_resolvido;
                }

                //Envio para o banco
                if($_SESSION['grupo_usuario'] == 'tecnico'){
                    $insert = "UPDATE chamado SET fk_tecnico = '$fk_tecnico', titulo_chamado = '$titulo', categoria_chamado = '$categoria', descricao_chamado = '$descricao', data_chamado_abertura = '$data_chamado_abertura', data_chamado_resolucao = '$data_chamado_resolucao', status_chamado = '$status_chamado', mensagem_chamado = '$mensagem_chamado' WHERE id_chamado = '$idChamado'";
                } else{
                    $insert = "UPDATE chamado SET titulo_chamado = '$titulo', categoria_chamado = '$categoria', descricao_chamado = '$descricao', data_chamado_abertura = '$data_chamado_abertura', data_chamado_resolucao = '$data_chamado_resolucao', status_chamado = '$status_chamado', mensagem_chamado = '$mensagem_chamado' WHERE id_chamado = '$idChamado'";
                }
                $envio = mysqli_query($conexao,$insert);
                // Redirecionamento
                if(mysqli_affected_rows($conexao) != 0){
                    header("Location: /helpdesk/chamados.php?sucesso=2");
                }else{
                    header("Location: /helpdesk/chamados.php?noedit=1");
                }
            }
        }
        
    }
    
?>