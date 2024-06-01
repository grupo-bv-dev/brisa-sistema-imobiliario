<?php 
    date_default_timezone_set('America/Manaus');
    $nome_site="Sistema_imobiliário";/* essa variavel foi criada para ser referenciada no index.php para servir como titulo*/
    //conexão local
    $usuario='root';
    $senha='';
    $banco='imobiliaria';
    $servidor='localhost';

    // conexão pdo é mais segura o try catch serve para fazer o tratamento de erro 
    
    try {
        
        $pdo= new PDO("mysql:dbname=$banco;host=$servidor","$usuario","$senha");
    } catch (\Throwable $e) {
        echo "erro ao Conectar o banco <br>";
        echo $e;
    }

?>