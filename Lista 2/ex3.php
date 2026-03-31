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
                <label for="palavra1" class="form-label">Digite a primeira palavra: </label>
                <input type="text" id="palavra1" name="palavra1" class="form-control" required="">
            </div>
            <div class="mb-3">
                <label for="palavra2" class="form-label">Digite a segunda palavra: </label>
                <input type="text" id="palavra2" name="palavra2" class="form-control" required="">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $p1 = $_POST['palavra1'];
                $p2 = $_POST['palavra2'];
                if (str_contains($p1, $p2)) {
                    echo "<p>A palavra $p2 está contida na palavra $p1 !</p>";
                } else {
                    echo "<p>A palavra $p2 não está contida na palavra $p1 !</p>";
                }
            }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </div>
</body>

</html>