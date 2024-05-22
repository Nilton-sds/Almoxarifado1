<?php

if (count($_POST) > 0) {

    require_once('produto/Produto.php');

    $produto = new Produto();
    $resultado = $produto->atualizar($_POST);

    header("location: produto.php");
}

// Remova esta linha, pois você já incluiu a classe no início do arquivo
// include("Produto.php");

?>
