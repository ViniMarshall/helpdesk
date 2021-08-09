<?php
    // Variáveis para recuperar Foreign key
    $fk_usuario = $_SESSION['id_usuario'];
    $checkFk = mysqli_query($conexao, "SELECT fk_usuario FROM chamado INNER JOIN usuario ON usuario.id_usuario = chamado.fk_usuario WHERE fk_usuario = '$fk_usuario'");
    $dadosFk = mysqli_fetch_assoc($checkFk);

    if($_SESSION['grupo_usuario'] == 'tecnico'){
        $buscaChamado = mysqli_query($conexao, "SELECT * FROM chamado");
        $buscaUsuario = mysqli_query($conexao, "SELECT nome FROM usuario");
        $conteudo = Array();
        $arr = Array();
        while($dado = mysqli_fetch_array($buscaChamado)){
            $arr['id'] = $dado['id_chamado'];
            $arr['titulo'] = $dado['titulo_chamado'];
            $arr['categoria'] = $dado['categoria_chamado'];
            $arr['descricao'] = $dado['descricao_chamado'];
            $arr['status'] = $dado['status_chamado'];
            $arr['data_abertura'] = $dado['data_chamado_abertura'];
            $arr['data_resolucao'] = $dado['data_chamado_resolucao'];
            $arr['proprietario'] = $dado['proprietario_chamado'];
            $arr['tecnico_responsavel'] = $dado['tecnico_responsavel'];
            $arr['mensagem_chamado'] = $dado['mensagem_chamado'];
    
            array_push($conteudo,$arr);
        }
        while($nome = mysqli_fetch_array($buscaUsuario)){
            $arr['nome'] = $nome['nome'];
        }
        
        $size = sizeof($conteudo);
        
    } else if($dadosFk != null){
        if((int)$dadosFk['fk_usuario'] == (int)$fk_usuario){
            $busca = mysqli_query($conexao, "SELECT * FROM chamado WHERE fk_usuario = '$fk_usuario'");
            $conteudo = Array();
            $arr = Array();
            while($dado = mysqli_fetch_array($busca)){
                $arr['id'] = $dado['id_chamado'];
                $arr['titulo'] = $dado['titulo_chamado'];
                $arr['categoria'] = $dado['categoria_chamado'];
                $arr['descricao'] = $dado['descricao_chamado'];
                $arr['status'] = $dado['status_chamado'];
                $arr['data_abertura'] = $dado['data_chamado_abertura'];
                $arr['data_resolucao'] = $dado['data_chamado_resolucao'];
                $arr['proprietario'] = $dado['proprietario_chamado'];
                $arr['tecnico_responsavel'] = $dado['tecnico_responsavel'];
                $arr['mensagem_chamado'] = $dado['mensagem_chamado'];
        
                array_push($conteudo,$arr);
            }

            $size = sizeof($conteudo);
        }
    }
?>