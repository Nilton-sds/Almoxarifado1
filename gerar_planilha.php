<?php
include_once("conexao_bd.php");

// Configura o cabeçalho HTTP para forçar o download em formato Excel (.csv)
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=produtos_almoxarifado_' . date('Y-m-d') . '.csv');

// Abre o ponteiro de saída do PHP
$output = fopen('php://output', 'w');

// Adiciona o BOM para garantir a acentuação correta no Excel
fputs($output, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF));

// Define os nomes das colunas na primeira linha do Excel
fputcsv($output, array('Código', 'Produto', 'Quantidade', 'Preço (R$)', 'Observação'), ';');

try {
    // Busca os produtos no PostgreSQL
    $stmt = $conn->prepare("SELECT cod_item, nome_produto, qtd_produto, preco_produto, obs_produto FROM public.item_pedido ORDER BY cod_item DESC");
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Escreve cada linha de produto no arquivo
    foreach ($produtos as $linha) {
        // Formata o preço para o padrão brasileiro
        $linha['preco_produto'] = number_format($linha['preco_produto'], 2, ',', '.');
        fputcsv($output, $linha, ';');
    }
} catch (PDOException $e) {
    echo "Erro ao gerar planilha: " . $e->getMessage();
}

fclose($output);
exit;
?>
