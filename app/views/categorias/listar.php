<?php $titulo = "Categorias"; require __DIR__ . "/../partials/header.php"; ?>

<h2>Categorias</h2>
<p><a class="boton" href="index.php?url=categorias/crearForm">Crear categoria</a></p>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($categorias as $c): ?>
        <tr>
            <td><?= htmlspecialchars($c["id"]) ?></td>
            <td><?= htmlspecialchars($c["nombre"]) ?></td>
            <td><?= htmlspecialchars($c["descripcion"]) ?></td>
            <td>
                <a href="index.php?url=categorias/editarForm&id=<?= $c["id"] ?>">Editar</a>
                <a href="index.php?url=categorias/eliminar&id=<?= $c["id"] ?>"
                   onclick="return confirm('Eliminar categoria?')">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require __DIR__ . "/../partials/footer.php"; ?>
