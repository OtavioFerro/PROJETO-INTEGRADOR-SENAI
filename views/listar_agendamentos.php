<?php
require_once '../config/conexao.php';

$sql = "SELECT a.id, c.nome AS cliente, b.nome AS barbeiro, s.nome AS servico, 
               a.data_agendamento, a.hora_agendamento, a.forma_pagamento, a.status 
        FROM agendamentos a
        JOIN clientes c ON a.cliente_id = c.id
        JOIN barbeiros b ON a.barbeiro_id = b.id
        JOIN servicos s ON a.servico_id = s.id
        ORDER BY a.data_agendamento DESC, a.hora_agendamento DESC";

$resultado = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Agendamentos</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Agendamentos da Barbearia</h2>
    <a href="form_agendamento.php">Novo Agendamento</a>
    <br><br>
    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Barbeiro</th>
                <th>Serviço</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Pagamento</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($resultado && $resultado->num_rows > 0): ?>
                <?php while($row = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['cliente'] ?></td>
                        <td><?= $row['barbeiro'] ?></td>
                        <td><?= $row['servico'] ?></td>
                        <td><?= date('d/m/Y', strtotime($row['data_agendamento'])) ?></td>
                        <td><?= $row['hora_agendamento'] ?></td>
                        <td><?= $row['forma_pagamento'] ?></td>
                        <td><?= $row['status'] ?></td>
                        <td>
                            <a href="../actions/cancelar_agendamento.php?id=<?= $row['id'] ?>" onclick="return confirm('Deseja cancelar?');">Cancelar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="8">Nenhum agendamento encontrado.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>