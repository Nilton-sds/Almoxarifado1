<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && count($_POST) > 0) {

    // Recebe os dados do formulário
    $cod_item = $_POST['cod_item'] ?? $_POST['cod_produto'] ?? $_POST['codigo'] ?? null;
    $nome     = $_POST['nome_produto'] ?? '';
    $qtd      = (int)($_POST['qtd_produto'] ?? 1);
    $obs      = $_POST['obs_produto'] ?? '';
    $preco    = (float)($_POST['preco_produto'] ?? 0);

    if ($cod_item !== null) {
        try {
            include_once("conexao_bd.php");

            // Atualiza os dados no banco PostgreSQL
            $sql = "UPDATE public.item_pedido 
                    SET nome_produto = ?, 
                        qtd_produto = ?, 
                        obs_produto = ?, 
                        preco_produto = ? 
                    WHERE cod_item = ?";

            $stmt = $conn->prepare($sql);
            $stmt->execute([$nome, $qtd, $obs, $preco, $cod_item]);

        } catch (PDOException $e) {
            $_SESSION['erro'] = "Erro ao atualizar produto: " . $e->getMessage();
        }
    }

    // Redireciona de volta para a lista de produtos
    header("Location: produto.php");
    exit;
}
?>
