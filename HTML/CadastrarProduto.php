<?php
session_start();

if(isset($_FILES['foto'])){
  try{
    include('../backEnd\conexao.php');
    $foto = $_FILES['foto'];
    if($foto['error']){
      die('falha ao enviar arquivo');
    }
    if($foto['size'] > 2097152){
      die('arquivo muito grande');
    }
    $pathArquivo = file_get_contents($foto["tmp_name"]);
    $dataFoto = base64_encode($pathArquivo);
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $lote = $_POST['lote'];
    $categoria = $_POST['categoria'];
    $marca = $_POST['marca'];
    $tipo = $_POST['tipo'];
    $descricao = $_POST['descricao'];

    $query = $conn->prepare("INSERT INTO farmadolores.tb_estoque(NOME_PRODUTO, PRECO_PRODUTO, LOTE_PRODUTO, CATEGORIA_PRODUTO, MARCA_PRODUTO, TIPO_PRODUTO, DS_PRODUTO, FOTO_PRODUTO) 
    VALUES ('$nome','$preco','$lote','$categoria','$marca','$tipo','$descricao','$dataFoto')
    ");
    $query->execute();
    $resultado["msg"] = 'Produto Cadastrado com sucesso!';


  } catch(PDOException $e) {
    $resultado["msg"] = "Conexão falhou: " . $e->getMessage();
  }
  



  

}
  




?>



<!DOCTYPE html>
<html lang="pt-Br">
  <head>
    <meta charset="UTF-8" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dolores</title>
    <link rel="stylesheet" href="../CSS/cadastrarProduto.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <header>
      <div id="headerAdmin">
        <img src="../img/logo.jpeg" alt="" id="headerLogo" />
        <p id="labelHeader">Acesso Administrativo</p>
      </div>
    </header>
    <main>
      <section id="sideBar">
        <li class="sidebarItems">
          <a href="./CadastrarCliente.php">
            <img class="logoItems" src="../assets/img/CadastrarCliente.svg" alt="" />
            <p>Cadastrar Cliente</p>
          </a>
        </li>
        <li class="sidebarItems">
          <a href="./ExcluirCliente.php">
            <img class="logoItems" src="../assets/img/excluirCadastro.svg" alt="" />
            <p>Excluir Cliente</p>
          </a>
        </li>
        <li class="sidebarItems">
          <a href="./ConsultarEstoque.php">
            <img class="logoItems" src="../assets/img/pesquisa.svg" alt="" />
            <p>Consultar Estoque</p>
          </a>
        </li>
        <li class="sidebarItems" id="opcaoEscolhida">
          <a href="./CadastrarProduto.php">
            <img class="logoItems" src="../assets/img/cadastrarProduto.svg" alt="" />

            <p>Cadastrar Produto</p>
          </a>
        </li>
        <li class="sidebarItems">
          <a href="./ConsultarPedido.html">
            <img class="logoItems" src="../assets/img/pesquisa.svg" alt="" />
            <p>Consultar Pedido</p>
          </a>
        </li>
        <li class="sidebarItems">
          <a href="./CadastrarFuncionario.php">
            <img class="logoItems" src="../assets/img/funcionario.svg" alt="" />

            <p>Cadastrar Funcionário</p>
          </a>
        </li>
        <li class="sidebarItems">
          <a href="./ExcluirFuncionario.php">
            <img class="logoItems" src="../assets/img/excluirFuncionario.svg" alt="" />
            <p>Excluir Funcionário</p>
          </a>
        </li>
        <li class="sidebarItems">
          <a href="./GerarNotaFiscal.php">
            <img class="logoItems" src="../assets/img/notaFiscal.svg" alt="" />
            <p>Gerar Nota Fiscal</p>
          </a>
        </li>
        <li class="sidebarItems">
          <a href="./CriacaodeCupom.html">
            <img class="logoItems" src="../assets/img/Cupom.svg" alt="" />
            <p>Criação de Cupom</p>
          </a>
        </li>
        <li class="sidebarItems">
          <a href="./StatusdePagamentos.php">
            <img class="logoItems" src="../assets/img/porquinho.svg" alt="" />
            <p>Status de Pagamentos</p>
          </a>
        </li>
        <li class="sidebarItems">
          <a href="../backEnd/logoutAdmin.php">
            <img class="logoItems" src="../assets/img/Logout.svg" alt="" />
            <p>Sair</p>
          </a>
        </li>
      </section>
      <section id="contentPage">
         <?php if(isset($resultado)): ?>
            <div class="alert alert-danger">
                <?php echo $resultado["msg"]; ?>
            </div>
          <?php endif;?>
        <div id="contentBox">
          <p id="nameContent">Cadastrar Produto</p>
          <form action="CadastrarProduto.php" method="POST" id="dataForm" enctype="multipart/form-data">
            <div class="datasGroups">
              <input
                type="text"
                name="nome"
                id="nome"
                placeholder="Nome do Produto:"
                class="leftData"
              />
              <input
                type="text"
                name="preco"
                id="preco"
                placeholder="Preço do Produto:"
              />
            </div>
            <div class="datasGroups">
              <input
                type="text"
                name="lote"
                id="lote"
                placeholder="Lote do Produto:"
                class="leftData"
              />
              <input
                type="text"
                name="categoria"
                id="categoria"
                placeholder="Categoria do Produto:"
                class="rightData"
              />
            </div>
            <div class="datasGroups">
              <input
                type="text"
                name="marca"
                id="marca"
                placeholder="Marca do Produto:"
                class="leftData"
              />
              <input
                type="text"
                name="tipo"
                id="tipo"
                placeholder="Tipo de Produto:"
                class="leftData"
              />
            </div>
            <div class="datasGroups">
              <input
                type="text"
                name="descricao"
                id="descricao"
                placeholder="Descrição do Produto:"
                class="leftData"
              />
              <input
                type="file"
                name="foto"
                id="foto"
                placeholder="Foto do Produto:"
                class="leftData"
              />
            </div>
            <button type="submit" id="cadastreButton">Cadastre</button>
          </form>
        </div>
      </section>
    </main>
  </body>
</html>
