<?php 
try {
    $hostname = "farmadolores.mysql.dbaas.com.br";
    $dbname = "farmadolores";
    $username = "farmadolores";
    $pw = "Li37CTmmpYw3z#";
    $conn= new PDO ("mysql:host=$hostname;Database=$dbname",$username, $pw);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //echo 'conexao realizada com sucesso!';
  } catch (PDOException $e) {
        echo "Erro de Conexão " . $e->getMessage() . "\n";
        exit;
  }
?>