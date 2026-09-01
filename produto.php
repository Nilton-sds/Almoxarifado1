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
    <!-- Importação do Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4 mb-5">

        <!-- Botões de Ação Superiores -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="index.php" class="btn btn-outline-secondary mr-2">← Início / Cadastro Inicial</a>
                <a href="cadastrar_produto.php" class="btn btn-primary">+ Cadastrar Novo Produto</a>
                <a href="gerar_planilha.php" class="btn btn-success ml-2">Gerar Planilha (.csv)</a>
            </div>
            <!-- Botão para sair -->
            <a href="index.php" class="btn btn-outline-danger">Sair / Login</a>
        </div>

        <h3 class="mb-3">Produtos Cadastrados:</h3>

        <!-- Tabela Estilizada -->
        <div class="table-responsive">
            <table class="table table-hover border">
                <thead class="thead-light">
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Valor</th>
                        <th>Info adicional</th>
                        <th>Foto</th>
                        <th>Data Hora</th>
                        <th class="text-right">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($produtos) && is_array($produtos)): ?>
                        <?php foreach ($produtos as $item): ?>
                            <?php 
                                // Captura o ID/Código de forma flexível
                                $id_prod = $item['cod_item'] ?? $item['cod_produto'] ?? $item['codigo'] ?? $item['id'] ?? '';
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($id_prod); ?></td>
                                <td><?php echo htmlspecialchars($item['nome_produto'] ?? $item['nome'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($item['categoria'] ?? 'Geral'); ?></td>
                                <td>R$ <?php echo number_format($item['preco_produto'] ?? $item['valor'] ?? $item['preco'] ?? 0, 2, ',', '.'); ?></td>
                                <td><?php echo htmlspecialchars($item['obs_produto'] ?? $item['observacao'] ?? $item['descricao'] ?? ''); ?></td>
                                <td>
                                    <?php if (!empty($item['foto'])): ?>
                                        <img src="<?php echo htmlspecialchars($item['foto']); ?>" alt="Foto" width="40" height="40" class="img-thumbnail">
                                    <?php else: ?>
                                        <span class="text-muted">Sem foto</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo !empty($item['data_criacao']) ? date('d/m/Y H:i', strtotime($item['data_criacao'])) : '-'; ?></td>
                                
                                <!-- Ações: Alterar e Excluir -->
                                <td class="text-right">
                                    <a href="alterar_produto.php?codigo=<?php echo urlencode($id_prod); ?>" class="btn btn-outline-warning btn-sm">Alterar</a>
                                    <a href="remover_produto.php?codigo=<?php echo urlencode($id_prod); ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Deseja excluir este produto?');">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">Nenhum produto cadastrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>
