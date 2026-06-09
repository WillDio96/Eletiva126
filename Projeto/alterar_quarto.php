<?php require_once('cabecalho.php'); ?>
<?php require_once('conexao.php'); ?>

<?php
$id = (int) ($_GET['id'] ?? 0);
$quarto = $pdo->prepare("SELECT * FROM quartos WHERE id = ?");
$quarto->execute([$id]);
$q = $quarto->fetch();

if (!$q) {
    echo "<div class='alert alert-danger'>Quarto não encontrado.</div>";
    require_once('rodape.php');
    exit();
}

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero     = trim($_POST['numero']);
    $tipo       = trim($_POST['tipo']);
    $capacidade = (int) $_POST['capacidade'];
    $preco      = (float) str_replace(',', '.', $_POST['preco_diaria']);
    $descricao  = trim($_POST['descricao']);
    $status     = $_POST['status'];

    if ($numero && $tipo && $capacidade > 0 && $preco > 0) {
        try {
            $stmt = $pdo->prepare("UPDATE quartos SET numero=?, tipo=?, capacidade=?, preco_diaria=?, descricao=?, status=? WHERE id=?");
            $stmt->execute([$numero, $tipo, $capacidade, $preco, $descricao, $status, $id]);
            header("Location: quartos.php?msg=Quarto atualizado com sucesso!");
            exit();
        } catch (PDOException $e) {
            $erro = "Erro ao atualizar: número de quarto já em uso.";
        }
    } else {
        $erro = "Preencha todos os campos obrigatórios.";
    }
}
?>

<h2>🛏 Editar Quarto</h2>
<a href="quartos.php" class="btn btn-secondary mb-3">← Voltar</a>

<?php if ($erro): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
<?php endif; ?>

<form method="post" class="card p-4 shadow-sm" style="max-width: 600px;">
    <div class="mb-3">
        <label class="form-label">Número do Quarto *</label>
        <input type="text" name="numero" class="form-control" value="<?= htmlspecialchars($q['numero']) ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Tipo *</label>
        <select name="tipo" class="form-select" required>
            <?php foreach (['Simples','Duplo','Suite','Suite Master'] as $t): ?>
                <option value="<?= $t ?>" <?= $q['tipo'] === $t ? 'selected' : '' ?>><?= $t ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Capacidade (pessoas) *</label>
        <input type="number" name="capacidade" class="form-control" min="1" value="<?= $q['capacidade'] ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Preço da Diária (R$) *</label>
        <input type="number" name="preco_diaria" class="form-control" min="0" step="0.01" value="<?= $q['preco_diaria'] ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Descrição</label>
        <textarea name="descricao" class="form-control" rows="3"><?= htmlspecialchars($q['descricao']) ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Status *</label>
        <select name="status" class="form-select" required>
            <?php foreach (['disponivel','ocupado','manutencao'] as $s): ?>
                <option value="<?= $s ?>" <?= $q['status'] === $s ? 'selected' : '' ?>><?= ucfirst($s) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-warning">Atualizar</button>
</form>

<?php require_once('rodape.php'); ?>
