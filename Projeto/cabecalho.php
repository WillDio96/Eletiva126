<?php
session_start();
if (!isset($_SESSION['acesso']) || $_SESSION['acesso'] == false) {
    header('location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Gestão de Hotéis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="principal.php">🏨 Hotel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link" href="principal.php">Início</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Quartos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="quartos.php">Listar Quartos</a></li>
                        <li><a class="dropdown-item" href="novo_quarto.php">Novo Quarto</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Hóspedes
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="hospedes.php">Listar Hóspedes</a></li>
                        <li><a class="dropdown-item" href="novo_hospede.php">Novo Hóspede</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Reservas
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="reservas.php">Listar Reservas</a></li>
                        <li><a class="dropdown-item" href="nova_reserva.php">Nova Reserva</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Estadias
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="estadias.php">Listar Estadias</a></li>
                        <li><a class="dropdown-item" href="nova_estadia.php">Nova Estadia</a></li>
                    </ul>
                </li>

            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <span class="nav-link text-light">👤 <?= htmlspecialchars($_SESSION['nome']) ?></span>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="logout.php">Sair</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
