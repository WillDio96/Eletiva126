<?php require_once('cabecalho.php'); ?>
<?php require_once('conexao.php'); ?>

<h2>Seja bem-vindo, <?= htmlspecialchars($_SESSION['nome']) ?>!</h2>
<p class="text-muted">Sistema de Gestão de Hotéis</p>
<hr>

<?php
$totalQuartos  = $pdo->query("SELECT COUNT(*) FROM quartos")->fetchColumn();
$totalHospedes = $pdo->query("SELECT COUNT(*) FROM hospedes")->fetchColumn();
$totalReservas = $pdo->query("SELECT COUNT(*) FROM reservas WHERE status = 'ativa'")->fetchColumn();
$totalEstadias = $pdo->query("SELECT COUNT(*) FROM estadias")->fetchColumn();
?>

<div class="row g-4 mt-1">
    <div class="col-md-3">
        <div class="card text-white bg-primary shadow">
            <div class="card-body">
                <h5 class="card-title">🛏 Quartos</h5>
                <p class="card-text fs-2"><?= $totalQuartos ?></p>
                <a href="quartos.php" class="btn btn-light btn-sm">Ver todos</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success shadow">
            <div class="card-body">
                <h5 class="card-title">👤 Hóspedes</h5>
                <p class="card-text fs-2"><?= $totalHospedes ?></p>
                <a href="hospedes.php" class="btn btn-light btn-sm">Ver todos</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning shadow">
            <div class="card-body">
                <h5 class="card-title">📋 Reservas Ativas</h5>
                <p class="card-text fs-2"><?= $totalReservas ?></p>
                <a href="reservas.php" class="btn btn-light btn-sm">Ver todas</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info shadow">
            <div class="card-body">
                <h5 class="card-title">🏠 Estadias</h5>
                <p class="card-text fs-2"><?= $totalEstadias ?></p>
                <a href="estadias.php" class="btn btn-light btn-sm">Ver todas</a>
            </div>
        </div>
    </div>
</div>

<?php require_once('rodape.php'); ?>
