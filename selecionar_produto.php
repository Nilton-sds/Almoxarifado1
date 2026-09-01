<?php
include_once("conexao_bd.php");

$produtos = [];

try {
    // Busca explicitamente no schema public
    $stmt = $conn->prepare("SELECT * FROM public.item_pedido ORDER BY cod_item DESC");
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao consultar banco: " . $e->getMessage();
}
?>
