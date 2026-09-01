<!-- Cabeçalho com Título e Botão Gerar Planilha -->
<div class="d-flex justify-content-between align-items-center mb-2">
    <h3>Produtos Cadastrados:</h3>
    <a href="gerar_planilha.php" class="btn btn-success">Gerar Planilha (.csv)</a>
</div>

<!-- Tabela com a estrutura da imagem -->
<div class="table-responsive">
    <table class="table align-middle">
        <thead>
            <tr class="border-bottom">
                <th>Codigo</th>
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
                    <tr>
                        <td><?php echo htmlspecialchars($item['cod_item'] ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars($item['nome_produto'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($item['categoria'] ?? 'Geral'); ?></td>
                        <td>R$ <?php echo number_format($item['preco_produto'] ?? 0, 2, ',', '.'); ?></td>
                        <td><?php echo htmlspecialchars($item['obs_produto'] ?? ''); ?></td>
                        <td>
                            <?php if (!empty($item['foto'])): ?>
                                <img src="<?php echo htmlspecialchars($item['foto']); ?>" alt="Foto" width="40" height="40" class="img-thumbnail">
                            <?php else: ?>
                                <span class="text-muted">Sem foto</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo !empty($item['data_criacao']) ? date('d/m/Y H:i', strtotime($item['data_criacao'])) : '-'; ?></td>
                        
                        <!-- Botões Alterar e Excluir estilizados -->
                        <td class="text-right">
                            <a href="alterar_produto.php?id=<?php echo $item['cod_item']; ?>" class="btn btn-outline-warning btn-sm">Alterar</a>
                            <a href="excluir_produto.php?id=<?php echo $item['cod_item']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Deseja realmente excluir este item?');">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center py-3">Nenhum produto cadastrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
