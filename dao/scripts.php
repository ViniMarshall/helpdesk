<?php
    // Variáveis para recuperar Foreign key
    $fk_usuario = $_SESSION['id_usuario'];
    $checkFk = mysqli_query($conexao, "SELECT fk_usuario FROM chamado INNER JOIN usuario ON usuario.id_usuario = chamado.fk_usuario WHERE fk_usuario = '$fk_usuario'");
    $dadosFk = mysqli_fetch_assoc($checkFk);

    if($_SESSION['grupo_usuario'] == 'tecnico'){
        $buscaChamado = mysqli_query($conexao, "SELECT * FROM chamado");
        $arr = Array();
        $conteudo = Array();
        while($dado = mysqli_fetch_array($buscaChamado)){
            $fk_user = $dado['fk_usuario'];
            $fk_tech = $dado['fk_tecnico'];
            if($fk_user == null){
                $buscaUsuario = mysqli_query($conexao, "SELECT nome,fk_tecnico,id_proprietario FROM tecnico INNER JOIN chamado ON chamado.fk_tecnico = tecnico.id_tecnico WHERE fk_tecnico = '$fk_tech'");
            } else{
                $buscaUsuario = mysqli_query($conexao, "SELECT nome,fk_usuario,id_proprietario FROM usuario INNER JOIN chamado ON chamado.fk_usuario = usuario.id_usuario WHERE fk_usuario = '$fk_user'");
            }
            $buscaTecnico = mysqli_query($conexao, "SELECT nome,fk_tecnico,id_proprietario FROM tecnico INNER JOIN chamado ON chamado.fk_tecnico = tecnico.id_tecnico WHERE fk_tecnico = '$fk_tech'");
            $arr['id'] = $dado['id_chamado'];
            $arr['titulo'] = $dado['titulo_chamado'];
            $arr['categoria'] = $dado['categoria_chamado'];
            $arr['descricao'] = $dado['descricao_chamado'];
            $arr['status'] = $dado['status_chamado'];
            $arr['data_abertura'] = $dado['data_chamado_abertura'];
            $arr['data_resolucao'] = $dado['data_chamado_resolucao'];
            $arr['mensagem_chamado'] = $dado['mensagem_chamado'];
            while($user = mysqli_fetch_array($buscaUsuario)){
                $id = $user['id_proprietario'];
                if($fk_user == null){
                    $buscaProprietario = mysqli_query($conexao, "SELECT nome,id_tecnico FROM tecnico WHERE '$id' = id_tecnico");
                    while($proprietario = mysqli_fetch_array($buscaProprietario)){
                        $arr['proprietario'] = $proprietario['nome'];
                        $arr['id_proprietario'] = $proprietario['id_tecnico'];
                    }
                } else{
                    $buscaProprietario = mysqli_query($conexao, "SELECT nome,id_usuario FROM usuario WHERE '$id' = id_usuario");
                    while($proprietario = mysqli_fetch_array($buscaProprietario)){
                        $arr['proprietario'] = $proprietario['nome'];
                        $arr['id_proprietario'] = $proprietario['id_usuario'];
                    }
                }
            }
            while($tech = mysqli_fetch_array($buscaTecnico)){
                $arr['tecnico_responsavel'] = $tech['nome'];
            }
            array_push($conteudo,$arr);
        }
        $buscaTecnicos = mysqli_query($conexao, "SELECT nome,id_tecnico FROM tecnico");
        $arrTecnico = Array();
        $tech = Array();
        while($tecnico = mysqli_fetch_array($buscaTecnicos)){
            $arrTecnico['nome'] = $tecnico['nome'];
            $arrTecnico['id'] = $tecnico['id_tecnico'];
            array_push($tech,$arrTecnico);
        }
        $sizeTech = sizeof($tech);
        $size = sizeof($conteudo);
    }else if($dadosFk != null){
        if((int)$dadosFk['fk_usuario'] == (int)$fk_usuario){
            $busca = mysqli_query($conexao, "SELECT * FROM chamado WHERE fk_usuario = '$fk_usuario'");
            $conteudo = Array();
            $arr = Array();
            while($dado = mysqli_fetch_array($busca)){
                $fk_user = $dado['fk_usuario'];
                $fk_tech = $dado['fk_tecnico'];
                if($fk_user == null){
                    $buscaUsuario = mysqli_query($conexao, "SELECT nome,fk_tecnico,id_proprietario FROM tecnico INNER JOIN chamado ON chamado.fk_tecnico = tecnico.id_tecnico WHERE fk_tecnico = '$fk_tech'");
                } else{
                    $buscaUsuario = mysqli_query($conexao, "SELECT nome,fk_usuario,id_proprietario FROM usuario INNER JOIN chamado ON chamado.fk_usuario = usuario.id_usuario WHERE fk_usuario = '$fk_user'");
                }
                $buscaTecnico = mysqli_query($conexao, "SELECT nome FROM tecnico INNER JOIN chamado ON chamado.fk_tecnico = tecnico.id_tecnico WHERE fk_tecnico = '$fk_tech'");
                $arr['id'] = $dado['id_chamado'];
                $arr['titulo'] = $dado['titulo_chamado'];
                $arr['categoria'] = $dado['categoria_chamado'];
                $arr['descricao'] = $dado['descricao_chamado'];
                $arr['status'] = $dado['status_chamado'];
                $arr['data_abertura'] = $dado['data_chamado_abertura'];
                $arr['data_resolucao'] = $dado['data_chamado_resolucao'];
                $arr['mensagem_chamado'] = $dado['mensagem_chamado'];
                while($user = mysqli_fetch_array($buscaUsuario)){
                    $id = $user['id_proprietario'];
                    if($fk_user == null){
                        $buscaProprietario = mysqli_query($conexao, "SELECT nome,id_tecnico FROM tecnico WHERE '$id' = id_tecnico");
                        while($proprietario = mysqli_fetch_array($buscaProprietario)){
                            $arr['proprietario'] = $proprietario['nome'];
                            $arr['id_proprietario'] = $proprietario['id_tecnico'];
                        }
                    } else{
                        $buscaProprietario = mysqli_query($conexao, "SELECT nome,id_usuario FROM usuario WHERE '$id' = id_usuario");
                        while($proprietario = mysqli_fetch_array($buscaProprietario)){
                            $arr['proprietario'] = $proprietario['nome'];
                            $arr['id_proprietario'] = $proprietario['id_usuario'];
                        }
                    }
                }
                while($tech = mysqli_fetch_array($buscaTecnico)){
                    $arr['tecnico_responsavel'] = $tech['nome'];
                }
                array_push($conteudo,$arr);
            }
            $size = sizeof($conteudo);
        }
    }
?>