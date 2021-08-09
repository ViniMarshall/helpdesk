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
                $proprietario_chamado = $_POST['proprietario'];
                $tecnico_responsavel = $_POST['tecnico'];

                //Envio para o banco
                $insert = "INSERT INTO chamado(fk_usuario,titulo_chamado,categoria_chamado,descricao_chamado,data_chamado_abertura,data_chamado_resolucao,status_chamado,proprietario_chamado,tecnico_responsavel) VALUES ('$fk_usuario','$titulo','$categoria','$descricao','$data_chamado_abertura','$data_chamado_resolucao','$status_chamado','$proprietario_chamado','$tecnico_responsavel')";
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
                $fk_usuario = $_SESSION['id_usuario'];

                //Dados do formulário
                $titulo = $_POST['titulo'];
                $categoria = $_POST['categoria'];
                $descricao = $_POST['descricao'];
                $data_chamado_abertura = $_POST['data'];
                $data_chamado_resolucao = $_POST['data'];
                $status_chamado = $_POST['status'];
                $proprietario_chamado = $_POST['proprietario'];
                $tecnico_responsavel = $_POST['tecnico_responsavel'];
                $mensagem_chamado = $_POST['mensagem'];

                if($status_chamado == 'Resolvido' || $status_chamado == 'Fechado'){
                    date_default_timezone_set('America/Sao_Paulo');
                    $data = new DateTime();
                    $data_resolvido = $data->format('Y-m-d H:i:s');
                    $data_chamado_resolucao = $data_resolvido;
                }

                //Envio para o banco
                $insert = "UPDATE chamado SET titulo_chamado = '$titulo', categoria_chamado = '$categoria', descricao_chamado = '$descricao', data_chamado_abertura = '$data_chamado_abertura',data_chamado_resolucao = '$data_chamado_resolucao', status_chamado = '$status_chamado', proprietario_chamado = '$proprietario_chamado', tecnico_responsavel = '$tecnico_responsavel',mensagem_chamado = '$mensagem_chamado' WHERE id_chamado = '$idChamado'";
                $envio = mysqli_query($conexao,$insert);
                // Redirecionamento
                if(mysqli_affected_rows($conexao) != 0){
                    header("Location: /helpdesk/chamados.php?sucesso=1");
                }else{
                    header("Location: /helpdesk/chamados.php?noedit=1");
                }
            }
        }
        
    }
    
?>