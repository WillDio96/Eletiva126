<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-3">
        <h1>Exercício 4</h1>
        <form method="post">
            <?php
            for($i=0;$i<5;$i++)
                echo '<div class="row">
                    <div class="mb-3 col-6">
                        <label for="nome[]" class="form-label">Informe o nome do item</label>
                        <input type="text" id="nome[]" name="nome[]" class="form-control" required="">
                    </div>
                    <div class="mb-3 col-6">
                        <label for="preco[]" class="form-label">Informe o preço do item</label>
                        <input type="number" id="preco[]" name="preco[]" class="form-control" required="">
                    </div>
                </div>';
            ?>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $nome = $_POST['nome'];
                $preco = $_POST['preco'];
                $mapa = [];

                for($i=0;$i<5;$i++){
                    $mapa[$nome[$i]] = $preco[$i] * 1.15;
                }

                asort($mapa);
                echo "<p>Lista ordenada pelos preços com imposto de 15%</p>";
                foreach($mapa as $chave => $valor){
                    echo "<pre>Nome: $chave \tPreço: $valor</pre>";
                }
            }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </div>
</body>

</html>