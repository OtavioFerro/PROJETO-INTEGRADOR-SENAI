<?php
require_once '../config/conexao.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conexao->prepare("UPDATE agendamentos SET status = 'Cancelado' WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: ../views/listar_agendamentos.php");
exit();
?>