<!-- selecionar_produto.php -->
<?php
// Supondo que você tenha uma matriz de produtos aqui ou qualquer outra lógica de obtenção de dados
$produto = array(
    array("codigo" => 1, "nome_produto" => "Produto A", "categoria_produto" => "Categoria 1", "valor_produto" => 10.99, "info" => "Informação adicional", "foto_produto" => "imagem1.jpg", "data_hora" => "2022-01-31 12:30:00"),
    // ... adicione mais produtos aqui ...
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeProdutoPesquisa = $_POST["nome_produto"];
    
    // Filtrar produtos com base no nome de pesquisa
    $resultadoPesquisa = array_filter($produto, function($p) use ($nomeProdutoPesquisa) {
        return stripos($p["nome_produto"], $nomeProdutoPesquisa) !== false;
    });

    // Se preferir, você pode retornar o resultado em formato JSON para processamento no lado do cliente
    // echo json_encode($resultadoPesquisa);
} else {
    // Se não for uma solicitação POST, talvez você queira carregar todos os produtos
    $resultadoPesquisa = $produto;
}
?>

<!-- Modificar o loop na tabela para usar $resultadoPesquisa -->
<?php foreach ($resultadoPesquisa as $p): ?>
    <!-- Restante do código da tabela permanece o mesmo -->
<?php endforeach; ?>
