<?php $titulo = "Editar juego"; require __DIR__ . "/../partials/header.php"; ?>

<h2>Editar juego</h2>

<?php if (!$juego): ?>
    <p class="mensaje">No existe el juego.</p>
    <p><a href="index.php?url=juegos/listar">Volver</a></p>
<?php else: ?>
    <form method="POST" action="index.php?url=juegos/actualizar" onsubmit="return validar()">
        <input type="hidden" name="id" value="<?= htmlspecialchars($juego["id"]) ?>">

        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($juego["nombre"]) ?>" required>

        <label for="descripcion">Descripcion</label>
        <textarea id="descripcion" name="descripcion"><?= htmlspecialchars($juego["descripcion"]) ?></textarea>

        <label for="categoria_id">Categoria</label>
        <select id="categoria_id" name="categoria_id">
            <option value="0">-- Sin categoria --</option>
            <?php foreach ($categorias as $c): ?>
                <option value="<?= $c["id"] ?>"
                    <?= ($c["id"] == $juego["categoria_id"]) ? "selected" : "" ?>>
                    <?= htmlspecialchars($c["nombre"]) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <p id="err" class="mensaje"></p>
        <button type="submit">Actualizar</button>
    </form>
    <p><a href="index.php?url=juegos/listar">Volver</a></p>

    <script>
        function validar() {
            if (document.getElementById("nombre").value.trim() === "") {
                document.getElementById("err").textContent = "El nombre es obligatorio.";
                return false;
            }
            return true;
        }
    </script>
<?php endif; ?>

<?php require __DIR__ . "/../partials/footer.php"; ?>
