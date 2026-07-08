<?php $titulo = "Palabras"; require __DIR__ . "/../partials/header.php"; ?>

<h2>Administración de Palabras</h2>

<p>
    <a href="index.php?url=palabras/crearForm">
        Nueva Palabra
    </a>
</p>

<table border="1" cellpadding="8">

    <tr>
        <th>ID</th>
        <th>Palabra</th>
        <th>Pista</th>
        <th>Categoría</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($palabras as $p): ?>

    <tr>

        <td><?= $p["id"] ?></td>

        <td><?= htmlspecialchars($p["palabra"]) ?></td>

        <td><?= htmlspecialchars($p["pista"]) ?></td>

        <td><?= htmlspecialchars($p["categoria"]) ?></td>

        <td>

            <a href="index.php?url=palabras/editarForm&id=<?= $p["id"] ?>">
                Editar
            </a>

            |

            <a
                href="index.php?url=palabras/eliminar&id=<?= $p["id"] ?>"
                onclick="return confirm('¿Eliminar esta palabra?')">

                Eliminar

            </a>

        </td>

    </tr>

    <?php endforeach; ?>

</table>

<?php require __DIR__ . "/../partials/footer.php"; ?>