<?php require_once('cabecalho.php'); ?>
<?php require_once('conexao.php'); ?>

<?php
$id = (int) ($_GET['id'] ?? 0);
$stmt = $pdo->prepare("
    SELECT e.id,
           e.reserva_id,
           e.quarto_id,
           e.criado_em,
           h.nome AS hospede_nome,
           h.cpf  AS hospede_cpf,
           q.numero AS quarto_numero,
           q.tipo   AS quarto_tipo,
           q.preco_diaria,
           r.data_inicio,
           r.data_fim,
           r.status AS reserva_status
    FROM estadias e
    JOIN reservas r ON r.id = e.reserva_id
    JOIN hospedes h ON h.id = r.hospede_id
    JOIN quartos  q ON q.id = e.quarto_id
    WHERE e.id = ?
");
$stmt->execute([$id]);
$e = $stmt->fetch();

if (!$e) {
    echo "<div class='alert alert-danger'>Estadia não encontrada.</div>";
    require_once('rodape.php');
    exit();
}

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['excluir'])) {
    $pdo->prepare("DELETE FROM estadias WHERE id = ?")->execute([$id]);
    // Libera o quarto
    $pdo->prepare("UPDATE quartos SET status = 'disponivel' WHERE id = ?")->execute([$e['quarto_id']]);
    header("Location: estadias.php?msg=Estadia excluída com sucesso!");
    exit();
}

// Calcula total de diárias
$inicio = new DateTime($e['data_inicio']);
$fim    = new DateTime($e['data_fim']);
$dias   = $inicio->diff($fim)->days;
$total  = $dias * $e['preco_diaria'];
?>

<h2>🏠 Consultar Estadia</h2>
<a href="estadias.php" class="btn btn-secondary mb-3">← Voltar</a>

<div class="card shadow-sm p-4 mb-3" style="max-width: 600px;">
    <p><strong>ID Estadia:</strong> <?= $e['id'] ?></p>
    <p><strong>Reserva:</strong> #<?= $e['reserva_id'] ?> (Status: <?= ucfirst($e['reserva_status']) ?>)</p>
    <p><strong>Hóspede:</strong> <?= htmlspecialchars($e['hospede_nome']) ?> – CPF: <?= htmlspecialchars($e['hospede_cpf']) ?></p>
    <p><strong>Quarto:</strong> <?= htmlspecialchars($e['quarto_numero']) ?> – <?= htmlspecialchars($e['quarto_tipo']) ?></p>
    <p><strong>Período:</strong> <?= date('d/m/Y', strtotime($e['data_inicio'])) ?> → <?= date('d/m/Y', strtotime($e['data_fim'])) ?></p>
    <p><strong>Duração:</strong> <?= $dias ?> dia(s)</p>
    <p><strong>Diária:</strong> R$ <?= number_format($e['preco_diaria'], 2, ',', '.') ?></p>
    <p><strong>Total estimado:</strong> R$ <?= number_format($total, 2, ',', '.') ?></p>
    <p><strong>Registrada em:</strong> <?= date('d/m/Y H:i', strtotime($e['criado_em'])) ?></p>
</div>

<form method="post" onsubmit="return confirm('Tem certeza que deseja excluir esta estadia? O quarto voltará a ficar disponível.');">
    <button type="submit" name="excluir" class="btn btn-danger">Excluir Estadia</button>
</form>

<?php require_once('rodape.php'); ?>
