<?php
// Certifique-se de que a variável existe e não está vazia antes de dar o count
if (!empty($produtos) && count($produtos) > 0) {
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
