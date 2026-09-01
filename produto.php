<?php
// Desativa a exibição de avisos dentro do HTML para não quebrar os inputs
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
ini_set('display_errors', '0');

session_start();
include_once("conexao_bd.php");

// 1. Captura o código vindo da URL (testa os nomes mais comuns)
$codigo = $_GET['codigo'] ?? $_GET['cod_item'] ?? $_GET['cod_produto'] ?? $_GET['id'] ?? null;
$produto = [];
$msg_erro = "";

// 2. Processa o envio do formulário (UPDATE)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cod_post   = $_POST['codigo'] ?? '';
    $nome       = $_POST['nome'] ?? '';
    $categoria  = $_POST['categoria'] ?? '';
    $preco      = (float)($_POST['preco'] ?? 0);
    $qtd        = (int)($_POST['quantidade'] ?? 1);

    if (!empty($cod_post)) {
        try {
            // Atualiza tentando cobrir os nomes de coluna mais prováveis
            $sql = "UPDATE public.item_pedido 
                    SET nome_produto = ?, categoria = ?, preco_produto = ?, qtd_produto = ? 
                    WHERE cod_item = ? OR cod_produto = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nome, $categoria, $preco, $qtd, $cod_post, $cod_post]);

            header("Location: produto.php");
            exit;
        } catch (Exception $e) {
            $msg_erro = "Erro ao atualizar: " . $e->getMessage();
        }
    }
}

// 3. Busca os dados no Banco de Dados
if (!empty($codigo)) {
    try {
        $sql = "SELECT * FROM public.item_pedido WHERE cod_item = ? OR cod_produto = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$codigo, $codigo]);
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dados) {
            $produto = $dados;
        }
    } catch (Exception $e) {
        $msg_erro = "Erro ao consultar banco: " . $e->getMessage();
    }
}

// Trata os valores de forma segura (se for nulo, vira texto vazio em vez de Warning)
$val_codigo    = $produto['cod_item'] ?? $produto['cod_produto'] ?? $produto['codigo'] ?? $produto['id'] ?? $codigo ?? '';
$val_nome      = $produto['nome_produto'] ?? $produto['nome'] ?? '';
$val_categoria = $produto['categoria'] ?? '';
$val_preco     = $produto['preco_produto'] ?? $produto['valor'] ?? $produto['preco'] ?? '';
$val_qtd       = $produto['qtd_produto'] ?? $produto['quantidade'] ?? $produto['qtd'] ?? '';
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
                <div class="alert alert-danger"><?php echo htmlspecialchars($msg_erro); ?></div>
            <?php endif; ?>

            <form action="alterar_produto.php" method="POST">
                
                <div class="form-group">
                    <label><b>Código:</b></label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars((string)$val_codigo); ?>" readonly>
                    <input type="hidden" name="codigo" value="<?php echo htmlspecialchars((string)$val_codigo); ?>">
                </div>

                <div class="form-group">
                    <label><b>Produtos:</b></label>
                    <input type="text" name="nome" class="form-control" value="<?php echo htmlspecialchars((string)$val_nome); ?>" required>
                </div>

                <div class="form-group">
                    <label><b>Categoria:</b></label>
                    <input type="text" name="categoria" class="form-control" value="<?php echo htmlspecialchars((string)$val_categoria); ?>">
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label><b>Valor Unitário R$:</b></label>
                        <input type="number" step="0.01" name="preco" class="form-control" value="<?php echo htmlspecialchars((string)$val_preco); ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label><b>Quantidade:</b></label>
                        <input type="number" name="quantidade" class="form-control" value="<?php echo htmlspecialchars((string)$val_qtd); ?>" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary font-weight-bold btn-block mt-4">ALTERAR PRODUTO</button>
            </form>

        </div>
    </div>
</div>

</body>
</html>
