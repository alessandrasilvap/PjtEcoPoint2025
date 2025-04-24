<?php 
if(!isset($_SESSION)) {
  session_start();
}
session_destroy();
header('Location: app/views/home/index.php');
?>