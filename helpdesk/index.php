<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('view/html/head.php'); ?>
</head>
<body class="login">
    <?php
        session_start();
        if(isset($_SESSION['login'])){
            header('Location: home.php?logado=true');
        }
        include('view/html/topo.php');

        /* Erros */
        $mensagemErro = '';
        if(isset($_GET['erro'])){
            if($_GET['erro'] == 'usuario-cadastrado'){
                $mensagemErro = 'Usuário já cadastrado. Faça seu login.';
            } else if($_GET['erro'] == 'login-incorreto'){
                $mensagemErro = 'Dados incorretos, <a href="cadastro.php">cadastre-se.</a> ou tente novamente.';
            } else if($_GET['erro'] == 'acesso-restrito'){
                $mensagemErro = 'Área restrita, faça login para acessar.';
            }
        }
    ?>
    <div class="conteudo">
        <div class="card">
            <form class="acesso" method="POST" name="acesso" action="cont/login.php?a=login">
                <div class="campos">
                    <h1>Login</h1>
                    <div class="campo">
                        <input type="text" name="usuario" id="usuario" required placeholder="Usuário">
                    </div>
                    <div class="campo">
                        <input type="password" name="senha" id="senha" required placeholder="Senha">
                    </div>
                    <div class="campo">
                        <button type="submit" name="entrar">Entrar</button>
                    </div>
                    <div class="campo">
                        <?php 
                            if($mensagemErro != ''){
                                echo '<span class="erro">'.$mensagemErro.'</span>';
                            }
                         ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>