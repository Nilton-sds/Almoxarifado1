<?php
// Garanta que a conexão com o banco seja incluída antes de usar $conn
include_once("conexao_bd.php");

try {
    // Linha 19 original (onde ocorria o erro)
    $stmt = $conn->prepare("SELECT * FROM item_pedido");
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Seu código de listagem continua aqui...

} catch (PDOException $e) {
    echo "Erro ao buscar produtos: " . $e->getMessage();
}
?>
