<?php require_once('cabecalho.php'); ?>
<?php require_once('conexao.php'); ?>

<?php
$id = (int) ($_GET['id'] ?? 0);
$stmt = $pdo->prepare("
    SELECT r.*, h.nome AS hospede_nome, h.cpf AS hospede_cpf
    FROM reservas r
    JOIN hospedes h ON h.id = r.hospede_id
    WHERE r.id = ?
");
$stmt->execute([$id]);
$r = $stmt->fetch();

if (!$r) {
    echo "<div class='alert alert-danger'>Reserva não encontrada.</div>";
    require_once('rodape.php');
    exit();
}

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['excluir'])) {
    $dep = $pdo->prepare("SELECT COUNT(*) FROM estadias WHERE reserva_id = ?");
    $dep->execute([$id]);
    if ($dep->fetchColumn() > 0) {
        $erro = "Não é possível excluir: existem estadias vinculadas a esta reserva.";
    } else {
        $pdo->prepare("DELETE FROM reservas WHERE id = ?")->execute([$id]);
        header("Location: reservas.php?msg=Reserva excluída com sucesso!");
        exit();
    }
}

// Estadias vinculadas a esta reserva
$estadias = $pdo->prepare("
    SELECT e.id, q.numero, q.tipo
    FROM estadias e
    JOIN quartos q ON q.id = e.quarto_id
    WHERE e.reserva_id = ?
");
$estadias->execute([$id]);
$estadias = $estadias->fetchAll();

$badge = match($r['status']) {
    'ativa'     => 'success',
    'cancelada' => 'danger',
    'concluida' => 'secondary',
    default     => 'secondary'
};
?>

<h2>📋 Consultar Reserva</h2>
<a href="reservas.php" class="btn btn-secondary mb-3">← Voltar</a>

<?php if ($erro): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
<?php endif; ?>

<div class="card shadow-sm p-4 mb-3" style="max-width: 600px;">
    <p><strong>ID:</strong> <?= $r['id'] ?></p>
    <p><strong>Hóspede:</strong> <?= htmlspecialchars($r['hospede_nome']) ?> (CPF: <?= htmlspecialchars($r['hospede_cpf']) ?>)</p>
    <p><strong>Data de Início:</strong> <?= date('d/m/Y', strtotime($r['data_inicio'])) ?></p>
    <p><strong>Data de Fim:</strong> <?= date('d/m/Y', strtotime($r['data_fim'])) ?></p>
    <p><strong>Status:</strong> <span class="badge bg-<?= $badge ?>"><?= ucfirst($r['status']) ?></span></p>
    <p><strong>Observações:</strong> <?= htmlspecialchars($r['observacoes'] ?: '—') ?></p>
    <p><strong>Cadastrada em:</strong> <?= date('d/m/Y H:i', strtotime($r['criado_em'])) ?></p>
</div>

<?php if (!empty($estadias)): ?>
<h5>Quartos vinculados (Estadias)</h5>
<ul class="list-group mb-3" style="max-width: 600px;">
    <?php foreach ($estadias as $e): ?>
        <li class="list-group-item">Quarto <?= htmlspecialchars($e['numero']) ?> – <?= htmlspecialchars($e['tipo']) ?></li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>

<form method="post" onsubmit="return confirm('Tem certeza que deseja excluir esta reserva?');">
    <button type="submit" name="excluir" class="btn btn-danger">Excluir Reserva</button>
    <a href="alterar_reserva.php?id=<?= $r['id'] ?>" class="btn btn-warning ms-2">Editar</a>
</form>

<?php require_once('rodape.php'); ?>
