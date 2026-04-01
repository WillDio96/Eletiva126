<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 9</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-3">
        <h1>Exercício 9</h1>
        <form method="post">
            <div class="mb-3">
                <label for="frase" class="form-label">Insira uma frase: </label>
                <input type="text" id="frase" name="frase" class="form-control" required="">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $frase = $_POST['frase'];
                $FraseSemEspacoExt = trim($frase);
                $FraseSemEspaco = str_replace(" ","",$frase);

                echo "<p>frase original: $frase</p>";
                echo "<p>frase sem espaços extras no início e no fim: $FraseSemEspacoExt</p>";
                echo "<p>frase com todos os espaços removidos: $FraseSemEspaco</p>";
            }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </div>
</body>

</html>