<?php
include "conexao.php";
include "menu.php";
include "cadastro_produto.html";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $marca = $_POST["marca"];
    $tamanho_quantidade = $_POST["tamanho"];

    $sql = "INSERT INTO cadastro (nome, marca, tamanho_quantidade) VALUES ('$nome', '$marca', '$tamanho_quantidade')";
    if ($conexao->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Produto cadastrado com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao cadastrar o produto: " . $conexao->error . "</div>";
    }
}
?>
