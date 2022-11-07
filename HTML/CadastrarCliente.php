<?php
session_start();

if(
  isset($_POST['cpf']) 
  && isset($_POST['nome']) 
  && isset($_POST['email'])
  && isset($_POST['data']) 
  && isset($_POST['endereco']) 
  && isset($_POST['cep']) 
  && isset($_POST['bairro'])
  && isset($_POST['telefone'])
  && isset($_POST['senha'])
  && isset($_POST['password2']))
   {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $dataNascimento = $_POST['data'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $endereco = $_POST['endereco'];
    $cep = $_POST['cep'];
    $bairro = $_POST['bairro'];
    $telefone = $_POST['telefone'];
    $confirmPassword = $_POST['password2'];

    try {
      

      include('../backEnd\conexao.php');
      $query = $conn->prepare("INSERT INTO farmadolores.tb_clientes (CPF_CLIENTE, NOME_CLIENTE,EMAIL_CLIENTE, ENDERECO_CLIENTE, CEP_CLIENTE, TELEFONE_CLIENTE, SENHA_CLIENTE) 
      VALUES ('$cpf','$nome','$email','$endereco','$cep','$telefone','$senha')");
      $query->execute();
      
      $resultado["msg"] = '<div align="center" ><h3>Cliente Cadastrado com sucesso!</h3></div>';

      //3.verificar se usuario e senah esta no banco de dados 
      
  } catch(PDOException $e) {
      //$resultado["msg"] = "Conexão falhou: " . $e->getMessage();
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
    <link rel="stylesheet" href="../CSS/cadastrarCliente.css" />
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
        <li class="sidebarItems" id="opcaoEscolhida">
          <a href="./CadastrarCliente.php" >
            <img
              class="logoItems"
              src="../assets/img/CadastrarCliente.svg"
              alt=""
            />
            <p>Cadastrar Cliente</p>
          </a>
        </li>
        <li class="sidebarItems">
          <a href="./ExcluirCliente.php">
            <img
              class="logoItems"
              src="../assets/img/excluirCadastro.svg"
              alt=""
            />
            <p>Excluir Cliente</p>
          </a>
        </li>
        <li class="sidebarItems">
          <a href="./ConsultarEstoque.php">
            <img class="logoItems" src="../assets/img/pesquisa.svg" alt="" />
            <p>Consultar Estoque</p>
          </a>
        </li>
        <li class="sidebarItems">
          <a href="./CadastrarProduto.php">
            <img
              class="logoItems"
              src="../assets/img/cadastrarProduto.svg"
              alt=""
            />

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
            <img
              class="logoItems"
              src="../assets/img/excluirFuncionario.svg"
              alt=""
            />
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
          <p id="nameContent">Cadastrar Cliente</p>
          <form action="CadastrarCliente.php" method="POST" id="dataForm">
            <div class="datasGroups">
              <input
                type="text"
                name="cpf"
                id="cpf"
                placeholder="CPF:"
                class="leftData"
                maxlength="11"
              />
              <input
                type="text"
                name="nome"
                id="nome"
                placeholder="Nome Completo:"
              />
            </div>
            <div class="datasGroups">
              <input
                type="text"
                name="email"
                id="email"
                placeholder="Email:"
                class="leftData"
              />
              <input
                type="date"
                name="data"
                id="data"
                placeholder="Data de nascimento:"
                class="rightData"
              />
            </div>
            <div class="datasGroups">
              <input
                type="text"
                name="endereco"
                id="endereco"
                placeholder="Endereço:"
                class="leftData"
              />
              <input
                type="text"
                name="cep"
                id="cep"
                placeholder="CEP:"
                class="leftData"
              />
            </div>
            <div class="datasGroups">
              <input
                type="text"
                name="bairro"
                id="bairro"
                placeholder="Bairro:"
                class="leftData"
              />
              <input
                type="tel"
                name="telefone"
                id="telefone"
                placeholder="Telefone:"
                class="leftData"
              />
            </div>
            <div class="datasGroups">
              <input
                type="password"
                name="senha"
                id="password"
                placeholder="Senha:"
                class="rightData"
              />

              <input
                type="password"
                name="password2"
                id="password2"
                placeholder="Confirme sua senha:"
                class="rightData"
              />
            </div>

            <button type="submit" id="cadastreButton">Cadastre</button>
          </form>
        </div>
      </section>
    </main>
  </body>
</html>
<script type="application/javascript">
$("#phone").inputmask({"mask": "(999) 999-9999"});



</script>
