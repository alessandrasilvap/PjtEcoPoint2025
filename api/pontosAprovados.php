<?php

require_once '../DAO/conexao.php';

$pdo = Conexao::getConexao();
$stmt = $pdo->query("SELECT nome, latitude, longitude FROM pontos_coleta WHERE situacao = 'aprovado'");
$pontos = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($pontos);

?>