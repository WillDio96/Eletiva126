<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 15</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-3">
        <h1>Exercício 15</h1>
        <form method="post">
            <div class="mb-3">
                <label for="peso" class="form-label">Digite seu peso (em quilos):</label>
                <input type="text" id="peso" name="peso" class="form-control" required="">
            </div>
            <div class="mb-3">
                <label for="alt" class="form-label">Digite sua altura (em metros):</label>
                <input type="text" id="alt" name="alt" class="form-control" required="">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $peso = $_POST["peso"];
            $alt = $_POST["alt"];
            $imc = $peso / ($alt ** 2);
            echo "<p>O seu Índice de Massa Corporal é igual a: $imc.</p>";
        }
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
            crossorigin="anonymous"></script>
    </div>
</body>

</html>