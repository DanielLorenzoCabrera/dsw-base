<?php

require "vendor/autoload.php";
require "DB.php";
use eftec\bladeone\BladeOne;
$blade = new BladeOne();

// Variables
$hostDB = '127.0.0.1';
$nombreDB = 'biblioteca';
$usuarioDB = 'root';
$port = '4306';
$contrasenyaDB = '';
$codigo = isset($_REQUEST['codigo']) ? $_REQUEST['codigo'] : null;
$titulo = isset($_REQUEST['titulo']) ? $_REQUEST['titulo'] : null;
$autor = isset($_REQUEST['autor']) ? $_REQUEST['autor'] : null;
$disponible = isset($_REQUEST['disponible']) ? $_REQUEST['disponible'] : null;

// Conecta con base de datos
$hostPDO = "mysql:host=$hostDB;port=$port;dbname=$nombreDB;";
$miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);

    // Obtiene codigo del libro a borrar
    $codigo = isset($_REQUEST['codigo']) ? $_REQUEST['codigo'] : null;
    // Prepara DELETE
    $miConsulta = $miPDO->prepare('DELETE FROM libros WHERE codigo = :codigo');
    // Ejecuta la sentencia SQL
    $miConsulta->execute([
        'codigo' => $codigo
    ]);
    // Redireccionamos al PHP con todos los datos
    header('Location: leer.php');



?>