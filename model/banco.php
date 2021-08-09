<?php 

$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "bd_projeto";

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

if(!$conexao){
    die("Falha na conexao: ". mysqli_connect_error());
}

?>