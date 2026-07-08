<?php $titulo = "Crear categoria"; require __DIR__ . "/../partials/header.php"; ?>

<h2>Crear categoria</h2>

<form method="POST" action="index.php?url=categorias/crear" onsubmit="return validar()">
    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="descripcion">Descripcion</label>
    <textarea id="descripcion" name="descripcion"></textarea>

    <p id="err" class="mensaje"></p>
    <button type="submit">Guardar</button>
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

<?php require __DIR__ . "/../partials/footer.php"; ?>
