<!DOCTYPE html>
<html>
<head>
	<?php include "menu.php"; ?>
	<title>Cadastro de Preço de Produto</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<h1>Cadastro de Preço de Produto</h1>
		<form method="POST" action="cadastro_preco.php">
			<div class="form-group">
				<label for="produto">Produto:</label>
				<select name="produto" id="produto" class="form-control">
					<?php
						include 'conexao.php';

						$sql = "SELECT id, nome FROM cadastro";
						$resultado = $conexao->query($sql);

						if ($resultado->num_rows > 0) {
							while($linha = $resultado->fetch_assoc()) {
								echo "<option value='".$linha["id"]."'>".$linha["nome"]."</option>";
							}
						}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="estabelecimento">Estabelecimento:</label>
				<select name="estabelecimento" id="estabelecimento" class="form-control">
					<?php
						$sql = "SELECT id, nome_fantasia FROM estabelecimentos";
						$resultado = $conexao->query($sql);

						if ($resultado->num_rows > 0) {
							while($linha = $resultado->fetch_assoc()) {
								echo "<option value='".$linha["id"]."'>".$linha["nome_fantasia"]."</option>";
							}
						}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="preco">Preço:</label>
				<input type="text" name="preco" id="preco" class="form-control">
			</div>

			<button type="submit" class="btn btn-primary">Cadastrar</button>
		</form>
	</div>

	<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$produto_id = $_POST["produto"];
			$estabelecimento_id = $_POST["estabelecimento"];
			$preco = $_POST["preco"];

			$sql = "INSERT INTO produtos (produto_id, estabelecimento_id, preco) VALUES ('$produto_id', '$estabelecimento_id', '$preco')";

			if ($conexao->query($sql) === TRUE) {
				echo "<script>alert('Preço cadastrado com sucesso!');</script>";
			} else {
				echo "<script>alert('Erro ao cadastrar preço: " . $conexao->error . "');</script>";
			}

			$conexao->close();
		}
	?>
</body>
</html>
