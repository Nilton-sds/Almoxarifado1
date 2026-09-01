<?php
// Oculta avisos para impedir que erros vazem para dentro dos inputs HTML
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
ini_set('display_errors', '0');

session_start();
include_once("conexao_bd.php");

// 1. Recebe o código vindo da URL (cod_item)
$cod_item = $_GET['cod_item'] ?? $_GET['codigo'] ?? $_POST['cod_item'] ?? null;
$produto = [];
$msg_erro = "";

// 2. Se o formulário for enviado (POST), faz o UPDATE no banco
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($cod_item)) {
    $nome  = $_POST['nome_produto'] ?? '';
    $preco = (float)($_POST['preco_produto'] ?? 0);
    $qtd   = (int)($_POST['qtd_produto'] ?? 1);
    $obs   = $_POST['obs_produto'] ?? '';

    try {
        $sql = "UPDATE public.item_pedido 
                SET nome_produto = ?, 
                    preco_produto = ?, 
                    qtd_produto = ?, 
                    obs_produto = ? 
                WHERE cod_item = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nome, $preco, $qtd, $obs, $cod_item]);

        // Redireciona de volta para a lista de produtos após alterar
        header("Location: produto.php");
        exit;
    } catch (PDOException $e) {
        $msg_erro = "Erro ao atualizar produto: " . $e->getMessage();
    }
}

// 3. Busca o produto exato no banco de dados pela chave 'cod_item'
if (!empty($cod_item)) {
    try {
        $sql = "SELECT * FROM public.item_pedido WHERE cod_item = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$cod_item]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($res) {
            $produto = $res;
        }
    } catch (PDOException $e) {
        $msg_erro = "Erro ao buscar produto: " . $e->getMessage();
    }
}

// Valores seguros mapeados exatamente para as colunas do seu banco
$val_codigo = $produto['cod_item'] ?? $cod_item ?? '';
$val_nome   = $produto['nome_produto'] ?? '';
$val_preco  = $produto['preco_produto'] ?? '0.00';
$val_qtd    = $produto['qtd_produto'] ?? '1';
$val_obs    = $produto['obs_produto'] ?? '';
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

<div class="container mt-5 mb-5" style="max-width: 600px;">
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

            <?php if (!empty($produto)): ?>
                <form action="alterar_produto.php" method="POST">
                    
                    <div class="form-group">
                        <label><b>Código:</b></label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars((string)$val_codigo); ?>" readonly>
                        <input type="hidden" name="cod_item" value="<?php echo htmlspecialchars((string)$val_codigo); ?>">
                    </div>

                    <div class="form-group">
                        <label><b>Produtos (Nome):</b></label>
                        <input type="text" name="nome_produto" class="form-control" value="<?php echo htmlspecialchars((string)$val_nome); ?>" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label><b>Valor Unitário R$:</b></label>
                            <input type="number" step="0.01" name="preco_produto" class="form-control" value="<?php echo htmlspecialchars((string)$val_preco); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label><b>Quantidade:</b></label>
                            <input type="number" name="qtd_produto" class="form-control" value="<?php echo htmlspecialchars((string)$val_qtd); ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><b>Info Adicional (Observação):</b></label>
                        <textarea name="obs_produto" class="form-control" rows="3"><?php echo htmlspecialchars((string)$val_obs); ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary font-weight-bold btn-block mt-4">ALTERAR PRODUTO</button>
                </form>
            <?php else: ?>
                <div class="alert alert-warning text-center">
                    <strong>Nenhum produto encontrado!</strong><br>
                    O código informado (<code><?php echo htmlspecialchars((string)$cod_item); ?></code>) não foi localizado no banco de dados.
                </div>
                <a href="produto.php" class="btn btn-secondary btn-block">Voltar para a Lista</a>
            <?php endif; ?>

        </div>
    </div>
</div>

</body>
</html>
