<?php
include_once("conexao_bd.php");

try {
    // Busca todos os produtos da tabela item_pedido
    $sql = "SELECT * FROM public.item_pedido ORDER BY cod_item ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $produtos = [];
}
?>
