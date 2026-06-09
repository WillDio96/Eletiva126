<?php require_once('cabecalho.php'); ?>
<?php require_once('conexao.php'); ?>

<?php
$id = (int) ($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM hospedes WHERE id = ?");
$stmt->execute([$id]);
$h = $stmt->fetch();

if (!$h) {
    echo "<div class='alert alert-danger'>Hóspede não encontrado.</div>";
    require_once('rodape.php');
    exit();
}

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['excluir'])) {
    $dep = $pdo->prepare("SELECT COUNT(*) FROM reservas WHERE hospede_id = ?");
    $dep->execute([$id]);
    if ($dep->fetchColumn() > 0) {
        $erro = "Não é possível excluir: existem reservas vinculadas a este hóspede.";
    } else {
        $pdo->prepare("DELETE FROM hospedes WHERE id = ?")->execute([$id]);
        header("Location: hospedes.php?msg=Hóspede excluído com sucesso!");
        exit();
    }
}
?>

<h2>👤 Consultar Hóspede</h2>
<a href="hospedes.php" class="btn btn-secondary mb-3">← Voltar</a>

<?php if ($erro): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
<?php endif; ?>

<div class="card shadow-sm p-4 mb-3" style="max-width: 600px;">
    <p><strong>ID:</strong> <?= $h['id'] ?></p>
    <p><strong>Nome:</strong> <?= htmlspecialchars($h['nome']) ?></p>
    <p><strong>CPF:</strong> <?= htmlspecialchars($h['cpf']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($h['email'] ?: '—') ?></p>
    <p><strong>Telefone:</strong> <?= htmlspecialchars($h['telefone'] ?: '—') ?></p>
    <p><strong>Endereço:</strong> <?= htmlspecialchars($h['endereco'] ?: '—') ?></p>
    <p><strong>Cadastrado em:</strong> <?= date('d/m/Y H:i', strtotime($h['criado_em'])) ?></p>
</div>

<form method="post" onsubmit="return confirm('Tem certeza que deseja excluir este hóspede?');">
    <button type="submit" name="excluir" class="btn btn-danger">Excluir Hóspede</button>
    <a href="alterar_hospede.php?id=<?= $h['id'] ?>" class="btn btn-warning ms-2">Editar</a>
</form>

<?php require_once('rodape.php'); ?>
