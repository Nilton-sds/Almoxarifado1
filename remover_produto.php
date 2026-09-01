<?php
session_start();

// Pega o código vindo da URL (cod_item ou codigo)
$cod_item = $_GET['cod_item'] ?? $_GET['codigo'] ?? null;

if ($cod_item !== null) {
    try {
        include_once("conexao_bd.php");

        // Executa o DELETE no PostgreSQL
        $sql = "DELETE FROM public.item_pedido WHERE cod_item = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$cod_item]);

    } catch (PDOException $e) {
        // Se houver erro de exclusão, grava na sessão
        $_SESSION['erro'] = "Erro ao excluir produto: " . $e->getMessage();
    }
}

// Redireciona de volta para a lista de produtos
header("Location: produto.php");
exit;
?>
