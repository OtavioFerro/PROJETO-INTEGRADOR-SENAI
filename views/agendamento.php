<?php
require_once '../config/conexao.php';

// Busca os dados cadastrados no banco para preencher as opções do formulário
$clientes = $conexao->query("SELECT id, nome FROM clientes ORDER BY nome ASC");
$barbeiros = $conexao->query("SELECT id, nome FROM barbeiros WHERE ativo = 1 ORDER BY nome ASC");
$servicos = $conexao->query("SELECT id, nome, preco FROM servicos WHERE ativo = 1 ORDER BY nome ASC");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Agendamento</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Agendar Horário</h2>

    <form action="../actions/salvar_agendamento.php" method="POST">
        <div>
            <label>Cliente:</label>
            <select name="cliente_id" required>
                <option value="">Selecione o cliente...</option>
                <?php while($c = $clientes->fetch_assoc()): ?>
                    <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nome']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div>
            <label>Barbeiro:</label>
            <select name="barbeiro_id" required>
                <option value="">Selecione o barbeiro...</option>
                <?php while($b = $barbeiros->fetch_assoc()): ?>
                    <option value="<?= $b['id'] ?>"><?= htmlspecialchars($b['nome']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div>
            <label>Serviço:</label>
            <select name="servico_id" required>
                <option value="">Selecione o serviço...</option>
                <?php while($s = $servicos->fetch_assoc()): ?>
                    <option value="<?= $s['id'] ?>">
                        <?= htmlspecialchars($s['nome']) ?> - R$ <?= number_format($s['preco'], 2, ',', '.') ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div>
            <label>Data:</label>
            <input type="date" name="data_agendamento" required>
        </div>

        <div>
            <label>Hora:</label>
            <input type="time" name="hora_agendamento" required>
        </div>

        <div>
            <label>Forma de Pagamento:</label>
            <select name="forma_pagamento" required>
                <option value="">Selecione a forma de pagamento...</option>
                <option value="Dinheiro">Dinheiro</option>
                <option value="Pix">Pix</option>
                <option value="Cartão de Débito">Cartão de Débito</option>
                <option value="Cartão de Crédito">Cartão de Crédito</option>
            </select>
        </div>

        <br>
        <button type="submit">Salvar Agendamento</button>
        <a href="listar_agendamentos.php">Voltar</a>
    </form>
</body>
</html>