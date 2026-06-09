<?php require_once('cabecalho.php'); ?>
<?php require_once('conexao.php'); ?>

<h2>🛏 Quartos</h2>
<a href="novo_quarto.php" class="btn btn-success mb-3">+ Novo Quarto</a>

<?php if (isset($_GET['msg'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($_GET['msg']) ?></div>
<?php endif; ?>

<table class="table table-hover table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Número</th>
            <th>Tipo</th>
            <th>Capacidade</th>
            <th>Diária (R$)</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $quartos = $pdo->query("SELECT * FROM quartos ORDER BY numero")->fetchAll();
        foreach ($quartos as $q):
            $badge = match($q['status']) {
                'disponivel'  => 'success',
                'ocupado'     => 'danger',
                'manutencao'  => 'warning',
                default       => 'secondary'
            };
        ?>
        <tr>
            <td><?= $q['id'] ?></td>
            <td><?= htmlspecialchars($q['numero']) ?></td>
            <td><?= htmlspecialchars($q['tipo']) ?></td>
            <td><?= $q['capacidade'] ?> pessoa(s)</td>
            <td>R$ <?= number_format($q['preco_diaria'], 2, ',', '.') ?></td>
            <td><span class="badge bg-<?= $badge ?>"><?= ucfirst($q['status']) ?></span></td>
            <td class="d-flex gap-2">
                <a href="alterar_quarto.php?id=<?= $q['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="consultar_quarto.php?id=<?= $q['id'] ?>" class="btn btn-sm btn-info">Consultar</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php if (empty($quartos)): ?>
            <tr><td colspan="7" class="text-center text-muted">Nenhum quarto cadastrado.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php require_once('rodape.php'); ?>
