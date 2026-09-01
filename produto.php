<?php
include_once("conexao_bd.php");
include_once("selecionar_produto.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Cadastrados</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-4 mb-5">

        <!-- Navegação / Cadastro Inicial -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="cadastrar_produto.php" class="btn btn-primary">+ Cadastrar Novo Produto</a>
                <a href="gerar_planilha.php" class="btn btn-success ml-2">Gerar Planilha (.csv)</a>
            </div>
            <a href="index.php" class="btn btn-outline-danger">Sair / Login</a>
        </div>

        <h3 class="mb-3">Produtos Cadastrados:</h3>

        <div class="table-responsive">
            <table class="table table-hover border bg-white">
                <thead class="thead-light">
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Valor Unitário</th>
                        <th>Info Adicional</th>
                        <th>Data Hora</th>
                        <th class="text-right">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($produtos) && is_array($produtos)): ?>
                        <?php foreach ($produtos as $item): ?>
                            <?php 
                                $id_item = $item['cod_item'] ?? $item['cod_produto'] ?? $item['id'] ?? 0;
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars((string)$id_item); ?></td>
                                <td><?php echo htmlspecialchars($item['nome_produto'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($item['qtd_produto'] ?? '0'); ?></td>
                                <td>R$ <?php echo number_format($item['preco_produto'] ?? 0, 2, ',', '.'); ?></td>
                                <td><?php echo htmlspecialchars($item['obs_produto'] ?? ''); ?></td>
                                <td><?php echo !empty($item['data_criacao']) ? date('d/m/Y H:i', strtotime($item['data_criacao'])) : '-'; ?></td>
                                
                                <td class="text-right">
                                    <a href="alterar_produto.php?cod_item=<?php echo $id_item; ?>" class="btn btn-outline-warning btn-sm">Alterar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Nenhum produto cadastrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>
