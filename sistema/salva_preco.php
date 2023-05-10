<?php
include "conexao.php";

$produto_id = $_POST["produto"];
$estabelecimento_id = $_POST["estabelecimento"];
$preco = $_POST["preco"];

$sql = "INSERT INTO preco (produto_id, estabelecimento_id, preco) VALUES ($produto_id, $estabelecimento_id, $preco)";

if (mysqli_query($conexao, $sql)) {
  header("Location: relatorios.php");
  exit;
} else {
  echo "Erro ao cadastrar preço: " . mysqli_error($conexao);
}

mysqli_close($conexao);
