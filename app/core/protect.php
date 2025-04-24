<?php 
if(!isset($_SESSION)) {
  session_start();
}

if(!isset($_SESSION['id'])) {
  die("[ERRO] Você não pode acessar esta página porque não está logado <br> <a href=\"app/views/home/index.php\">Entrar</a>");
}
?>