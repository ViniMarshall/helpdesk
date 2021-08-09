<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('view/html/head.php'); ?>
</head>
<body class="home">
    <?php
        session_start();
        if(!isset($_SESSION['login'])){
            header('Location: index.php?erro=acesso-restrito');
        }
        include('view/html/topo.php');
        if($_SESSION['grupo_usuario'] == 'tecnico') {
            $linkChamados = 'Atender chamado';
        } else{
            $linkChamados = 'Meus chamados';
        }
    ?>

    <div class="conteudo conteudo-home">
        <div class="card">
            <div class="campos">
                <h1>O que deseja fazer?</h1>
                <div class="campo">
                    <div class="links-home">
                       
                        <a href="abrir-chamado.php">Abrir chamado</a>
                        <a href="chamados.php"><?php echo $linkChamados ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>