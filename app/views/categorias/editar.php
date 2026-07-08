<?php $titulo = "Editar categoria"; require __DIR__ . "/../partials/header.php"; ?>

<h2>Editar categoria</h2>

<?php if (!$categoria): ?>
    <p class="mensaje">No existe la categoria.</p>
    <p><a href="index.php?url=categorias/listar">Volver</a></p>
<?php else: ?>
    <form method="POST" action="index.php?url=categorias/actualizar" onsubmit="return validar()">
        <input type="hidden" name="id" value="<?= htmlspecialchars($categoria["id"]) ?>">

        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($categoria["nombre"]) ?>" required>

        <label for="descripcion">Descripcion</label>
        <textarea id="descripcion" name="descripcion"><?= htmlspecialchars($categoria["descripcion"]) ?></textarea>

        <p id="err" class="mensaje"></p>
        <button type="submit">Actualizar</button>
    </form>
    <p><a href="index.php?url=categorias/listar">Volver</a></p>

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
