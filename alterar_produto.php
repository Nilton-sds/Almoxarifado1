<?php
session_start();
include_once("conexao_bd.php");

// 1. Pega o parâmetro recebido via URL
$cod_item = $_GET['cod_item'] ?? $_GET['codigo'] ?? null;
$produto = null;
$msg_erro = "";

// 2. Se o formulário for enviado (POST), executa o UPDATE no PostgreSQL
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cod_item = $_POST['cod_item'] ?? null;
    $nome     = $_POST['nome_produto'] ?? '';
    $qtd      = (int)($_POST['qtd_produto'] ?? 1);
    $obs      = $_POST['obs_produto'] ?? '';
    $preco    = (float)($_POST['preco_produto'] ?? 0);

    if (!empty($cod_item)) {
        try {
            $sql = "UPDATE public.item_pedido 
                    SET nome_produto = ?, 
                        qtd_produto = ?, 
                        obs_produto = ?, 
                        preco_produto = ? 
                    WHERE cod_item = ?";
            
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nome, $qtd, $obs, $preco, $cod_item]);

            header("Location: produto.php");
            exit;
        } catch (PDOException $e) {
            $msg_erro = "Erro ao atualizar produto: " . $e->getMessage();
        }
    }
}

// 3. Busca os dados atuais do produto para preencher os campos
if (!empty($cod_item)) {
    try {
        $sql = "SELECT * FROM public.item_pedido WHERE cod_item = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$cod_item]);
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $msg_erro = "Erro ao buscar produto: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Produto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Alterar Produto</h5>
            <a href="produto.php" class="btn btn-sm btn-light">Voltar</a>
        </div>
        <div class="card-body">

            <?php if (!empty($msg_erro)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo htmlspecialchars($msg_erro); ?>
                </div>
            <?php endif; ?>

            <?php if ($produto): ?>
                <form action="alterar_produto.php?cod_item=<?php echo htmlspecialchars($cod_item); ?>" method="POST">
                    
                    <div class="form-group">
                        <label><b>Código:</b></label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($produto['cod_item'] ?? ''); ?>" readonly>
                        <input type="hidden" name="cod_item" value="<?php echo htmlspecialchars($produto['cod_item'] ?? ''); ?>">
                    </div>

                    <div class="form-group">
                        <label><b>Produtos:</b></label>
                        <input type="text" name="nome_produto" class="form-control" value="<?php echo htmlspecialchars($produto['nome_produto'] ?? ''); ?>" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label><b>Valor Unitário R$:</b></label>
                            <input type="number" step="0.01" name="preco_produto" class="form-control" value="<?php echo htmlspecialchars($produto['preco_produto'] ?? '0.00'); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label><b>Quantidade:</b></label>
                            <input type="number" name="qtd_produto" class="form-control" value="<?php echo htmlspecialchars($produto['qtd_produto'] ?? '1'); ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><b>Info Adicional (Observação):</b></label>
                        <textarea name="obs_produto" class="form-control" rows="2"><?php echo htmlspecialchars($produto['obs_produto'] ?? ''); ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary font-weight-bold btn-block mt-4">ALTERAR PRODUTO</button>
                </form>
            <?php else: ?>
                <div class="alert alert-warning text-center">
                    Produto não encontrado ou nenhum código informado na URL.
                </div>
                <a href="produto.php" class="btn btn-secondary btn-block">Voltar para a Lista</a>
            <?php endif; ?>

        </div>
    </div>
</div>

</body>
</html>
