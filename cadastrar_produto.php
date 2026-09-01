<?php
session_start();

$msg = "";
$style = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && count($_POST) > 0) {

    $nome  = $_POST["nome_produto"] ?? '';
    $qtd   = (int)($_POST["qtd_produto"] ?? 1);
    $obs   = $_POST["obs_produto"] ?? '';
    $preco = (float)($_POST["preco_produto"] ?? 0);

    try {
        include_once("conexao_bd.php");

        // SQL compatível com a estrutura padrão da tabela item_pedido
        $sql = "INSERT INTO public.item_pedido (nome_produto, qtd_produto, obs_produto, preco_produto) 
                VALUES (?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nome, $qtd, $obs, $preco]);

        // Redireciona para a lista ao cadastrar com sucesso
        header("Location: produto.php");
        exit;

    } catch (PDOException $e) {
        // Exibe o erro real retornado pelo PostgreSQL
        $msg = "Erro no Banco de Dados: " . $e->getMessage();
        $style = "alert-danger";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Cadastrar Novo Produto</h5>
            <a href="produto.php" class="btn btn-sm btn-light">Voltar</a>
        </div>
        <div class="card-body">

            <?php if (!empty($msg)): ?>
                <div class="alert <?php echo $style; ?>" role="alert">
                    <?php echo htmlspecialchars($msg); ?>
                </div>
            <?php endif; ?>

            <form action="cadastrar_produto.php" method="POST">
                <div class="form-group">
                    <label><b>Nome do Produto *</b></label>
                    <input type="text" name="nome_produto" class="form-control" required placeholder="Ex: Teclado USB">
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label><b>Preço (R$) *</b></label>
                        <input type="number" step="0.01" name="preco_produto" class="form-control" required placeholder="0.00">
                    </div>
                    <div class="form-group col-md-6">
                        <label><b>Quantidade *</b></label>
                        <input type="number" name="qtd_produto" class="form-control" value="1" required>
                    </div>
                </div>

                <div class="form-group">
                    <label><b>Info Adicional (Observação)</b></label>
                    <textarea name="obs_produto" class="form-control" rows="3" placeholder="Observações do item"></textarea>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="produto.php" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success font-weight-bold">Salvar Produto</button>
                </div>
            </form>

        </div>
    </div>
</div>

</body>
</html>
