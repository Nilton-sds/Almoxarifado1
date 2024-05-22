<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Produto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Detalhes do Produto</h1>
        
        <?php
        // Verifica se há um parâmetro de pesquisa pelo nome do produto
        $where_nome = "";
        if (isset($_GET["nome_produto"])) {
            $where_nome = "AND nome_produto LIKE '%" . $_GET["nome_produto"] . "%'";
        }

        // Conecta ao banco de dados usando MySQLi
        $conn = new mysqli("localhost", "nil.santos.ds@gmail.com", "123", "usuario");

        // Verifica se a conexão foi estabelecida com sucesso
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Executa a consulta SQL
        $query = "SELECT * FROM produto WHERE 1 " . $where_nome;
        $result = $conn->query($query);
        ?>

        <form method="GET" action="">
            <label for="nome_produto">Pesquisar por Nome do Produto:</label>
            <input type="text" id="nome_produto" name="nome_produto" value="<?php echo isset($_GET['nome_produto']) ? $_GET['nome_produto'] : ''; ?>">
            <button type="submit" class="btn btn-primary">Pesquisar</button>
        </form>

        <br>

        <?php if ($result && $result->num_rows > 0): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Nome do Produto</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Preço</th>
                        <!-- Adicione mais colunas conforme necessário -->
                    </tr>
                </thead>
                <tbody>
                    <?php while ($produto = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $produto['codigo']; ?></td>
                            <td><?php echo $produto['nome_produto']; ?></td>
                            <td><?php echo $produto['quantidade']; ?></td>
                            <td><?php echo $produto['preco']; ?></td>
                            <!-- Adicione mais colunas conforme necessário -->
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhum produto encontrado.</p>
        <?php endif; ?>

        <?php $conn->close(); ?>
    </div>
</body>
</html>
