<?php
session_start();
if($_SESSION['logado'] == 'logado'){
  // finalizar compra 
  $cpf = $_SESSION['cpf'];
  $date = date('Y-m-d'); 
  //$qtd_Produto = $GET['qtd_Produto'];
  include('conexao.php');


  try {
    $query = $conn->prepare("SELECT * from farmadolores.tb_carrinho LEFT JOIN farmadolores.tb_estoque ON tb_carrinho.ID_PRODUTO = tb_estoque.ID_PRODUTO where tb_carrinho.CPF_CLIENTE  = :CPF_CLIENTE;");
    $query ->bindParam(':CPF_CLIENTE',$cpf, PDO::PARAM_STR);
    $query->execute();

    if($dados = $query -> fetch(PDO::FETCH_ASSOC)){
      $query2 = $conn->prepare("SELECT ID_PRODUTO, NOME_PRODUTO,PRECO_PRODUTO, LOTE_PRODUTO,CATEGORIA_PRODUTO,MARCA_PRODUTO,TIPO_PRODUTO,QTD_PRODUTO,DATA_ENTRADA_PRODUTO,DS_PRODUTO FROM farmadolores.tb_estoque WHERE ID_PRODUTO = $dados[ID_PRODUTO] ");
      $query2->execute();

    }  

    if($dados = $query2 -> fetch(PDO::FETCH_ASSOC)){
      $NOME_PRODUTO =  $dados["NOME_PRODUTO"];
      $PRECO_PRODUTO =  $dados["PRECO_PRODUTO"];
      $LOTE_PRODUTO =  $dados["LOTE_PRODUTO"];
      $CATEGORIA_PRODUTO =  $dados["CATEGORIA_PRODUTO"];
      $MARCA_PRODUTO =  $dados["MARCA_PRODUTO"];
      $TIPO_PRODUTO =  $dados["TIPO_PRODUTO"];
      $QTD_PRODUTO =  $dados["QTD_PRODUTO"];
      $DATA_ENTRADA_PRODUTO =  $dados["DATA_ENTRADA_PRODUTO"];

      $query3 = $conn->prepare("INSERT INTO `farmadolores`.`tb_pedidos`
      (`ID_PEDIDO`,`INFO_PEDIDO`,`VALOR_PEDIDO`,`DATA_PEDIDO`,`ID_STATUS`,`CPF_CLIENTE`,`ID_PGTO`)
      VALUES
      ($dados[ID_PRODUTO],'$NOME_PRODUTO',$PRECO_PRODUTO,' $date',1,'$cpf',4);");
      $query3->execute();

      $query4 = $conn->prepare("DELETE FROM `farmadolores`.`tb_carrinho`
      WHERE ID_PRODUTO = $dados[ID_PRODUTO] AND CPF_CLIENTE = '$cpf';");
      $query4->execute();

    }
    

    $_SESSION['idPedido'] = $dados["ID_PRODUTO"];
    header('Location: ../pagamento.php');

    //3.verificar se usuario e senah esta no banco de dados 
    
  } catch(PDOException $e) {
    echo "Conexão falhou: " . $e->getMessage();
    }














}else{
  header('Location: ../login.php');
}





?>