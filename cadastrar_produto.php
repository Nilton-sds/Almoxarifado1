<?php
session_start();

$msg = "";
$style = "";

// Quando o formulário for enviado (botão Salvar)
if ($_SERVER["REQUEST_METHOD"] == "POST" && count($_POST) > 0) {

    $nome  = $_POST["nome_produto"] ?? '';
    $qtd   = $_POST["qtd_produto"] ?? 1;
    $obs   = $_POST["obs_produto"] ?? '';
    $preco = $_POST["preco_produto"] ?? 0;
    $categoria = $_POST["categoria"] ?? 'Geral';
    $cod_usuario = $_SESSION['cod_usuario'] ?? null;

    try {
        include_once("conexao_bd.php");

        // Insere o produto no banco PostgreSQL
        $sql = "INSERT INTO public.item_pedido (cod_usuario, nome_produto, qtd_produto, obs_produto, preco_produto, categoria) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([$cod_usuario, $nome, $qtd, $obs, $preco, $categoria]);

        // Após salvar com sucesso, volta para a lista de produtos
        header("Location: produto.php");
        exit;

    } catch (PDOException $e) {
        $msg = "Erro ao cadastrar produto: " . $e->getMessage();
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
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Cadastrar Novo Produto</h4>
            <a href="produto.php" class="btn btn-sm btn-light">Voltar à Lista</a>
        </div>
        <div class="card-body">

            <?php if (!empty($msg)): ?>
                <div class="alert <?php echo $style; ?>" role="alert">
                    <?php echo htmlspecialchars($msg); ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="form-group">
                    <label for="nome_produto"><b>Nome do Produto *</b></label>
                    <input type="text" name="nome_produto" id="nome_produto" class="form-control" placeholder="Ex: Caneta Azul" required>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="preco_produto"><b>Preço (R$) *</b></label>
                        <input type="number" step="0.01" name="preco_produto" id="preco_produto" class="form-control" placeholder="0.00" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="qtd_produto"><b>Quantidade *</b></label>
                        <input type="number" name="qtd_produto" id="qtd_produto" class="form-control" value="1" min="1" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="categoria"><b>Categoria</b></label>
                    <input type="text" name="categoria" id="categoria" class="form-control" placeholder="Ex: Material de Escritório" value="Geral">
                </div>

                <div class="form-group">
                    <label for="obs_produto"><b>Informações Adicionais (Observação)</b></label>
                    <textarea name="obs_produto" id="obs_produto" class="form-control" rows="3" placeholder="Ex: Caixa com 100 unidades"></textarea>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="produto.php" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success font-weight-bold">Salvar Produto</button>
                </div>
            </form>

        </div>
    </div>
</div>

</body>
</html>
