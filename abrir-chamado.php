<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('view/html/head.php'); ?>
</head>
<body class="abertura-chamado">
    <?php
        session_start();
        if(!isset($_SESSION['login'])){
            header('Location: index.php?erro=acesso-restrito');
        }
        include('view/html/topo.php');
        date_default_timezone_set('America/Sao_Paulo');
        $data = new DateTime();
        $dataAtual = $data->format('Y-m-d H:i:s');
        
    ?>
    <div class="conteudo">
        <div class="card">
            <form class="abrir-chamado" method="POST" name="abrir-chamado" action="cont/chamado.php?query=abrir">
                <input type="hidden" name="status" value="1">
                <input type="hidden" name="tecnico" value="<?php echo $_SESSION['nome']?>">
                <input type="hidden" name="data" value="<?php echo $dataAtual ?>">
                <div class="campos">
                    <h1>Abertura de chamado</h1>
                    <div class="campo">
                        <label for="titulo">Título:</label>
                        <input type="text" name="titulo" required>
                    </div>
                    <div class="campo">
                        <label for="categoria">Categoria:</label>
                        <select name="categoria" required>
                            <option value="1">Criação de usuário</option>
                            <option value="2">Hardware</option>
                            <option value="3">Software</option>
                            <option value="4">Rede</option>
                            <option value="5">Design</option>
                        </select>
                    </div>
                    <div class="campo">
                        <label for="descricao">Descrição</label>
                        <textarea name="descricao" rows="4" required></textarea>
                    </div>
                </div>
                <div class="botoes">
                    <a href="home.php">Voltar</a>
                    <button type="submit">Abrir chamado</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>