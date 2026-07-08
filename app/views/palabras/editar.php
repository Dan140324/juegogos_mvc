<?php $titulo = "Editar Palabra"; require __DIR__ . "/../partials/header.php"; ?>

<h2>Editar Palabra</h2>

<form action="index.php?url=palabras/actualizar" method="POST">

    <input
        type="hidden"
        name="id"
        value="<?= $palabra["id"] ?>">

    <p>
        <label>Palabra</label><br>
        <input
            type="text"
            name="palabra"
            value="<?= htmlspecialchars($palabra["palabra"]) ?>"
            required
            maxlength="80">
    </p>

    <p>
        <label>Pista</label><br>
        <input
            type="text"
            name="pista"
            value="<?= htmlspecialchars($palabra["pista"]) ?>"
            required
            maxlength="255">
    </p>

    <p>
        <label>Categoría</label><br>
        <input
            type="text"
            name="categoria"
            value="<?= htmlspecialchars($palabra["categoria"]) ?>"
            required
            maxlength="50">
    </p>

    <p>
        <button type="submit">
            Actualizar
        </button>

        <a href="index.php?url=palabras/listar">
            Cancelar
        </a>
    </p>

</form>

<?php require __DIR__ . "/../partials/footer.php"; ?>