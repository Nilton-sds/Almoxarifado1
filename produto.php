<?php
// Garanta que o arquivo que busca os dados no banco foi incluído antes desta linha
include_once("selecionar_produto.php");

// LINHA 106 (Corrigida: trocado $produto por $produtos e adicionada validação)
if (isset($produtos) && is_array($produtos) && count($produtos) > 0) {
    foreach ($produtos as $item) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($item['nome_produto']) . "</td>";
        echo "<td>" . htmlspecialchars($item['qtd_produto']) . "</td>";
        echo "<td>" . htmlspecialchars($item['preco_produto']) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>Nenhum produto cadastrado.</td></tr>";
}
?>
