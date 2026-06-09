<?php require_once('cabecalho.php'); ?>
<?php require_once('conexao.php'); ?>

<?php
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
            $stmt = $pdo->prepare("INSERT INTO reservas (hospede_id, data_inicio, data_fim, status, observacoes) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$hospede_id, $data_inicio, $data_fim, $status, $observacoes ?: null]);
            header("Location: reservas.php?msg=Reserva cadastrada com sucesso!");
            exit();
        }
    } else {
        $erro = "Preencha todos os campos obrigatórios.";
    }
}

$hospedes = $pdo->query("SELECT id, nome FROM hospedes ORDER BY nome")->fetchAll();
?>

<h2>📋 Nova Reserva</h2>
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
                <option value="<?= $h['id'] ?>"><?= htmlspecialchars($h['nome']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Data de Início *</label>
        <input type="date" name="data_inicio" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Data de Fim *</label>
        <input type="date" name="data_fim" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="ativa">Ativa</option>
            <option value="cancelada">Cancelada</option>
            <option value="concluida">Concluída</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Observações</label>
        <textarea name="observacoes" class="form-control" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
</form>

<?php require_once('rodape.php'); ?>
