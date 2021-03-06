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
        include_once('model/banco.php');
        include('dao/scripts.php');
        include('view/html/topo.php');
        
    if(isset($_GET['id'])){
        $idChamado = $_GET['id'];
        for($i = 0; $i < $size; $i++){
            if($conteudo[$i]['id'] == $idChamado){
                $msg = $conteudo[$i]['mensagem_chamado'];
    ?>
    <div class="conteudo">
        <div class="card">
            <form class="editar-chamado" method="POST" name="editar-chamado" action="cont/chamado.php?query=editar&id=<?php echo $idChamado ?>">
                <input type="hidden" name="data" value="<?php echo $conteudo[$i]['data_abertura'] ?>">
                <input type="hidden" name="proprietario" value="<?php echo $conteudo[$i]['id_proprietario'] ?>">
                <div class="campos">
                    <h1>Chamado</h1>
                    <div class="campo">
                        <label for="titulo">Título:</label>
                        <?php if($_SESSION['grupo_usuario'] == 'tecnico'){ ?>
                        <input type="hidden" name="titulo" value="<?php echo $conteudo[$i]['titulo'] ?>">
                        <div class="campo-personalizado"><?php echo $conteudo[$i]['titulo'] ?></div>
                        <?php }else{?>
                        <input type="text" name="titulo" value="<?php echo $conteudo[$i]['titulo'] ?>">
                        <?php }?>
                    </div>
                    <div class="campo">
                        <label for="categoria">Categoria:</label>
                        <select name="categoria">
                            <?php 
                                $categorias = array('Criação de usuário','Hardware','Software','Rede','Design');
                                $nCategorias = array(1,2,3,4,5);
                                $cat = $conteudo[$i]['categoria'];
                                for($a = 0; $a < 5; $a++){
                                    $b = $a + 1;
                                    if($nCategorias[$a] == $cat){
                                        echo '<option value="'.$b.'" selected>'.$categorias[$a].'</option>';
                                    } else{
                                        echo '<option value="'.$b.'">'.$categorias[$a].'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="campo">
                        <label for="descricao">Descrição:</label>
                        <?php if($_SESSION['grupo_usuario'] == 'tecnico'){ ?>
                        <input type="hidden" name="descricao" value="<?php echo $conteudo[$i]['descricao'] ?>"></input>
                        <div class="campo-personalizado"><?php echo $conteudo[$i]['descricao'] ?></div>
                        <?php }else{?>
                        <textarea name="descricao" rows="4" value="<?php echo $conteudo[$i]['descricao'] ?>"><?php echo $conteudo[$i]['descricao'] ?></textarea>
                        <?php }?>
                    </div>
                    <div class="campo">
                        <label for="status">Status:</label>
                        <select name="status">
                            <?php 
                                $status = array('Aberto','Pendente','Resolvido','Fechado');
                                $nStatus = array(1,2,3,4);
                                $stat = $conteudo[$i]['status'];
                                for($c = 0; $c < 4; $c++){
                                    $d = $c + 1;
                                    if($nStatus[$c] == $stat){
                                        echo '<option value="'.$d.'" selected>'.$status[$c].'</option>';
                                    } else{
                                        echo '<option value="'.$d.'">'.$status[$c].'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <?php if($_SESSION['grupo_usuario'] == 'tecnico'){ ?>
                    <div class="campo">
                        <label>Resposta:</label>
                        <?php  if($msg != null && $msg != ''){ ?>
                        <textarea name="mensagem" rows="4"><?php echo $msg ?></textarea>
                        <?php  } else{ ?>
                        <textarea name="mensagem" rows="4"></textarea>
                        <?php }?>
                    </div>
                    <?php } else{ ?>
                    <div class="campo">
                        <?php  if($msg != null && $msg != ''){ ?>
                        <label>Resposta do técnico:</label>
                        <input type="hidden" name="mensagem" value="<?php echo $msg ?>">
                        <div class="campo-personalizado"><?php echo $msg ?></div>
                        <?php } ?>
                    </div>
                    <?php }?>
                    <?php if($_SESSION['grupo_usuario'] == 'tecnico'){ ?>
                    <div class="campo">
                        <label for="tecnico">Técnico responsável:</label>
                        <select name="tecnico">
                            <?php 
                                for($x = 0; $x < $sizeTech; $x++){
                                    $tecnico = $tech[$x]['nome'];
                                    $id = $tech[$x]['id'];
                                    echo '<option value="'.$id.'">'.$tecnico.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <?php }?>
                </div>
                <div class="botoes">
                    <a href="chamados.php">Voltar</a>
                    <?php if($_SESSION['grupo_usuario'] == 'tecnico'){ ?>
                    <button type="submit">Responder chamado</button>
                    <?php } else{ ?>
                    <button type="submit">Editar chamado</button>
                    <?php }?>
                </div>
            </form>
        </div>
    </div>
    <?php 
        }}}
    ?>
</body>
</html>