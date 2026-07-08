<?php $titulo = "Puntajes"; require __DIR__ . "/../partials/header.php"; ?>

<h2>Ranking de puntajes</h2>
<p>Los puntajes se registran automaticamente al terminar cada partida.</p>

<table>
    <tr>
        <th>ID</th>
        <th>Usuario</th>
        <th>Juego</th>
        <th>Puntaje</th>
        <th>Fecha</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($puntajes as $p): ?>
        <tr>
            <td><?= htmlspecialchars($p["id"]) ?></td>
            <td><?= htmlspecialchars($p["nombre_usuario"]) ?></td>
            <td><?= htmlspecialchars($p["nombre_juego"]) ?></td>
            <td><?= htmlspecialchars($p["puntaje"]) ?></td>
            <td><?= htmlspecialchars($p["fecha"]) ?></td>
            <td>
                <a href="index.php?url=puntajes/eliminar&id=<?= $p["id"] ?>"
                   onclick="return confirm('Eliminar puntaje?')">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require __DIR__ . "/../partials/footer.php"; ?>
