<?php
session_start();
if($_SESSION['logado'] == 'logado'){
  header('Location: ../minhaconta.html');
}else{
  header('Location: ../login.php');

}




?>