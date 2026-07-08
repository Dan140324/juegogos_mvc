<?php
// Cabecera comun a todas las vistas. Muestra distinta navegacion segun
// si hay sesion iniciada o no. $titulo puede definirse antes de incluir.
$hayLogin = isset($_SESSION["id_usuario"]);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($titulo) ? htmlspecialchars($titulo) : "Juegogos" ?></title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <h1>Juegogos</h1>
        <nav>
            <a href="index.php?url=home/index">Inicio</a>
            <?php if ($hayLogin): ?>
                <a href="index.php?url=puntajes/listar">Puntajes</a>
                <a href="index.php?url=categorias/listar">Categorias</a>
                <a href="index.php?url=juegos/listar">Juegos</a>
                <a href="index.php?url=resenas/listar">Reseñas</a>
                <a href="index.php?url=usuarios/listar">Usuarios</a>
                <a href="index.php?url=auth/logout">Salir (<?= htmlspecialchars($_SESSION["usuario"]) ?>)</a>
            <?php else: ?>
                <a href="index.php?url=auth/login">Ingresar</a>
            <?php endif; ?>
        </nav>
    </header>
    <main>
