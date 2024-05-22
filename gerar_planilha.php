<?php
// Definimos o nome do arquivo que será exportado
$arquivo = 'msgcontatos.xls';

// Incluímos o arquivo com a lógica para selecionar os produtos do banco de dados
include("selecionar_produto.php");

// Criamos uma tabela HTML com o formato da planilha
$html = '';
$html .= '<table border="1">';
$html .= '<tr>';
$html .= '<td colspan="5">Planilha de Produtos</td>';
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td><b>Codigo</b></td>';
$html .= '<td><b>Nome do Produto</b></td>';
$html .= '<td><b>Categoria</b></td>';
$html .= '<td><b>Valor</b></td>';
$html .= '<td><b>qtd_produto</b></td>';
$html .= '<td><b>Informaçoes Adicionais</b></td>';
$html .= '<td><b>Foto</b></td>';
$html .= '<td><b>Data e Hora</b></td>';
$html .= '</tr>';

// Aqui iteramos sobre os produtos obtidos do banco de dados e adicionamos as linhas na tabela
foreach ($produto as $p) {
    $html .= '<tr>';
    $html .= '<td>' . $p["codigo"] . '</td>';
    $html .= '<td>' . $p["nome_produto"] . '</td>';
    $html .= '<td>' . $p["categoria_produto"] . '</td>';
    $html .= '<td>' . $p["valor_produto"] . '</td>';
    $html .= '<td>' . $p["qtd_produto"] . '</td>';
    $html .= '<td>' . $p["info"] . '</td>';
    $html .= '<td>' . $p["foto_produto"] . '</td>';
    $html .= '<td>' . $p["data_hora"] . '</td>';
 
    $html .= '</tr>';
}

$html .= '</table>';

// Configurações header para forçar o download
header("Expires: Mon, 07 Jul 2016 05:00:00 GMT");
header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: application/x-msexcel");
header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
header("Content-Description: PHP Generated Data");

// Envia o conteúdo do arquivo
echo $html;
exit;
?>
