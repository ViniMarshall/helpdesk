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
                <input type="hidden" name="status" value="Aberto">
                <input type="hidden" name="proprietario" value="<?php echo $_SESSION['nome']?>">
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
                            <option value="Criação de usuário">Criação de usuário</option>
                            <option value="Hardware">Hardware</option>
                            <option value="Software">Software</option>
                            <option value="Rede">Rede</option>
                            <option value="Design">Design</option>
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