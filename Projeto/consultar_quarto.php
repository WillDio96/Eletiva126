<?php require_once('cabecalho.php'); ?>
<?php require_once('conexao.php'); ?>

<?php
$id = (int) ($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM quartos WHERE id = ?");
$stmt->execute([$id]);
$q = $stmt->fetch();

if (!$q) {
    echo "<div class='alert alert-danger'>Quarto não encontrado.</div>";
    require_once('rodape.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['excluir'])) {
    // Verifica se há estadias vinculadas
    $dep = $pdo->prepare("SELECT COUNT(*) FROM estadias WHERE quarto_id = ?");
    $dep->execute([$id]);
    if ($dep->fetchColumn() > 0) {
        $erro = "Não é possível excluir: existem estadias vinculadas a este quarto.";
    } else {
        $pdo->prepare("DELETE FROM quartos WHERE id = ?")->execute([$id]);
        header("Location: quartos.php?msg=Quarto excluído com sucesso!");
        exit();
    }
}

$badge = match($q['status']) {
    'disponivel' => 'success',
    'ocupado'    => 'danger',
    'manutencao' => 'warning',
    default      => 'secondary'
};
?>

<h2>🛏 Consultar Quarto</h2>
<a href="quartos.php" class="btn btn-secondary mb-3">← Voltar</a>

<?php if (!empty($erro)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
<?php endif; ?>

<div class="card shadow-sm p-4 mb-3" style="max-width: 600px;">
    <p><strong>ID:</strong> <?= $q['id'] ?></p>
    <p><strong>Número:</strong> <?= htmlspecialchars($q['numero']) ?></p>
    <p><strong>Tipo:</strong> <?= htmlspecialchars($q['tipo']) ?></p>
    <p><strong>Capacidade:</strong> <?= $q['capacidade'] ?> pessoa(s)</p>
    <p><strong>Diária:</strong> R$ <?= number_format($q['preco_diaria'], 2, ',', '.') ?></p>
    <p><strong>Descrição:</strong> <?= htmlspecialchars($q['descricao'] ?: '—') ?></p>
    <p><strong>Status:</strong> <span class="badge bg-<?= $badge ?>"><?= ucfirst($q['status']) ?></span></p>
    <p><strong>Cadastrado em:</strong> <?= date('d/m/Y H:i', strtotime($q['criado_em'])) ?></p>
</div>

<form method="post" onsubmit="return confirm('Tem certeza que deseja excluir este quarto?');">
    <button type="submit" name="excluir" class="btn btn-danger">Excluir Quarto</button>
    <a href="alterar_quarto.php?id=<?= $q['id'] ?>" class="btn btn-warning ms-2">Editar</a>
</form>

<?php require_once('rodape.php'); ?>
