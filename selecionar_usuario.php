<?php

$where_cod = "";
if (isset($_GET["codigo"])) {
    $where_cod = "AND codigo = " . $_GET["codigo"];
}

try {
    include("conexao_bd.php");

    $consulta = $conn->prepare("SELECT codigo, nome, email, data_registro, situacao FROM usuario WHERE 1 " . $where_cod);
    $consulta->execute();
    $usuarios = $consulta->fetchAll();
} catch (PDOException $e) {
    echo "Consulta no banco de dados falhou: " . $e->getMessage();
    $resultado["msg"] = "Consulta falhou";
    $resultado["cod"] = 0;
    $resultado["style"] = "alert-danger";
}

$conn = null;
?>
