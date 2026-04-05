<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-3">
        <h1>Exercício 2</h1>
        <form method="post">
            <?php
            for ($i = 0; $i < 5; $i++)
                echo    '<div class="row inline-row mb-3">
                    <div class="col-md-6">
                        <label for="nome[]" class="form-label">Informe o nome: </label>
                        <input type="text" id="nome[]" name="nome[]" class="form-control" required="">
                    </div>
                    <div class="col-md-2">
                        <label for="nota1[]" class="form-label">Nota 1: </label>
                        <input type="number" id="nota1[]" name="nota1[]" class="form-control" required="">
                    </div>
                    <div class="col-md-2">
                        <label for="nota2[]" class="form-label">Nota 2: </label>
                        <input type="number" id="nota2[]" name="nota2[]" class="form-control" required="">
                    </div>
                    <div class="col-md-2">
                        <label for="nota3[]" class="form-label">Nota 3: </label>
                        <input type="number" id="nota3[]" name="nota3[]" class="form-control" required="">
                    </div>
                </div>';
            ?>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome = $_POST['nome'];
            $nota1 = $_POST['nota1'];
            $nota2 = $_POST['nota2'];
            $nota3 = $_POST['nota3'];
            $mapa = [];
            for ($i = 0; $i < 5; $i++) {
                $mapa[$nome[$i]] = ($nota1[$i] + $nota2[$i] + $nota3[$i]) / 3;
            }
            arsort($mapa);
            echo "<p>Lista de alunos ordenada pela média das notas: </p>";
            foreach ($mapa as $chave => $valor) {
                echo "<pre>Aluno: $chave \tMedia: $valor</pre>";
            }
            echo "<p></p>";
            print_r($mapa);
        }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </div>
</body>

</html>