<?php
include('conexao.php');
include('menu.php');

$sql = "SELECT c.nome, p.preco, c.tamanho_quantidade
        FROM cadastro c
        JOIN produtos p ON p.produto_id = c.id
        JOIN (
            SELECT produto_id, MIN(preco) AS preco_minimo
            FROM produtos
            GROUP BY produto_id
        ) pm ON p.produto_id = pm.produto_id AND p.preco = pm.preco_minimo
        ORDER BY c.tamanho_quantidade ASC";

$resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Relatório - Preços mais baratos</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
  <h2 class="mb-4">Relatório - Preços mais baratos</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Produto</th>
        <th>Preço</th>
        <th>gramas/ml</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($linha = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td>" . $linha['nome'] . "</td>";
        echo "<td>" . $linha['preco'] . "</td>";
        echo "<td>" . $linha['tamanho_quantidade'] . "</td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
