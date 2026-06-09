<?php require_once('cabecalho.php'); ?>
<?php require_once('conexao.php'); ?>

<h2>📋 Reservas</h2>
<a href="nova_reserva.php" class="btn btn-success mb-3">+ Nova Reserva</a>

<?php if (isset($_GET['msg'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($_GET['msg']) ?></div>
<?php endif; ?>

<table class="table table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Hóspede</th>
            <th>Data Início</th>
            <th>Data Fim</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $reservas = $pdo->query("
            SELECT r.*, h.nome AS hospede_nome
            FROM reservas r
            JOIN hospedes h ON h.id = r.hospede_id
            ORDER BY r.data_inicio DESC
        ")->fetchAll();
        foreach ($reservas as $r):
            $badge = match($r['status']) {
                'ativa'      => 'success',
                'cancelada'  => 'danger',
                'concluida'  => 'secondary',
                default      => 'secondary'
            };
        ?>
        <tr>
            <td><?= $r['id'] ?></td>
            <td><?= htmlspecialchars($r['hospede_nome']) ?></td>
            <td><?= date('d/m/Y', strtotime($r['data_inicio'])) ?></td>
            <td><?= date('d/m/Y', strtotime($r['data_fim'])) ?></td>
            <td><span class="badge bg-<?= $badge ?>"><?= ucfirst($r['status']) ?></span></td>
            <td class="d-flex gap-2">
                <a href="alterar_reserva.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="consultar_reserva.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-info">Consultar</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php if (empty($reservas)): ?>
            <tr><td colspan="6" class="text-center text-muted">Nenhuma reserva cadastrada.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php require_once('rodape.php'); ?>
