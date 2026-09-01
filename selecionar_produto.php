<?php
include_once("conexao_bd.php");

$produtos = []; // Inicializa como array vazio para não dar erro de null no count()

try {
    $stmt = $conn->prepare("SELECT * FROM item_pedido");
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao buscar produtos: " . $e->getMessage();
}
?>
