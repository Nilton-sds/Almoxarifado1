<?php

if (count($_GET) > 0) {
    require_once('produto/Produto.php');

    // Certifique-se de que você está obtendo o código corretamente do $_GET
    $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;

    if ($codigo !== null) {
        $produto = new Produto();
        $resultado = $produto->remover($codigo);
    }
}

header("location: produto.php");
exit; // Certifique-se de usar exit após header para evitar qualquer saída adicional que possa causar problemas
?>
