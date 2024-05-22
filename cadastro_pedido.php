<?php



if(count($_POST) > 0) {


$nome= $_POST["nome_produto"];
$qtd= $_POST["qtd_produto"];
$obs= $_POST["obs_produto"];
$preco= $_POST["preco_produto"];
$qtd_produto= $_POST["qtd_produto"];
// pegar os dados usuario



try {
 
   include("conexao_bd.php");


  $sql = "INSERT INTO item_pedido 
  (cod_usuario, nome_produto,qtd_produto,obs_produto, preco_produto,qtd_produto)
  values (?,?,?,?,?,?)";
  $stmt= $conn->prepare($sql);
  $stmt->execute([null,$nome,$qtd,$obs, $preco]);

$resultado["msg"] = "item inserido";
$resultado["cod"] = 1;
$resultado["style"] = "alert-sucess";

  
} 

catch(PDOException $e) {
  echo "Inserção no banco de daso falhou:". $e->getMessage();;
  $resultado["msg"]="item não inserido";
  $resultado["cod"] = 0;
  $resultado["style"] = "alert-danger";
}


$conn = null;
header("location: Produto.php");
}



?>




