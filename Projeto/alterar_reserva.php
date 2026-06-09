<?php require_once('cabecalho.php'); ?>
<?php require_once('conexao.php'); ?>

<?php
$id = (int) ($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM reservas WHERE id = ?");
$stmt->execute([$id]);
$r = $stmt->fetch();

if (!$r) {
    echo "<div class='alert alert-danger'>Reserva não encontrada.</div>";
    require_once('rodape.php');
    exit();
}

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hospede_id  = (int) $_POST['hospede_id'];
    $data_inicio = $_POST['data_inicio'];
    $data_fim    = $_POST['data_fim'];
    $status      = $_POST['status'];
    $observacoes = trim($_POST['observacoes']);

    if ($hospede_id && $data_inicio && $data_fim) {
        if ($data_fim <= $data_inicio) {
            $erro = "A data de fim deve ser posterior à data de início.";
        } else {
            $stmt = $pdo->prepare("UPDATE reservas SET hospede_id=?, data_inicio=?, data_fim=?, status=?, observacoes=? WHERE id=?");
            $stmt->execute([$hospede_id, $data_inicio, $data_fim, $status, $observacoes ?: null, $id]);
            header("Location: reservas.php?msg=Reserva atualizada com sucesso!");
            exit();
        }
    } else {
        $erro = "Preencha todos os campos obrigatórios.";
    }
}

$hospedes = $pdo->query("SELECT id, nome FROM hospedes ORDER BY nome")->fetchAll();
?>

<h2>📋 Editar Reserva</h2>
<a href="reservas.php" class="btn btn-secondary mb-3">← Voltar</a>

<?php if ($erro): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
<?php endif; ?>

<form method="post" class="card p-4 shadow-sm" style="max-width: 600px;">
    <div class="mb-3">
        <label class="form-label">Hóspede *</label>
        <select name="hospede_id" class="form-select" required>
            <option value="">Selecione um hóspede...</option>
            <?php foreach ($hospedes as $h): ?>
                <option value="<?= $h['id'] ?>" <?= $h['id'] == $r['hospede_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($h['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Data de Início *</label>
        <input type="date" name="data_inicio" class="form-control" value="<?= $r['data_inicio'] ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Data de Fim *</label>
        <input type="date" name="data_fim" class="form-control" value="<?= $r['data_fim'] ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <?php foreach (['ativa','cancelada','concluida'] as $s): ?>
                <option value="<?= $s ?>" <?= $r['status'] === $s ? 'selected' : '' ?>><?= ucfirst($s) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Observações</label>
        <textarea name="observacoes" class="form-control" rows="3"><?= htmlspecialchars($r['observacoes'] ?? '') ?></textarea>
    </div>
    <button type="submit" class="btn btn-warning">Atualizar</button>
</form>

<?php require_once('rodape.php'); ?>
