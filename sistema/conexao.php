<?php
$servidor = " ";
$usuario = " ";
$senha = " ";
$banco = " ";

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

if(!$conexao) {
  die("Conexão falhou: " . mysqli_connect_error());
}
?>
