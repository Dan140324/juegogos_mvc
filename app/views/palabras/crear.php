<?php $titulo = "Nueva Palabra"; require __DIR__ . "/../partials/header.php"; ?>

<h2>Nueva Palabra</h2>

<form action="index.php?url=palabras/crear" method="POST">

    <p>
        <label>Palabra</label><br>
        <input
            type="text"
            name="palabra"
            required
            maxlength="80">
    </p>

    <p>
        <label>Pista</label><br>
        <input
            type="text"
            name="pista"
            required
            maxlength="255">
    </p>

    <p>
        <label>Categoría</label><br>
        <input
            type="text"
            name="categoria"
            required
            maxlength="50">
    </p>

    <p>
        <button type="submit">
            Guardar
        </button>

        <a href="index.php?url=palabras/listar">
            Cancelar
        </a>
    </p>

</form>

<?php require __DIR__ . "/../partials/footer.php"; ?>