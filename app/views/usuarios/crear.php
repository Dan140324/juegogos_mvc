<?php $titulo = "Crear usuario"; require __DIR__ . "/../partials/header.php"; ?>

<h2>Crear usuario</h2>

<form method="POST" action="index.php?url=usuarios/crear" onsubmit="return validar()">
    <label for="usuario">Usuario</label>
    <input type="text" id="usuario" name="usuario" required>

    <label for="correo">Correo</label>
    <input type="email" id="correo" name="correo" required>

    <label for="clave">Clave</label>
    <input type="password" id="clave" name="clave" required>

    <p id="err" class="mensaje"></p>
    <button type="submit">Guardar</button>
</form>

<p><a href="index.php?url=usuarios/listar">Volver</a></p>

<script>
    function validar() {
        const u = document.getElementById("usuario").value.trim();
        const c = document.getElementById("correo").value.trim();
        const k = document.getElementById("clave").value.trim();
        if (u === "" || c === "" || k === "") {
            document.getElementById("err").textContent = "Complete todos los campos.";
            return false;
        }
        return true;
    }
</script>

<?php require __DIR__ . "/../partials/footer.php"; ?>
