<?php $titulo = "Reseñas"; require __DIR__ . "/../partials/header.php"; ?>

<h2>Reseñas</h2>
<p><a class="boton" href="index.php?url=resenas/crearForm">Crear reseña</a></p>

<table>
    <tr>
        <th>ID</th>
        <th>Usuario</th>
        <th>Juego</th>
        <th>Calificacion</th>
        <th>Comentario</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($resenas as $r): ?>
        <tr>
            <td><?= htmlspecialchars($r["id"]) ?></td>
            <td><?= htmlspecialchars($r["nombre_usuario"]) ?></td>
            <td><?= htmlspecialchars($r["nombre_juego"]) ?></td>
            <td><?= htmlspecialchars($r["calificacion"]) ?>/5</td>
            <td><?= htmlspecialchars($r["comentario"]) ?></td>
            <td>
                <a href="index.php?url=resenas/editarForm&id=<?= $r["id"] ?>">Editar / Respuestas</a>
                <a href="index.php?url=resenas/eliminar&id=<?= $r["id"] ?>"
                   onclick="return confirm('Eliminar resena?')">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require __DIR__ . "/../partials/footer.php"; ?>
