<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('view/html/head.php'); ?>
</head>
<body class="chamados">
    <?php
        session_start();
        if(!isset($_SESSION['login'])){
            header('Location: index.php?erro=acesso-restrito');
        }
        $size = null;
        include_once('model/banco.php');
        include('dao/scripts.php');
        include('view/html/topo.php');

        $aberto = false;
        $pendente = false;
        $resolvido = false;
        $fechado = false;
        // echo '<pre>';
        // print_r($conteudo);
        // echo '</pre>';
        for($i = 0; $i < $size; $i++){
            if($conteudo[$i]['status'] == '1'){
                $aberto = true;
            } else if($conteudo[$i]['status'] == '2'){
                $pendente = true;
            } else if($conteudo[$i]['status'] == '3'){
                $resolvido = true;
            } else if($conteudo[$i]['status'] == '4'){
                $fechado = true;
            }
        }

        function categoria($c){
            global $cat;
            if($c == '1'){
                $cat = 'Criação de usuário';
            } else if($c == '2'){
                $cat = 'Hardware';
            } else if($c == '3'){
                $cat = 'Software';
            } else if($c == '4'){
                $cat = 'Rede';
            } else if($c == '5'){
                $cat = 'Design';
            }
        }
    ?>
    <div class="conteudo">

        <?php if($aberto == false && $pendente == false && $resolvido == false && $fechado == false){ ?>
        <div class="card">
            <div class="campo">
                <table>
                    <tr><td><h2>Nenhum chamado encontrado</h2></td></tr>
                </table>
            </div>
        </div>
        <?php }?>

        <?php if($aberto == true) {?>
        <div class="card">
            <div class="campos">
                <h1>Abertos</h1>
                <?php 
                    for($i = 0; $i < $size; $i++){
                        if($conteudo[$i]['status'] == '1'){
                            categoria($conteudo[$i]['categoria']);
                ?>
                <div class="campo">
                    <table>
                        <tr><td class="data">Data de abertura: <?php echo date("j M Y G:i", strtotime($conteudo[$i]['data_abertura'] )); ?></td></tr>
                        <tr><td class="titulo"><?php echo $conteudo[$i]['titulo'] ?></td></tr>
                        <tr><td class="categoria"><?php echo $cat ?></td></tr>
                        <tr><td class="descricao"><?php echo $conteudo[$i]['descricao'] ?></td></tr>
                        <tr><td class="data">Criado por: <?php echo $conteudo[$i]['proprietario']  ?></td></tr>
                    </table>
                    <div class="botoes">
                        <a class="btn" href="chamado.php?id=<?php echo $conteudo[$i]['id'] ?>">Chamado</a>
                        <a href="model/remove.php?token=<?php echo $conteudo[$i]['id'] ?>" class="btn">Remover chamado</a>
                    </div>
                </div>
            <?php }} ?>
            </div>
        </div>
        <?php }?>

        <?php if($pendente == true) {?>
        <div class="card">
            <div class="campos">
                <h1>Pendentes</h1>
                <?php 
                    for($i = 0; $i < $size; $i++){
                        if($conteudo[$i]['status'] == '2'){
                            categoria($conteudo[$i]['categoria']);
                            $msg = $conteudo[$i]['mensagem_chamado'];
                ?>
                <div class="campo">
                    <table>
                        <tr><td class="data">Data de abertura: <?php echo date("j M Y G:i", strtotime($conteudo[$i]['data_abertura'] )); ?></td></tr>
                        <tr><td class="titulo"><?php echo $conteudo[$i]['titulo'] ?></td></tr>
                        <tr><td class="categoria"><?php echo $cat ?></td></tr>
                        <tr><td class="descricao"><?php echo $conteudo[$i]['descricao'] ?></td></tr>
                        <tr><td class="data">Criado por: <?php echo $conteudo[$i]['proprietario']  ?></td></tr>
                        <tr><td class="data">Responsável: <?php echo $conteudo[$i]['tecnico_responsavel'] ?></td></tr>
                        <?php  if($msg != null && $msg != ''){ ?>
                        <tr class="mensagem"><td><span>Resposta chamado:</span><?php echo $msg ?></td></tr>
                        <?php }?>
                    </table>
                    <div class="botoes">
                        <a class="btn" href="chamado.php?id=<?php echo $conteudo[$i]['id'] ?>">Chamado</a>
                        <a href="model/remove.php?token=<?php echo $conteudo[$i]['id'] ?>" class="btn">Remover chamado</a>
                    </div>
                </div>
            <?php }} ?>
            </div>
        </div>
        <?php }?>

        <?php if($resolvido == true) {?>
        <div class="card">
            <div class="campos">
                <h1>Resolvidos</h1>
                <?php 
                    for($i = 0; $i < $size; $i++){
                        if($conteudo[$i]['status'] == '3'){
                            categoria($conteudo[$i]['categoria']);
                            $msg = $conteudo[$i]['mensagem_chamado'];
                ?>
                <div class="campo">
                    <table>
                        <tr><td class="data">Data de abertura: <?php echo date("j M Y G:i", strtotime($conteudo[$i]['data_abertura'] )); ?> | Data de resolucão: <?php echo date("j M Y G:i", strtotime($conteudo[$i]['data_resolucao'] )); ?></td></tr>
                        <tr><td class="titulo"><?php echo $conteudo[$i]['titulo'] ?></td></tr>
                        <tr><td class="categoria"><?php echo $cat ?></td></tr>
                        <tr><td class="descricao"><?php echo $conteudo[$i]['descricao'] ?></td></tr>
                        <tr><td class="data">Criado por: <?php echo $conteudo[$i]['proprietario']  ?></td></tr>
                        <tr><td class="data">Resolvido por: <?php echo $conteudo[$i]['tecnico_responsavel'] ?></td></tr>
                        <?php  if($msg != null && $msg != ''){ ?>
                        <tr class="mensagem"><td><span>Resposta chamado:</span><?php echo $msg ?></td></tr>
                        <?php }?>
                    </table>
                    <div class="botoes">
                        <a class="btn" href="chamado.php?id=<?php echo $conteudo[$i]['id'] ?>">Chamado</a>
                        <a href="model/remove.php?token=<?php echo $conteudo[$i]['id'] ?>" class="btn">Remover chamado</a>
                    </div>
                </div>
            <?php }} ?>
            </div>
        </div>
        <?php }?>

        <?php if($fechado == true) {?>
        <div class="card">
            <div class="campos">
                <h1>Fechados</h1>
                <?php 
                    for($i = 0; $i < $size; $i++){
                        if($conteudo[$i]['status'] == '4'){
                            categoria($conteudo[$i]['categoria']);
                            $msg = $conteudo[$i]['mensagem_chamado'];
                ?>
                <div class="campo">
                    <table>
                        <tr><td class="data">Data de abertura: <?php echo date("j M Y G:i", strtotime($conteudo[$i]['data_abertura'] )); ?> | Data de fechamento: <?php echo date("j M Y G:i", strtotime($conteudo[$i]['data_resolucao'] )); ?></td></tr>
                        <tr><td class="titulo"><?php echo $conteudo[$i]['titulo'] ?></td></tr>
                        <tr><td class="categoria"><?php echo $cat ?></td></tr>
                        <tr><td class="descricao"><?php echo $conteudo[$i]['descricao'] ?></td></tr>
                        <tr><td class="data">Criado por: <?php echo $conteudo[$i]['proprietario']  ?></td></tr>
                        <tr><td class="data">Fechado por: <?php echo $conteudo[$i]['tecnico_responsavel'] ?></td></tr>
                        <?php  if($msg != null && $msg != ''){ ?>
                        <tr class="mensagem"><td><span>Resposta chamado:</span><?php echo $msg ?></td></tr>
                        <?php }?>
                    </table>
                    <div class="botoes">
                        <a class="btn" href="chamado.php?id=<?php echo $conteudo[$i]['id'] ?>">Chamado</a>
                        <a href="model/remove.php?token=<?php echo $conteudo[$i]['id'] ?>" class="btn">Remover chamado</a>
                    </div>
                </div>
            <?php }} ?>
            </div>
        </div>
        <?php }?>
        
    </div>
</body>
</html>