<?php
session_start();
include_once("conexao_bd.php");

// 1. Captura o código enviado por GET ou POST
$codigo = $_GET['cod_item'] ?? $_GET['cod_produto'] ?? $_GET['id'] ?? $_POST['cod_item'] ?? null;
$produto = null;
$msg_erro = "";

// 2. Se o formulário for enviado (POST), realiza o UPDATE
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($codigo)) {
    $nome  = $_POST['nome_produto'] ?? '';
    $qtd   = (int)($_POST['qtd_produto'] ?? 1);
    $obs   = $_POST['obs_produto'] ?? '';
    $preco = (float)($_POST['preco_produto'] ?? 0);

    try {
        $sql = "UPDATE public.item_pedido 
                SET nome_produto = ?, 
                    qtd_produto = ?, 
                    obs_produto = ?, 
                    preco_produto = ? 
                WHERE cod_item = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nome, $qtd, $obs, $preco, $codigo]);

        header("Location: produto.php");
        exit;
    } catch (PDOException $e) {
        $msg_erro = "Erro ao atualizar produto: " . $e->getMessage();
    }
}

// 3. Busca os dados atuais no banco tentando múltiplos nomes de coluna
if (!empty($codigo)) {
    try {
        // Tenta buscar por 'cod_item' ou 'cod_produto'
        $sql = "SELECT * FROM public.item_pedido WHERE cod_item = ? OR cod_produto = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$codigo, $codigo]);
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);

        // Se não encontrar por parâmetro numérico simples, busca todos e filtra
        if (!$produto) {
            $sql = "SELECT * FROM public.item_pedido";
            $stmt = $conn->query($sql);
            $todos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($todos as $row) {
                $row_id = $row['cod_item'] ?? $row['cod_produto'] ?? $row['id'] ?? null;
                if ($row_id == $codigo) {
                    $produto = $row;
                    break;
                }
            }
        }
    } catch (PDOException $e) {
        $msg_erro = "Erro de conexão/consulta: " . $e->getMessage();
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

            <?php if ($produto): ?>
                <form action="alterar_produto.php" method="POST">
                    
                    <div class="form-group">
                        <label><b>Código:</b></label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($produto['cod_item'] ?? $produto['cod_produto'] ?? $codigo); ?>" readonly>
                        <input type="hidden" name="cod_item" value="<?php echo htmlspecialchars($produto['cod_item'] ?? $produto['cod_produto'] ?? $codigo); ?>">
                    </div>

                    <div class="form-group">
                        <label><b>Produtos (Nome):</b></label>
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
                    <strong>Nenhum dado encontrado!</strong><br>
                    O código informado na URL foi: <code><?php echo htmlspecialchars($codigo ?? 'Nenhum código passado'); ?></code>
                </div>
                <a href="produto.php" class="btn btn-secondary btn-block">Voltar para a Lista</a>
            <?php endif; ?>

        </div>
    </div>
</div>

</body>
</html>
