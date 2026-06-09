<?php require_once('cabecalho.php'); ?>
<?php require_once('conexao.php'); ?>

<?php
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
            $stmt = $pdo->prepare("INSERT INTO quartos (numero, tipo, capacidade, preco_diaria, descricao, status) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$numero, $tipo, $capacidade, $preco, $descricao, $status]);
            header("Location: quartos.php?msg=Quarto cadastrado com sucesso!");
            exit();
        } catch (PDOException $e) {
            $erro = "Erro: número de quarto já cadastrado ou dados inválidos.";
        }
    } else {
        $erro = "Preencha todos os campos obrigatórios.";
    }
}
?>

<h2>🛏 Novo Quarto</h2>
<a href="quartos.php" class="btn btn-secondary mb-3">← Voltar</a>

<?php if ($erro): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
<?php endif; ?>

<form method="post" class="card p-4 shadow-sm" style="max-width: 600px;">
    <div class="mb-3">
        <label class="form-label">Número do Quarto *</label>
        <input type="text" name="numero" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Tipo *</label>
        <select name="tipo" class="form-select" required>
            <option value="">Selecione...</option>
            <option value="Simples">Simples</option>
            <option value="Duplo">Duplo</option>
            <option value="Suite">Suite</option>
            <option value="Suite Master">Suite Master</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Capacidade (pessoas) *</label>
        <input type="number" name="capacidade" class="form-control" min="1" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Preço da Diária (R$) *</label>
        <input type="number" name="preco_diaria" class="form-control" min="0" step="0.01" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Descrição</label>
        <textarea name="descricao" class="form-control" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Status *</label>
        <select name="status" class="form-select" required>
            <option value="disponivel">Disponível</option>
            <option value="ocupado">Ocupado</option>
            <option value="manutencao">Manutenção</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
</form>

<?php require_once('rodape.php'); ?>
