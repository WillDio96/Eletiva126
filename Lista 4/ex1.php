<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exercício 1</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body> 
<div class="container py-3">
<h1>Exercício 1</h1>
<form method="post">
<?php
for($i=0;$i<5;$i++)
    echo    '<div class="row">
                <div class="col-6 mb-3>
                    <label for="contato[]" class="form-label">Digite o nome do contato: </label>
                    <input type="text" id="contato[]" name="contato[]" class="form-control" required="">
                </div>
                <div class="col-6 mb-3">
                    <label for="numero[]" class="form-label">Digite o número de telefone: </label>
                    <input type="number" id="numero[]" name="numero[]" class="form-control" required="">
                </div>
            </div>';
?>
<button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $contato = $_POST['contato'];
    $numero = $_POST['numero'];
    $mapa = [];
    for($i=0;$i<5;$i++){
        if(!isset($mapa[$contato[$i]]) && !in_array($numero[$i], $mapa)){
            $mapa[$contato[$i]] = $numero[$i];
            echo "<pre>".($i+1)."° contato --\t Nome: ".$contato[$i]."\t\tNúmero: ".$numero[$i]."</pre>";
        } else {
            echo "<pre>".($i+1)."° contato --\t Nome ".$contato[$i]." ou Número ".$numero[$i]." Já cadastrado!</pre>";
        }
    }
    ksort($mapa);
    echo "<p>=== Lista ordenada pelos nomes dos contatos ===</P>";
    print_r($mapa);
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</div>
</body>
</html>