<?php

require "DB.php";




require "../../vendor/autoload.php";
use eftec\bladeone\BladeOne;
$blade = new BladeOne("../../views", "../../cache");
/*
// Variables
$hostDB = '127.0.0.1';
$nombreDB = 'biblioteca';
$usuarioDB = 'root';
$port = '4306';
$contrasenyaDB = '';
$titulo = isset($_REQUEST['titulo']) ? $_REQUEST['titulo'] : null;
$autor = isset($_REQUEST['autor']) ? $_REQUEST['autor'] : null;
$disponible = isset($_REQUEST['disponible']) ? $_REQUEST['disponible'] : null;

// Conecta con base de datos
$hostPDO = "mysql:host=$hostDB;port=$port;dbname=$nombreDB;";
$miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);
*/

$codigo = isset($_REQUEST['codigo']) ? $_REQUEST['codigo'] : null;
$dbh = DB::conectar();

    // Obtiene codigo del libro a borrar
    $codigo = isset($_REQUEST['codigo']) ? $_REQUEST['codigo'] : null;
    // Prepara DELETE
    $miConsulta = $dbh->prepare('DELETE FROM libros WHERE codigo = :codigo');
    // Ejecuta la sentencia SQL
    $miConsulta->execute([
        'codigo' => $codigo
    ]);
    // Redireccionamos al PHP con todos los datos
    header('Location: leer.php');



?>