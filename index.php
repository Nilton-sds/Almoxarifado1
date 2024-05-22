
<?php
   
    if(isset($nome)){
      echo"Bem-Vindo, $nome <br>";
      echo"Essas informações precisa estar logado";
    }else{
      echo"Bem-Vindo, convidado <br>";
      echo"Para acesso efetue o login";
      echo"<br><a href='login.php'>Faça Login</a> Para ler o conteúdo";
    }
?>

<!DOCTYPE html>

<html land="en">
<head>
    <!-- comentario -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Produtos 1.0</title>

</head>
<body>
    <br>
    <br>
    <div class="container">
    <h2>Efetue login </h2>
    <br>
    <form id="form_login" action="login.php" method="post">

        <?php if (isset($resultado) && $resultado["cod"]==0): ?>
        <div class="alert alert-danger">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <?php echo $resultado["msg"]; ?>
        </div>

         

      <?php endif ; ?>

    <input type="email"id="email" name="email" placeholder="Digite seu email" /><br><br>
    <input type="password"id="senha1" name="senha1" placeholder="Digite sua senha" /><br><br>
    <input type="submit"id="submeter " value="Entrar" class='btn btn-primary'/>

</form>
</body>



<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">



</html>
