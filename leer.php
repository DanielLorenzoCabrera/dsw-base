<?php

    require "vendor/autoload.php";
    use eftec\bladeone\BladeOne;
    $blade = new BladeOne();

    // Parámetros de la base de datos.
    $host = '127.0.0.1';
    $port = '4306';
    $name = 'biblioteca';
    $user = 'root';
    $password = '';

    // Conecta con base de datos
    $dns= "mysql:host=$host;port=$port;dbname=$name;";
    try {
    $dbh = new PDO($dns, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
    echo "Error: ".$e->getMessage();
    exit (1); // o die (mensaje)
    }

    // Prepara SELECT
    $stmt = $dbh->prepare('SELECT * FROM libros');
    // Ejecuta consulta
    $stmt->execute();
    $datos = $stmt->fetchAll();


    echo $blade->run("leer", ["datos" => $datos]);

   


?>


