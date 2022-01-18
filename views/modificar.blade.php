<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear - CRUD PHP</title>
</head>
<body>
    <form method="post">
        <p>
            <label for="titulo">Titulo</label>
            <input id="titulo" type="text" name="titulo" value="<?= $libro['titulo'] ?>">
        </p>
        <p>
            <label for="autor">Autor</label>
            <input id="autor" type="text" name="autor" value="<?= $libro['autor'] ?>">
        </p>
        <p>
            <div>¿Disponible?</div>
            <input id="si-disponible" type="radio" name="disponible" value="1"<?= $libro['disponible'] ? ' checked' : '' ?>> <label for="si-disponible">Si</label>
            <input id="no-disponible" type="radio" name="disponible" value="0"<?= !$libro['disponible'] ? ' checked' : '' ?>> <label for="no-disponible">No</label>
        </p>
        <p>
            <input type="hidden" name="codigo" value="<?= $libro['codigo'] ?>">
            <input type="submit" value="Modificar">
        </p>
    </form>
</body>
</html>