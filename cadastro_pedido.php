<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && count($_POST) > 0) {

    $nome  = $_POST["nome_produto"] ?? '';
    $qtd   = $_POST["qtd_produto"] ?? 0;
    $obs   = $_POST["obs_produto"] ?? '';
    $preco = $_POST["preco_produto"] ?? 0.0;
    
    // Supondo que o cod_usuario possa vir de sessão ou ser nulo
    $cod_usuario = $_SESSION['cod_usuario'] ?? null;

    try {
        include_once("conexao_bd.php");

        // SQL corrigido com 5 colunas e o schema public.
        $sql = "INSERT INTO public.item_pedido (cod_usuario, nome_produto, qtd_produto, obs_produto, preco_produto) 
                VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        
        // Passando exatamente os 5 parâmetros correspondentes
        $stmt->execute([$cod_usuario, $nome, $qtd, $obs, $preco]);

        $resultado["msg"] = "Item inserido com sucesso";
        $resultado["cod"] = 1;
        $resultado["style"] = "alert-success";

    } catch (PDOException $e) {
        $resultado["msg"] = "Inserção no banco de dados falhou: " . $e->getMessage();
        $resultado["cod"] = 0;
        $resultado["style"] = "alert-danger";
    }

    $conn = null;
    
    // Redireciona de volta para a lista com nome do arquivo correto (minúsculo no Render/Linux)
    header("Location: produto.php");
    exit;
}

?>
