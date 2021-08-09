<div class="menu">
    <div class="conteudo">
        <a href="index.php" class="logo">Helpdesk</a>
        <div class="links-menu">
            <?php 
            if(isset($_SESSION['login'])){
                $link = 'Meus chamados';
                if($_SESSION['grupo_usuario'] == 'tecnico'){
                    $link = 'Atender chamado';
                }
            ?>
                <a href="abrir-chamado.php" class="item">Abrir chamado</a>
                <a href="chamados.php" class="item"><?php echo $link ?></a>
                <?php echo '<a class="item sair" href="model/logout.php?token='.md5(session_id()).'">Sair</a>'?>
            <?php } else{ ?>
                <a href="cadastro.php" class="item">Cadastro</a>
            <?php }?>
        </div>
    </div>
</div>