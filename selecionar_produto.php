<?php

$where_cod = "";
if (isset($_GET["codigo"])){
  $where_cod = "AND codigo = " .$_GET["codigo"];
}




try{

    include("conexao_bd.php");
 
    
 
// pegar os produtos armazenado no bd:

$consulta = $conn->prepare("SELECT * FROM produto WHERE situacao = 'HABILITADO' " .$where_cod);
$consulta->execute();

 $consulta->execute();

 
 $produto =$consulta->fetchAll();

 } 
 
 catch(PDOException $e) {
   echo "Inserção no banco de daso falhou:". $e->getMessage();;
   $resultado["msg"]="item não inserido";
   $resultado["cod"] = 0;
   $resultado["style"] = "alert-danger";
 }
 

 $conn = null;


 
 


 
?>

