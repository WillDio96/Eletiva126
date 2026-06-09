<?php require_once('cabecalho.php'); ?>
<?php require_once('conexao.php'); ?>

<?php
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = trim($_POST['nome']);
    $cpf      = trim($_POST['cpf']);
    $email    = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);
    $endereco = trim($_POST['endereco']);

    if ($nome && $cpf) {
        try {
            $stmt = $pdo->prepare("INSERT INTO hospedes (nome, cpf, email, telefone, endereco) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nome, $cpf, $email ?: null, $telefone ?: null, $endereco ?: null]);
            header("Location: hospedes.php?msg=Hóspede cadastrado com sucesso!");
            exit();
        } catch (PDOException $e) {
            $erro = "Erro: CPF já cadastrado no sistema.";
        }
    } else {
        $erro = "Nome e CPF são obrigatórios.";
    }
}
?>

<h2>👤 Novo Hóspede</h2>
<a href="hospedes.php" class="btn btn-secondary mb-3">← Voltar</a>

<?php if ($erro): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
<?php endif; ?>

<form method="post" class="card p-4 shadow-sm" style="max-width: 600px;">
    <div class="mb-3">
        <label class="form-label">Nome Completo *</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">CPF *</label>
        <input type="text" name="cpf" class="form-control" placeholder="000.000.000-00" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Telefone</label>
        <input type="text" name="telefone" class="form-control" placeholder="(00) 00000-0000">
    </div>
    <div class="mb-3">
        <label class="form-label">Endereço</label>
        <input type="text" name="endereco" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
</form>

<?php require_once('rodape.php'); ?>
