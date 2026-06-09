<?php require_once('cabecalho.php'); ?>
<?php require_once('conexao.php'); ?>

<h2>🏠 Estadias</h2>
<a href="nova_estadia.php" class="btn btn-success mb-3">+ Nova Estadia</a>

<?php if (isset($_GET['msg'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($_GET['msg']) ?></div>
<?php endif; ?>

<table class="table table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Reserva</th>
            <th>Hóspede</th>
            <th>Quarto</th>
            <th>Período</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $estadias = $pdo->query("
            SELECT e.id,
                   e.reserva_id,
                   h.nome AS hospede_nome,
                   q.numero AS quarto_numero,
                   q.tipo AS quarto_tipo,
                   r.data_inicio,
                   r.data_fim
            FROM estadias e
            JOIN reservas r ON r.id = e.reserva_id
            JOIN hospedes h ON h.id = r.hospede_id
            JOIN quartos  q ON q.id = e.quarto_id
            ORDER BY r.data_inicio DESC
        ")->fetchAll();
        foreach ($estadias as $e):
        ?>
        <tr>
            <td><?= $e['id'] ?></td>
            <td>#<?= $e['reserva_id'] ?></td>
            <td><?= htmlspecialchars($e['hospede_nome']) ?></td>
            <td><?= htmlspecialchars($e['quarto_numero']) ?> – <?= htmlspecialchars($e['quarto_tipo']) ?></td>
            <td><?= date('d/m/Y', strtotime($e['data_inicio'])) ?> → <?= date('d/m/Y', strtotime($e['data_fim'])) ?></td>
            <td class="d-flex gap-2">
                <a href="consultar_estadia.php?id=<?= $e['id'] ?>" class="btn btn-sm btn-info">Consultar</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php if (empty($estadias)): ?>
            <tr><td colspan="6" class="text-center text-muted">Nenhuma estadia cadastrada.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php require_once('rodape.php'); ?>
