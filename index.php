<?php
session_start();

  if(isset($_POST['user']) && isset($_POST['password'])) {
    //1.pega os valores do formulario
    $usuario = $_POST['user'];
    $senha = $_POST['password'];

    try {
        include('backEnd\conexao.php');

        $query2 = $conn->prepare(
          "SELECT *
          FROM farmadolores.tb_acessos 
          LEFT JOIN farmadolores.tb_funcionarios
          ON farmadolores.tb_acessos.MATRICULA_FUNCIONARIO = farmadolores.tb_funcionarios.MATRICULA_FUNCIONARIO
          WHERE farmadolores.tb_acessos.MATRICULA_FUNCIONARIO=:MATRICULA_FUNCIONARIO and farmadolores.tb_acessos.SENHA_FUNCIONARIO=:SENHA_FUNCIONARIO;
          ");
        $query2 ->bindParam(':MATRICULA_FUNCIONARIO',$usuario, PDO::PARAM_INT);
        $query2 ->bindParam(':SENHA_FUNCIONARIO', $senha, PDO::PARAM_STR);
        $query2->execute();

        //3.verificar se usuario e senah esta no banco de dados 

        $resultAdmin = $query2-> fetchAll();
        $qtd_usuariosAdmin = count($resultAdmin);
        

        if($qtd_usuariosAdmin == 1){
            //TODO substituido pelo redirecionamento   
            $_SESSION['logadoAdmin'] = 'logadoAdmin';
            $_SESSION['matricula'] = $usuario;

            header('Location: HTML/Home.php');
            
        }else if($qtd_usuariosAdmin == 0){
            $resultado["msg"] = "<div align='center' ><h3>Usu&aacute;rio e/ou senha inv&aacute;lido(s)!</h3></div>";
            $resultado["cod"] = 0;
        }  
       
    } catch(PDOException $e) {
        echo "Conexão falhou: " . $e->getMessage();
        }
  }
 
?>

<!DOCTYPE html>
<html lang="pt-Br">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="CSS/loginAdmin.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
      rel="stylesheet"
    />
    <title>Login</title>
  </head>
  <body>
    
    <main>
      <div id="containnerBox">
        <div id="formLogin" class="form">
          <h3 class="mainTextForm">Acesso ao Painel Administrativo</h3>
          <p class="subTextForm">Faça seu login para acessar</p>
          <?php if(isset($resultado) && ($resultado["cod"] == 0)): ?>
            <div class="alert alert-danger">
                <?php echo $resultado["msg"]; ?>
            </div>
          <?php endif;?>
          <form action="index.php" method="POST">
            <label for="user">Matricula*</label>
            <input type="text" name="user" id="user" class="inputData" autocomplete="off" required/>

            <label for="password">Senha*</label>
            <input
              type="password"
              name="password"
              id="password"
              class="inputData"
              autocomplete="off"
              required
            />

            <div class="subLink">
              <a href="#">Esqueceu a senha?</a>
              <a href="#">Reenviar email?</a>
            </div>

            <button type="submit" id="loginButton" type="submit">Faça seu login</button type="submit">
          </form>
          
        </div>
      </div>
    </main>
  </body>
</html>
