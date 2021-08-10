<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('view/html/head.php'); ?>
</head>
<body>
    <?php
        session_start();
        include('view/html/topo.php');
        $query = 'cadastro';
        if($tecnico == true){
            $query = 'cadastro-tecnico';
        }
    ?>
    <div class="conteudo">
        <h1>Cadastro</h1>

        <form class="cadastro" method="POST" name="cadastro" action="/helpdesk/cont/cadastro.php?a=<?php echo $query ?>">
            <?php if($tecnico == false){?>
            <input type="hidden" name="grupo" value="usuario">
            <?php } ?>
            <div class="campos">
                <div class="campo">
                    <label for="nome">*Nome:</label>
                    <input type="text" name="nome" id="nome" required>
                </div>
                <div class="campo">
                    <label for="sexo">Sexo:</label>
                    <select name="sexo">
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                        <option value="O">Prefiro não informar</option>
                    </select>
                </div>
                <div class="campo">
                    <label for="email">*E-mail:</label>
                    <input type="email" name="email" id="email-cad" required>
                </div>
                <div class="campo">
                    <label for="usuario">*Usuário:</label>
                    <input type="text" name="usuario" id="usuario-cad" required>
                </div>
                <div class="campo">
                    <label for="nome">*Senha:</label>
                    <input type="password" name="senha" id="senha-cad" required>
                </div>
                <?php if($tecnico == true){?>
                <div class="campo">
                    <label for="nome">*Grupo</label>
                    <select name="grupo">
                        <option value="tecnico">Tecnico</option>
                        <option value="usuario">Usuario</option>
                    </select>
                </div>
                <?php } ?>
            </div>
            <div class="campo">
                <button type="submit">Cadastrar</button>
            </div>
        </form>
    </div>
</body>
</html>