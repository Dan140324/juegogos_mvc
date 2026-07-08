<?php $titulo = "Juegos"; require __DIR__ . "/../partials/header.php"; ?>

<h2>Juegos</h2>
<p><a class="boton" href="index.php?url=juegos/crearForm">Crear juego</a></p>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>Categoria</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($juegos as $j): ?>
        <tr>
            <td><?= htmlspecialchars($j["id"]) ?></td>
            <td><?= htmlspecialchars($j["nombre"]) ?></td>
            <td><?= htmlspecialchars($j["descripcion"]) ?></td>
            <td><?= htmlspecialchars($j["nombre_categoria"] ?? "Sin categoria") ?></td>
            <td>
                <a href="index.php?url=juegos/editarForm&id=<?= $j["id"] ?>">Editar</a>
                <a href="index.php?url=juegos/eliminar&id=<?= $j["id"] ?>"
                   onclick="return confirm('Eliminar juego?')">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require __DIR__ . "/../partials/footer.php"; ?>
