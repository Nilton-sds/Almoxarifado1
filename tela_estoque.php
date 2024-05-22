<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Senha</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Almoxarifado</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Sistema Almoxarifado</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="produto.php">Cadastro de produto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="gerar_planilha.php">Gerar relatorio</a> 
                </li>
                <a class="nav-link" href="login.php">SAIR</a>
            </ul>
        </div>
    </div>
</nav>

<script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>



<h2>  </h2>

<body>
    <div class="container mt-5">
        <form action="cadastro_usuario.php" method="post">
            <div class="form-group">
                <label for="codigo">Codigo:</label>
                <input type="text" class="form-control" id="codigo" name="codigo" aria-describedby="emailHelp" placeholder="Digite o nome do usuário" required>
            </div>
            <div class="form-group">
                <label for="produto">Nome do produto:</label>
                <input type="email" class="form-control" id="email" name="produto" aria-describedby="emailHelp" placeholder="Digite o email" required>
            </div>
            <div class="form-group">
                <label for="qtd_produto">Saida de Material:</label>
                <input type="password" class="form-control" id="qtd_produto" name="qtd_produto" placeholder="Digite a senha" required>
                <br>
                
            <button type="submit" class="btn btn-primary" >Salvar</button>
          
        </form>

       
    </div>
</body>
</html>
