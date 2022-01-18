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

// Comprobamso si recibimos datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Prepara UPDATE
    $miUpdate = $miPDO->prepare('UPDATE libros SET titulo = :titulo, autor = :autor, disponible = :disponible WHERE codigo = :codigo');
    // Ejecuta UPDATE con los datos
    $miUpdate->execute(
        [
            'codigo' => $codigo,
            'titulo' => $titulo,
            'autor' => $autor,
            'disponible' => $disponible
        ]
    );
    // Redireccionamos a Leer
    header('Location: leer.php');
} else {
    // Prepara SELECT
    $miConsulta = $miPDO->prepare('SELECT * FROM libros WHERE codigo = :codigo;');
    // Ejecuta consulta
    $miConsulta->execute(
        [
            "codigo" => $codigo
        ]
    );
}

// Obtiene un resultado
$libro = $miConsulta->fetch();



echo $blade->run("modificar",["libro" => $libro]);

?>