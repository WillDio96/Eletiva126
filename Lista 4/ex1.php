<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-3">
        <h1>Exercício 1</h1>
        <form method="post">
            <div class="mb-3">
                <label for="valor1" class="form-label">Insira o 1º número: </label>
                <input type="number" id="valor1" name="valor1" class="form-control" required="">
            </div>
            <div class="mb-3">
                <label for="valor2" class="form-label">Insira o 2º número: </label>
                <input type="number" id="valor2" name="valor2" class="form-control" required="">
            </div>
            <div class="mb-3">
                <label for="valor3" class="form-label">Insira o 3º número: </label>
                <input type="number" id="valor3" name="valor3" class="form-control" required="">
            </div>
            <div class="mb-3">
                <label for="valor4" class="form-label">Insira o 4º número: </label>
                <input type="number" id="valor4" name="valor4" class="form-control" required="">
            </div>
            <div class="mb-3">
                <label for="valor5" class="form-label">Insira o 5º número: </label>
                <input type="number" id="valor5" name="valor5" class="form-control" required="">
            </div>
            <div class="mb-3">
                <label for="valor6" class="form-label">Insira o 6º número: </label>
                <input type="number" id="valor6" name="valor6" class="form-control" required="">
            </div>
            <div class="mb-3">
                <label for="valor7" class="form-label">Insira o 7º número: </label>
                <input type="number" id="valor7" name="valor7" class="form-control" required="">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                $valor1 = $_POST['valor1'];
                $valor2 = $_POST['valor2'];
                $valor3 = $_POST['valor3'];
                $valor4 = $_POST['valor4'];
                $valor5 = $_POST['valor5'];
                $valor6 = $_POST['valor6'];
                $valor7 = $_POST['valor7'];

                $menor = $valor1;
                $pos = 1;
                
                if($valor2 < $menor){
                    $menor = $valor2;
                    $pos = 2;
                }

                if($valor3 < $menor){
                    $menor = $valor3;
                    $pos = 3;
                }

                if($valor4 < $menor){
                    $menor = $valor4;
                    $pos = 4;
                }

                if($valor5 < $menor){
                    $menor = $valor5;
                    $pos = 5;
                }

                if($valor6 < $menor){
                    $menor = $valor6;
                    $pos = 6;
                }

                if($valor7 < $menor){
                    $menor = $valor7;
                    $pos = 7;
                }

                echo "<p>O menor valor é $menor , na $pos º posição.</p>";
            }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </div>
</body>

</html>