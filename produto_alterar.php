<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto</title>
   
    <!-- Adicione seus links de estilo aqui -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <?php

$where_cod = "";
if (isset($_GET["codigo"])){
  $where_cod = "AND codigo = " .$_GET["codigo"];
}
        if (isset($_GET["codigo"]) && $_GET["codigo"] > 0) {
            $codigo = $_GET["codigo"];
            include("selecionar_produto.php");
            //print_r($produto);
        }
        ?>
        
        <form action="alterar_produto.php" method="post"> 
            <br>
            <label for="codigo">Código:</label><br>
            <input type="text" required readonly value="<?= $produto[0]['codigo']; ?>" id="codigo" name="codigo" aria-describedby="emailHelp">
            <br><br>
            <label for="nome_produto">Produtos:</label><br>
            <input type="text" required value="<?= $produto[0]['nome_produto']; ?>" id="nome_produto" name="nome_produto">
            <br><br>
            <label for="categoria_produto">Categoria:</label><br>
            <input type="text" required value="<?= $produto[0]['categoria_produto']; ?>" id="categoria_produto" name="categoria_produto">
            <br><br>
            <label for="valor_produto">Valor Unitário R$:</label><br>
            <input type="number" required value="<?= $produto[0]['valor_produto']; ?>" id="valor_produto" name="valor_produto">
            
            <div class="form-group">
                <br>
                <label for="foto_produto">Foto:</label><br>
                <input type="file" class="form-control" id="foto_produto" name="foto_produto">
            </div>

            <br><br>
            <label for="qtd_produto">Quantidade:</label><br>
            <input type="text"required value="<?= $produto[0]['qtd_produto']; ?>" id="qtd_produto" name="qtd_produto">
            <br><br>
            <br>
                <button type="submit" class="btn btn-primary">ALTERAR PRODUTO</button>
            </div>
        </form>

            
        </form>

        <?php if (isset($resultado)): ?>
            <div class="alert <?= $resultado["style"] ?>">
                <?= $resultado["msg"] ?>
            </div>
        <?php endif; ?>
    </div>

  

    <!-- Adicione outros scripts e conteúdo do corpo aqui -->

</body>
</html>
