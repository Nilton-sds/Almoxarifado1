<?php
include_once("conexao_bd.php");
include_once("selecionar_produto.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <!-- Botão para voltar à página de cadastro -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Produtos Cadastrados</h2>
            <a href="index.php" class="btn btn-success">+ Cadastrar Novo Produto / Início</a>
        </div>

        <!-- Tabela formatada com Bootstrap -->
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($produtos) && is_array($produtos)): ?>
                    <?php foreach ($produtos as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['nome_produto']); ?></td>
                            <td><?php echo htmlspecialchars($item['qtd_produto']); ?></td>
                            <td>R$ <?php echo number_format($item['preco_produto'], 2, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">Nenhum produto cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
