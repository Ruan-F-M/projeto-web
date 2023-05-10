<!DOCTYPE html>
<html>
<head>
	<title>Preços Mais Baratos</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<?php include 'menu.php'; ?>
	<div class="container">
		<div class="jumbotron">
			<h1 class="display-4">Preços Mais Baratos</h1>
			<p class="lead">Encontre os produtos mais baratos nos estabelecimentos próximos a você.</p>
			<hr class="my-4">
			<form method="post" action="">
				<label for="estabelecimento">Escolha um estabelecimento:</label>
				<select name="estabelecimento" id="estabelecimento" class="form-control">
					<?php
						// Fazer uma consulta no banco de dados para buscar todos os estabelecimentos
						// e preencher as opções do Combobox
						require_once('conexao.php');
						$query = "SELECT * FROM estabelecimentos";
						$resultado = mysqli_query($conexao, $query);
						while ($linha = mysqli_fetch_array($resultado)) {
							echo "<option value='".$linha['id']."'>".$linha['nome_fantasia']."</option>";
						}
					?>
				</select>
					<br>
					<button type="submit" class="btn btn-primary">Buscar</button>
				</form>
			</div>
			
			<?php
				// Verificar se o formulário foi submetido
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					// Pegar o id do estabelecimento selecionado no Combobox
					$estabelecimento_id = isset($_POST['estabelecimento']) ? $_POST['estabelecimento'] : null;
					
					// Consultar todos os produtos cadastrados no estabelecimento escolhido
					if ($estabelecimento_id) {
						// Corrigir a consulta SQL
						$query = "SELECT produtos.produto_id, cadastro.nome, produtos.preco FROM produtos INNER JOIN cadastro ON produtos.produto_id = cadastro.id WHERE produtos.estabelecimento_id = $estabelecimento_id";
						$resultado = mysqli_query($conexao, $query) or die(mysqli_error($conexao));
					}

					// Inicializar um array para armazenar os produtos mais baratos
					$produtos_mais_baratos = array();
					while ($linha = mysqli_fetch_array($resultado)) {
						// Para cada produto, consultar o menor preço dentre todos os estabelecimentos
						$produto_id = $linha['produto_id'];
						$produto_nome = $linha['nome'];
						$produto_preco = $linha['preco'];
						
						$query2 = "SELECT MIN(preco) AS menor_preco FROM produtos WHERE produto_id = $produto_id";
						$resultado2 = mysqli_query($conexao, $query2) or die(mysqli_error($conexao));
						$linha2 = mysqli_fetch_array($resultado2);
						$menor_preco = $linha2['menor_preco'];
											// Se o preço do produto atual for menor ou igual ao menor preço encontrado até agora,
					// adicionar o produto ao array de produtos mais baratos
					if ($produto_preco <= $menor_preco) {
						$produto = array(
							'nome' => $produto_nome,
							'preco' => $produto_preco
						);
						$produtos_mais_baratos[] = $produto;
					}
				}

				// Ordenar o array de produtos mais baratos pelo preço (do menor para o maior)
				usort($produtos_mais_baratos, function($a, $b) {
				    return $a['preco'] <=> $b['preco'];
				});

				// Mostrar a lista de produtos mais baratos
				echo "<h2>Produtos mais baratos:</h2>";
				if (count($produtos_mais_baratos) > 0) {
					echo "<ul>";
					foreach ($produtos_mais_baratos as $produto) {
						echo "<li>".$produto['nome']." - R$ ".$produto['preco']."</li>";
					}
					echo "</ul>";
				} else {
					echo "<p>Não foram encontrados produtos mais baratos no estabelecimento escolhido.</p>";
				}
			}
		?>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

