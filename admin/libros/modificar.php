<?php

require "DB.php";
require "../../vendor/autoload.php";
use eftec\bladeone\BladeOne; // es un import
$blade = new BladeOne("../../views", "../../cache");

/*
    Para crear un objeto de BladeOne debemos de indicar la ruta a la vistas y al cache
    si no indicamos las rutas buscará los directorios en el directorio actual

*/ 


$codigo = isset($_REQUEST['codigo']) ? $_REQUEST['codigo'] : null;
$titulo = isset($_REQUEST['titulo']) ? $_REQUEST['titulo'] : null;
$autor = isset($_REQUEST['autor']) ? $_REQUEST['autor'] : null;
$disponible = isset($_REQUEST['disponible']) ? $_REQUEST['disponible'] : null;

$dbh = DB::conectar();

// Comprobamso si recibimos datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Prepara UPDATE
    $miUpdate = $dbh->prepare('UPDATE libros SET titulo = :titulo, autor = :autor, disponible = :disponible WHERE codigo = :codigo');
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
    $miConsulta = $dbh->prepare('SELECT * FROM libros WHERE codigo = :codigo;');
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