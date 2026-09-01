<?php
include_once("conexao_bd.php");

// Lógica para cadastrar novo produto ao submeter o formulário
$mensagem = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cadastrar'])) {
    $nome  = $_POST['nome_produto'] ?? '';
    $qtd   = $_POST['qtd_produto'] ?? 0;
    $preco = $_POST['preco_produto'] ?? 0.0;
    $obs   = $_POST['obs_produto'] ?? '';

    if (!empty($nome) && $qtd > 0) {
        try {
            $stmt = $conn->prepare("INSERT INTO public.item_pedido (nome_produto, qtd_produto, obs_produto, preco_produto) VALUES (:nome, :qtd, :obs, :preco)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':qtd', $qtd, PDO::PARAM_INT);
            $stmt->bindParam(':obs', $obs);
            $stmt->bindParam(':preco', $preco);
            $stmt->execute();
            $mensagem = "<div class='alert alert-success'>Produto cadastrado com sucesso!</div>";
        } catch (PDOException $e) {
            $mensagem = "<div class='alert alert-danger'>Erro ao cadastrar: " . $e->getMessage() . "</div>";
        }
    }
}

// Busca os produtos atualizados do banco
include_once("selecionar_produto.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Produtos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4 mb-5">
        
        <!-- Cabeçalho com Botão para Voltar ao Início/Login -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Almoxarifado - Produtos</h2>
            <a href="index.php" class="btn btn-outline-secondary">Voltar para a Página Inicial</a>
        </div>

        <?php echo $mensagem; ?>

        <!-- Formulário de Cadastro de Produto -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Cadastrar Novo Item
            </div>
            <div class="card-body">
                <form action="produto.php" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nome do Produto:</label>
                            <input type="text" name="nome_produto" class="form-control" required placeholder="Ex: Caneta Azul">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Quantidade:</label>
                            <input type="number" name="qtd_produto" class="form-control" required placeholder="Ex: 100">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Preço (R$):</label>
                            <input type="number" step="0.01" name="preco_produto" class="form-control" required placeholder="Ex: 25.50">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Informações adicionais:</label>
                        <textarea name="obs_produto" class="form-control" rows="2" placeholder="Ex: Caixa com 100 unidades"></textarea>
                    </div>
                    <button type="submit" name="cadastrar" class="btn btn-primary">Adicionar item</button>
                </form>
            </div>
        </div>

        <!-- Tabela de Exibição dos Produtos -->
        <h4>Produtos Cadastrados</h4>
        <table class="table table-striped table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Observação</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($produtos) && is_array($produtos)): ?>
                    <?php foreach ($produtos as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['nome_produto']); ?></td>
                            <td><?php echo htmlspecialchars($item['qtd_produto']); ?></td>
                            <td>R$ <?php echo number_format($item['preco_produto'], 2, ',', '.'); ?></td>
                            <td><?php echo htmlspecialchars($item['obs_produto'] ?? ''); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Nenhum produto cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>
</body>
</html>
