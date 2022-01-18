<?php

namespace Config; // establecemos el nombre del espacio

use PDO; //indicamos esto porque estamos usando el espacio PDO


class DB {
    // Parámetros de la base de datos.
    const host='127.0.0.1';
    const port = '4306';
    const name = 'biblioteca';
    const user = 'root';
    const password = '';

    public static function conectar() {
        // Conecta con base de datos
        $dns= "mysql:host=".self::host.";port=".self::port.";dbname=".self::name.";";
        $dbh = null;

        try {
            $dbh = new PDO($dns, self::user, self::password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error: ".$e->getMessage();
            exit (1); // o die (mensaje)
        }
        return $dbh;
    }
}







?>