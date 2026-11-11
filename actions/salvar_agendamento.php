<?php
require_once '../config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente_id      = $_POST['cliente_id'];
    $barbeiro_id     = $_POST['barbeiro_id'];
    $servico_id      = $_POST['servico_id'];
    $data_agendamento = $_POST['data_agendamento'];
    $hora_agendamento = $_POST['hora_agendamento'];
    $forma_pagamento  = $_POST['forma_pagamento'];

    // Insere o agendamento no banco de dados usando Prepared Statement para segurança
    $stmt = $conexao->prepare("INSERT INTO agendamentos (cliente_id, barbeiro_id, servico_id, data_agendamento, hora_agendamento, forma_pagamento) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiisss", $cliente_id, $barbeiro_id, $servico_id, $data_agendamento, $hora_agendamento, $forma_pagamento);
    
    $stmt->execute();
    $stmt->close();
}

// Redireciona para a listagem (views/listar_agendamentos.php)
header("Location: ../views/listar_agendamentos.php");
exit();
?>