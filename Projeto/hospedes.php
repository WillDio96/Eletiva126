<?php require_once('cabecalho.php'); ?>
<?php require_once('conexao.php'); ?>

<h2>👤 Hóspedes</h2>
<a href="novo_hospede.php" class="btn btn-success mb-3">+ Novo Hóspede</a>

<?php if (isset($_GET['msg'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($_GET['msg']) ?></div>
<?php endif; ?>

<table class="table table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $hospedes = $pdo->query("SELECT * FROM hospedes ORDER BY nome")->fetchAll();
        foreach ($hospedes as $h):
        ?>
        <tr>
            <td><?= $h['id'] ?></td>
            <td><?= htmlspecialchars($h['nome']) ?></td>
            <td><?= htmlspecialchars($h['cpf']) ?></td>
            <td><?= htmlspecialchars($h['email'] ?: '—') ?></td>
            <td><?= htmlspecialchars($h['telefone'] ?: '—') ?></td>
            <td class="d-flex gap-2">
                <a href="alterar_hospede.php?id=<?= $h['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="consultar_hospede.php?id=<?= $h['id'] ?>" class="btn btn-sm btn-info">Consultar</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php if (empty($hospedes)): ?>
            <tr><td colspan="6" class="text-center text-muted">Nenhum hóspede cadastrado.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php require_once('rodape.php'); ?>
