<?php
include 'conexao.php';
include 'menu.php';
include 'cadastro_estabelecimentos.html';

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Cria a conexão
    $conn = new mysqli($servidor, $usuario, $senha, $banco);

    // Verifica se ocorreu algum erro na conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Obtém os valores dos campos do formulário
    $nome = $_POST["nome_fantasia"] ?? '';
    $endereco = $_POST["endereco"] ?? '';
    $cidade = $_POST["cidade"] ?? '';
    $num_lojas = $_POST["num_lojas"] ?? '';

    // Verifica se os campos foram preenchidos corretamente
    if (!empty($nome) && !empty($endereco) && !empty($cidade) && !empty($num_lojas)) {
        // Executa a query SQL para inserir os dados na tabela "estabelecimentos"
        $sql = "INSERT INTO estabelecimentos (nome_fantasia, endereco, cidade, num_lojas) VALUES ('$nome', '$endereco', '$cidade', $num_lojas)";

        if ($conn->query($sql) === TRUE) {
            echo "Estabelecimento cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar estabelecimento : " . $conn->error;
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}
?>
