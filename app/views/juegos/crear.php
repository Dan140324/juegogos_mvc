<?php $titulo = "Crear juego"; require __DIR__ . "/../partials/header.php"; ?>

<h2>Crear juego</h2>

<form method="POST" action="index.php?url=juegos/crear" onsubmit="return validar()">
    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="descripcion">Descripcion</label>
    <textarea id="descripcion" name="descripcion"></textarea>

    <label for="categoria_id">Categoria</label>
    <select id="categoria_id" name="categoria_id">
        <option value="0">-- Sin categoria --</option>
        <?php foreach ($categorias as $c): ?>
            <option value="<?= $c["id"] ?>"><?= htmlspecialchars($c["nombre"]) ?></option>
        <?php endforeach; ?>
    </select>

    <p id="err" class="mensaje"></p>
    <button type="submit">Guardar</button>
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

<?php require __DIR__ . "/../partials/footer.php"; ?>
