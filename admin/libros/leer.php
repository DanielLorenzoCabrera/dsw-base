<?php

    require "../../vendor/autoload.php";
    use eftec\bladeone\BladeOne;
    $blade = new BladeOne("../../views", "../../cache");

    //require 'DB.php';
    use Config\DB;
    /*// Parámetros de la base de datos.
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
    }*/

    $dbh = DB::conectar();


    if (isset($_POST["buscar"])) {
        var_dump($_POST);
        $valor = "%".$_POST["busqueda"]."%";
        $sql= "SELECT * FROM libros WHERE titulo LIKE :titulo";

        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(":titulo", $valor);
    } else {
        $sql = 'SELECT * FROM libros';
        $stmt = $dbh->prepare($sql);
    }

    $stmt->execute();
    $datos = $stmt->fetchAll();

    echo $blade->run("leer", ["datos" => $datos]);

   


?>


