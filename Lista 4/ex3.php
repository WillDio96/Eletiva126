<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-3">
        <h1>Exercício 3</h1>
        <form method="post">
            <div class="mb-3">
                <label for="numero1" class="form-label">Digite o primeiro valor:</label>
                <input type="number" id="numero1" name="numero1" class="form-control" required="">
            </div>
            <div class="mb-3">
                <label for="numero2" class="form-label">Digite o segundo valor:</label>
                <input type="number" id="numero2" name="numero2" class="form-control" required="">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $numero1 = $_POST["numero1"];
            $numero2 = $_POST["numero2"];
            if ($numero1 > $numero2)
                echo "<p>$numero2 $numero1</p>";
            elseif ($numero1 < $numero2)
                echo "<p>$numero1 $numero2</p>";
            else
                echo "<p>Números iguais: $numero1.</p>";
        }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </div>
</body>

</html>