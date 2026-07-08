<?php $titulo = "Editar usuario"; require __DIR__ . "/../partials/header.php"; ?>

<h2>Editar usuario</h2>

<?php if (!$usuario): ?>
    <p class="mensaje">No existe el usuario.</p>
    <p><a href="index.php?url=usuarios/listar">Volver</a></p>
<?php else: ?>
    <form method="POST" action="index.php?url=usuarios/actualizar" onsubmit="return validar()">
        <input type="hidden" name="id" value="<?= htmlspecialchars($usuario["id"]) ?>">

        <label for="usuario">Usuario</label>
        <input type="text" id="usuario" name="usuario" value="<?= htmlspecialchars($usuario["usuario"]) ?>" required>

        <label for="correo">Correo</label>
        <input type="email" id="correo" name="correo" value="<?= htmlspecialchars($usuario["correo"]) ?>" required>

        <p id="err" class="mensaje"></p>
        <button type="submit">Actualizar</button>
    </form>
    <p><a href="index.php?url=usuarios/listar">Volver</a></p>

    <script>
        function validar() {
            const u = document.getElementById("usuario").value.trim();
            const c = document.getElementById("correo").value.trim();
            if (u === "" || c === "") {
                document.getElementById("err").textContent = "Complete todos los campos.";
                return false;
            }
            return true;
        }
    </script>
<?php endif; ?>

<?php require __DIR__ . "/../partials/footer.php"; ?>
