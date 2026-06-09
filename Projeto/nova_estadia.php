<?php require_once('cabecalho.php'); ?>
<?php require_once('conexao.php'); ?>

<?php
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reserva_id = (int) $_POST['reserva_id'];
    $quarto_id  = (int) $_POST['quarto_id'];

    if ($reserva_id && $quarto_id) {
        // Verifica se quarto já está nessa reserva
        $dup = $pdo->prepare("SELECT COUNT(*) FROM estadias WHERE reserva_id = ? AND quarto_id = ?");
        $dup->execute([$reserva_id, $quarto_id]);
        if ($dup->fetchColumn() > 0) {
            $erro = "Este quarto já está vinculado a esta reserva.";
        } else {
            $stmt = $pdo->prepare("INSERT INTO estadias (reserva_id, quarto_id) VALUES (?, ?)");
            $stmt->execute([$reserva_id, $quarto_id]);
            // Atualiza status do quarto para ocupado
            $pdo->prepare("UPDATE quartos SET status = 'ocupado' WHERE id = ?")->execute([$quarto_id]);
            header("Location: estadias.php?msg=Estadia registrada com sucesso!");
            exit();
        }
    } else {
        $erro = "Selecione a reserva e o quarto.";
    }
}

$reservas = $pdo->query("
    SELECT r.id, h.nome AS hospede_nome, r.data_inicio, r.data_fim
    FROM reservas r
    JOIN hospedes h ON h.id = r.hospede_id
    WHERE r.status = 'ativa'
    ORDER BY r.data_inicio DESC
")->fetchAll();

$quartos = $pdo->query("SELECT id, numero, tipo FROM quartos WHERE status = 'disponivel' ORDER BY numero")->fetchAll();
?>

<h2>🏠 Nova Estadia</h2>
<a href="estadias.php" class="btn btn-secondary mb-3">← Voltar</a>

<?php if ($erro): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
<?php endif; ?>

<?php if (empty($reservas)): ?>
    <div class="alert alert-warning">Não há reservas ativas. <a href="nova_reserva.php">Criar uma reserva</a>.</div>
<?php elseif (empty($quartos)): ?>
    <div class="alert alert-warning">Não há quartos disponíveis no momento.</div>
<?php else: ?>
<form method="post" class="card p-4 shadow-sm" style="max-width: 600px;">
    <div class="mb-3">
        <label class="form-label">Reserva (ativa) *</label>
        <select name="reserva_id" class="form-select" required>
            <option value="">Selecione uma reserva...</option>
            <?php foreach ($reservas as $res): ?>
                <option value="<?= $res['id'] ?>">
                    #<?= $res['id'] ?> – <?= htmlspecialchars($res['hospede_nome']) ?>
                    (<?= date('d/m/Y', strtotime($res['data_inicio'])) ?> → <?= date('d/m/Y', strtotime($res['data_fim'])) ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Quarto (disponível) *</label>
        <select name="quarto_id" class="form-select" required>
            <option value="">Selecione um quarto...</option>
            <?php foreach ($quartos as $q): ?>
                <option value="<?= $q['id'] ?>">
                    <?= htmlspecialchars($q['numero']) ?> – <?= htmlspecialchars($q['tipo']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Registrar Estadia</button>
</form>
<?php endif; ?>

<?php require_once('rodape.php'); ?>
