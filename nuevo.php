<?php


require "vendor/autoload.php";
require "DB.php";
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


// Comprobamos si recibimos datos por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recogemos variables
    $titulo = isset($_REQUEST['titulo']) ? $_REQUEST['titulo'] : null;
    $autor = isset($_REQUEST['autor']) ? $_REQUEST['autor'] : null;
    $disponible = isset($_REQUEST['disponible']) ? $_REQUEST['disponible'] : null;
    // Prepara INSERT
    $miInsert = $dbh->prepare('INSERT INTO libros (titulo, autor, disponible) VALUES (:titulo, :autor, :disponible)');
    // Ejecuta INSERT con los datos
    $miInsert->execute(
        array(
            'titulo' => $titulo,
            'autor' => $autor,
            'disponible' => $disponible
        )
    );
    // Redireccionamos a Leer
    header('Location: leer.php');
}


echo $blade->run("nuevo",[]);
?>