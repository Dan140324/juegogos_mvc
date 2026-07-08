<?php $titulo = "Crear reseña"; require __DIR__ . "/../partials/header.php"; ?>

<h2>Crear reseña</h2>

<form method="POST" action="index.php?url=resenas/crear" onsubmit="return validar()">
    <label for="juego_id">Juego</label>
    <select id="juego_id" name="juego_id" required>
        <option value="">-- Elige un juego --</option>
        <?php foreach ($juegos as $j): ?>
            <option value="<?= $j["id"] ?>"><?= htmlspecialchars($j["nombre"]) ?></option>
        <?php endforeach; ?>
    </select>

    <label for="calificacion">Calificacion (1 a 5)</label>
    <input type="number" id="calificacion" name="calificacion" min="1" max="5" required>

    <label for="comentario">Comentario</label>
    <textarea id="comentario" name="comentario"></textarea>

    <p id="err" class="mensaje"></p>
    <button type="submit">Guardar</button>
</form>

<p><a href="index.php?url=resenas/listar">Volver</a></p>

<script>
    function validar() {
        const juego = document.getElementById("juego_id").value;
        const cal = parseInt(document.getElementById("calificacion").value, 10);
        const err = document.getElementById("err");
        if (juego === "") {
            err.textContent = "Elige un juego.";
            return false;
        }
        if (isNaN(cal) || cal < 1 || cal > 5) {
            err.textContent = "La calificacion debe ser un numero del 1 al 5.";
            return false;
        }
        return true;
    }
</script>

<?php require __DIR__ . "/../partials/footer.php"; ?>
