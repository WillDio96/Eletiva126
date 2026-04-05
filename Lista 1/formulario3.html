<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 5</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-3">
        <h1>Exercício 5</h1>
        <form method="post">
            <?php
                for($i=0;$i<5;$i++)
                echo '<div class="row inline-row mb-3">
                    <div class="col-md-6">
                        <label for="titulo[]" class="form-label">Informe o título do livro</label>
                        <input type="text" id="titulo[]" name="titulo[]" class="form-control" required="">
                    </div>
                    <div class="col-md-6">
                        <label for="qtde[]" class="form-label">Informe a quantidade em estoque</label>
                        <input type="number" id="qtde[]" name="qtde[]" class="form-control" required="">
                    </div>
                </div>';
            ?>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $titulo = $_POST['titulo'];
                $qtde = $_POST['qtde'];
                $mapa = [];

                for($i=0;$i<5;$i++){
                    $mapa[$titulo[$i]] = $qtde[$i];
                }

                ksort($mapa);
                echo "<p>=== Lista de livros ordenada por título ===</p>";

                foreach($mapa as $chave => $valor){
                    $aviso = "";
                    if ($valor < 5)
                        $aviso = "<span class='text-danger'> - Estoque abaixo de 5 unidades!</span>";
                    echo "<pre>Título: $chave \tQuantidade: $valor $aviso</pre>";                   
                }
            }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </div>
</body>

</html>