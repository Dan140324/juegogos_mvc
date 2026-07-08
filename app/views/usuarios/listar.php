<?php $titulo = "Usuarios"; require __DIR__ . "/../partials/header.php"; ?>

<h2>Usuarios</h2>
<p><a class="boton" href="index.php?url=usuarios/crearForm">Crear usuario</a></p>

<table>
    <tr>
        <th>ID</th>
        <th>Usuario</th>
        <th>Correo</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($usuarios as $u): ?>
        <tr>
            <td><?= htmlspecialchars($u["id"]) ?></td>
            <td><?= htmlspecialchars($u["usuario"]) ?></td>
            <td><?= htmlspecialchars($u["correo"]) ?></td>
            <td>
                <a href="index.php?url=usuarios/editarForm&id=<?= $u["id"] ?>">Editar</a>
                <a href="index.php?url=usuarios/eliminar&id=<?= $u["id"] ?>"
                   onclick="return confirm('Eliminar usuario?')">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require __DIR__ . "/../partials/footer.php"; ?>
