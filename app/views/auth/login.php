<?php $titulo = "Ingresar"; require __DIR__ . "/../partials/header.php"; ?>

<h2>Iniciar sesion</h2>

<?php if (!empty($msg)): ?>
    <p class="mensaje"><?= htmlspecialchars($msg) ?></p>
<?php endif; ?>

<form method="POST" action="index.php?url=auth/validar" onsubmit="return validarLogin()">
    <label for="usuario">Usuario</label>
    <input type="text" id="usuario" name="usuario" required>

    <label for="clave">Clave</label>
    <input type="password" id="clave" name="clave" required>

    <p id="error_cliente" class="mensaje"></p>
    <button type="submit">Ingresar</button>
</form>

<p><a href="index.php?url=auth/registroForm">Crear cuenta</a></p>

<script>
    // Validacion en el cliente (JavaScript)
    function validarLogin() {
        const u = document.getElementById("usuario").value.trim();
        const c = document.getElementById("clave").value.trim();
        const error = document.getElementById("error_cliente");
        if (u === "" || c === "") {
            error.textContent = "Complete usuario y clave.";
            return false;
        }
        return true;
    }
</script>

<?php require __DIR__ . "/../partials/footer.php"; ?>
