
<!DOCTYPE html>
<html lang="en">
<head>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Almoxarifado</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Sistema Almoxarifado</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="tela_usuario.php">Cadastro de funcionários</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="gerar_planilha.php">Gerar relatorio</a> 
                </li>
                <a class="nav-link" href="login.php">SAIR</a>
            </ul>
        </div>
    </div>
</nav>

<script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


    <title>Produto</title>
    
    <!-- Adicione seus links de estilo aqui -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <div class="container">
        <?php
        if (isset($_GET["codigo"]) && $_GET["codigo"] > 0) {
            $codigo = $_GET["codigo"];
            include("selecionar_produto.php");
            //print_r($produto);

            
        }
        ?>


        
        <form action="cadastrar_produto.php" method="post"> 
            <br>
            <label for="codigo">Produtos:</label><br>
            <input type="text" required class="form-control" id="nome" name="nome_produto" aria-describedby="emailHelp" placeholder="Digite a categoria do produto">
            <br><br>
            <label for="categoria_produto">Categoria:</label><br>
            <input type="text" required class="form-control" id="categoria_produto" name="categoria_produto" aria-describedby="emailHelp" placeholder="Digite a categoria do produto">
            <br><br>
            <label for="valor_produto">Valor Unitário R$:</label><br>
            <input type="number" required class="form-control" id="valor_produto" name="valor_produto" aria-describedby="emailHelp">
            
            <label for="qtd_produto">Quantidade::</label><br>
            <input type="number" required class="form-control" id="qtd_produto" name="qtd_produto" aria-describedby="emailHelp">
            
            <div class="form-group">
                <br>
                <label for="foto_produto">Foto:</label><br>
                <input type="file" class="form-control" id="foto_produto" name="foto_produto">
            </div>

            <div class="form-group">
                <label for="info">Informações adicionais:</label><br>
                <textarea name="info" id="info" rows="4" cols="50"></textarea>
                <br>
                <button type="submit" class="btn btn-primary">Adicionar item</button>
            </div>
        </form>

        <!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Contato</title>
	<head>
	<body>
		<a href="gerar_planilha.php">Gerar Planilha</a>
	</body>
</html>

        <?php if (isset($resultado)): ?>
            <div class="alert <?= $resultado["style"] ?>">
                <?= $resultado["msg"] ?>
            </div>
        <?php endif; ?>
        
        <?php include("selecionar_produto.php"); ?>
   
        <?php if (count($produto) > 0): ?>
            <h4>Produtos Cadastrados:</h4>
            
            <table class="table">
                <tr>
                    <th>Codigo</th>
                   
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Valor</th>
                    <th>Quantidade</th>
                    <th>foto</th>
                    <th>Informações Adicionais</th>
                    <th>Data Hora</th>
                </tr>
                <?php foreach($produto as $p): ?>
                    <tr>
                        <td><?= $p["codigo"]; ?></td>
                        <td><?= $p["nome_produto"]; ?></td>
                       <td><?= $p["categoria_produto"]; ?></td>
                        <td><?= $p["valor_produto"]; ?></td>

                        <td><?= $p["qtd_produto"]; ?></td>
                        <td><?= $p["info"]; ?></td>
                        <td><?= $p["data_hora"]; ?></td>
                        <td>
                        <a class="btn btn-outline-warning btn-sm" onclick="return confirm('Alterar <?=$p['nome_produto'];?>');" href="produto_alterar.php?codigo=<?=$p['codigo']?>">Alterar</a>
                        <a class="btn btn-outline-danger btn-sm" onclick="return confirm('Excluir <?=$p['nome_produto'];?>');" href="remover_produto.php?codigo=<?=$p['codigo']?>">Excluir</a>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
        <exit>
    </div>
</head>

</html>
