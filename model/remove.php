<?php
    include_once('../model/banco.php');
    session_start();
    if(isset($_GET['token'])){
        $fk_usuario = $_SESSION['id_usuario'];
        $checkFk = mysqli_query($conexao, "SELECT fk_usuario FROM chamado INNER JOIN usuario ON usuario.id_usuario = chamado.fk_usuario WHERE fk_usuario = '$fk_usuario'");
        $dadosFk = mysqli_fetch_assoc($checkFk);
        $id = $_GET['token'];
        if($dadosFk != null){
            $remove = mysqli_query($conexao, "DELETE FROM chamado WHERE id_chamado = '$id'");
            if(mysqli_affected_rows($conexao) != 0){
                header("Location: /helpdesk/chamados.php?removido=sucesso");
            }else{
                header("Location: /helpdesk/chamados.php?removido=erro");
            }
        } else if($_SESSION['grupo_usuario'] == 'tecnico'){
            $remove = mysqli_query($conexao, "DELETE FROM chamado WHERE id_chamado = '$id'");
            if(mysqli_affected_rows($conexao) != 0){
                header("Location: /helpdesk/chamados.php?removido=sucesso");
            }else{
                header("Location: /helpdesk/chamados.php?removido=erro");
            }
        }
    }
    
?>