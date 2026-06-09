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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = trim($_POST['nome']);
    $cpf      = trim($_POST['cpf']);
    $email    = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);
    $endereco = trim($_POST['endereco']);

    if ($nome && $cpf) {
        try {
            $stmt = $pdo->prepare("UPDATE hospedes SET nome=?, cpf=?, email=?, telefone=?, endereco=? WHERE id=?");
            $stmt->execute([$nome, $cpf, $email ?: null, $telefone ?: null, $endereco ?: null, $id]);
            header("Location: hospedes.php?msg=Hóspede atualizado com sucesso!");
            exit();
        } catch (PDOException $e) {
            $erro = "Erro: CPF já em uso por outro hóspede.";
        }
    } else {
        $erro = "Nome e CPF são obrigatórios.";
    }
}
?>

<h2>👤 Editar Hóspede</h2>
<a href="hospedes.php" class="btn btn-secondary mb-3">← Voltar</a>

<?php if ($erro): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
<?php endif; ?>

<form method="post" class="card p-4 shadow-sm" style="max-width: 600px;">
    <div class="mb-3">
        <label class="form-label">Nome Completo *</label>
        <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($h['nome']) ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">CPF *</label>
        <input type="text" name="cpf" class="form-control" value="<?= htmlspecialchars($h['cpf']) ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($h['email'] ?? '') ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Telefone</label>
        <input type="text" name="telefone" class="form-control" value="<?= htmlspecialchars($h['telefone'] ?? '') ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Endereço</label>
        <input type="text" name="endereco" class="form-control" value="<?= htmlspecialchars($h['endereco'] ?? '') ?>">
    </div>
    <button type="submit" class="btn btn-warning">Atualizar</button>
</form>

<?php require_once('rodape.php'); ?>
