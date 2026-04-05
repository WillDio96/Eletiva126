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
            <?php
                for($i=0;$i<5;$i++)
                echo '<div class="row inline-row mb-3">
                    <div class="col-md-4">
                        <label for="cod[]" class="form-label">Informe o código do produto: </label>
                        <input type="number" id="cod[]" name="cod[]" class="form-control" required="">
                    </div>
                    <div class="col-md-4">
                        <label for="nome[]" class="form-label">Informe o nome do produto: </label>
                        <input type="text" id="nome[]" name="nome[]" class="form-control" required="">
                    </div>
                    <div class="col-md-4">
                        <label for="preco[]" class="form-label">Informe o preço do produto: </label>
                        <input type="number" id="preco[]" name="preco[]" class="form-control" required="" step="any">
                    </div>
                </div>';
            ?>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $cod = $_POST['cod'];
                $nome = $_POST['nome'];
                $preco = $_POST['preco'];
                $mapa = [];

                for($i=0;$i<5;$i++){
                    $mapa[$cod[$i]] = [$nome[$i], $preco[$i]];
                }

                uasort($mapa, function($a, $b){
                    return $a[0] <=> $b[0];
                });

                echo "<p>== Lista ordenada pelo nome do produto e com 10% de desconto nos preços acima de R$100 ==</p>";
                foreach($mapa as $chave => $valor){
                    if($valor[1] > 100)
                        $valor[1] = $valor[1] * 0.9;
                    echo "<pre>Cod: ".$chave." \tProduto: ".$valor[0]."\t\tPreço: ".$valor[1]."</pre>";
                }
            }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </div>
</body>

</html>