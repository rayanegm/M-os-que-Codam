<?php

$palavras = [
    "html",
    "css",
    "php",
    "java"
];

$busca = strtolower($_GET['busca']);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="style.css">

    <title>Resultado</title>
</head>

<body>

<div class="resultado">

<?php

foreach($palavras as $palavra){

    if(strpos($palavra, $busca) !== false){

        echo "
        <a class='palavra' href='palavra.php?nome=$palavra'>
            $palavra
        </a>
        ";
    }

}

?>

</div>

</body>
</html>