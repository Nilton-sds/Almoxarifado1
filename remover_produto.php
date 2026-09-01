<?php
session_start();

// Pega o parâmetro enviado pela URL (suporta cod_item ou codigo)
$cod_item = $_GET['cod_item'] ?? $_GET['codigo'] ?? null;

if ($cod_item !== null) {
    try {
        include_once("conexao_bd.php");

        // Deleta o registro diretamente via banco PostgreSQL
        $sql = "DELETE FROM public.item_pedido WHERE cod_item = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$cod_item]);

    } catch (PDOException $e) {
        $_SESSION['erro'] = "Erro ao excluir: " . $e->getMessage();
    }
}

// Redireciona de volta para a tabela de produtos
header("Location: produto.php");
exit;
?>
