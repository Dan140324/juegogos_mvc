<?php $titulo = "Registro"; require __DIR__ . "/../partials/header.php"; ?>

<h2>Crear cuenta</h2>

<?php if (!empty($msg)): ?>
    <p class="mensaje"><?= htmlspecialchars($msg) ?></p>
<?php endif; ?>

<form method="POST" action="index.php?url=auth/registro" onsubmit="return validarRegistro()">
    <label for="usuario">Usuario</label>
    <input type="text" id="usuario" name="usuario" required>

    <label for="correo">Correo</label>
    <input type="email" id="correo" name="correo" required>

    <label for="clave">Clave</label>
    <input type="password" id="clave" name="clave" required minlength="4">

    <p id="error_cliente" class="mensaje"></p>
    <button type="submit">Registrar</button>
</form>

<p><a href="index.php?url=auth/login">Volver al login</a></p>

<script>
    function validarRegistro() {
        const u = document.getElementById("usuario").value.trim();
        const c = document.getElementById("correo").value.trim();
        const k = document.getElementById("clave").value.trim();
        const error = document.getElementById("error_cliente");
        if (u === "" || c === "" || k === "") {
            error.textContent = "Complete todos los campos.";
            return false;
        }
        if (k.length < 4) {
            error.textContent = "La clave debe tener al menos 4 caracteres.";
            return false;
        }
        return true;
    }
</script>

<?php require __DIR__ . "/../partials/footer.php"; ?>
