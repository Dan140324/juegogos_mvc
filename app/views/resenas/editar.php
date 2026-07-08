<?php $titulo = "Editar reseña"; require __DIR__ . "/../partials/header.php"; ?>

<h2>Editar reseña</h2>

<?php if (!$resena): ?>
    <p class="mensaje">No existe la reseña.</p>
    <p><a href="index.php?url=resenas/listar">Volver</a></p>
<?php else: ?>
    <form method="POST" action="index.php?url=resenas/actualizar" onsubmit="return validar()">
        <input type="hidden" name="id" value="<?= htmlspecialchars($resena["id"]) ?>">

        <label for="calificacion">Calificacion (1 a 5)</label>
        <input type="number" id="calificacion" name="calificacion" min="1" max="5"
               value="<?= htmlspecialchars($resena["calificacion"]) ?>" required>

        <label for="comentario">Comentario</label>
        <textarea id="comentario" name="comentario"><?= htmlspecialchars($resena["comentario"]) ?></textarea>

        <p id="err" class="mensaje"></p>
        <button type="submit">Actualizar</button>
    </form>

    <h3>Respuestas de esta reseña</h3>
    <table>
        <tr>
            <th>Usuario</th>
            <th>Respuesta</th>
            <th>Accion</th>
        </tr>
        <?php foreach ($respuestas as $rp): ?>
            <tr>
                <td><?= htmlspecialchars($rp["nombre_usuario"]) ?></td>
                <td><?= htmlspecialchars($rp["texto"]) ?></td>
                <td>
                    <a href="index.php?url=respuestas/eliminar&id=<?= $rp["id"] ?>&resena_id=<?= $resena["id"] ?>"
                       onclick="return confirm('Eliminar respuesta?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3>Agregar respuesta</h3>
    <form method="POST" action="index.php?url=respuestas/crear" onsubmit="return validarResp()">
        <input type="hidden" name="resena_id" value="<?= htmlspecialchars($resena["id"]) ?>">
        <label for="texto">Tu respuesta</label>
        <textarea id="texto" name="texto" required></textarea>
        <p id="err_resp" class="mensaje"></p>
        <button type="submit">Responder</button>
    </form>

    <p><a href="index.php?url=resenas/listar">Volver</a></p>

    <script>
        function validar() {
            const cal = parseInt(document.getElementById("calificacion").value, 10);
            if (isNaN(cal) || cal < 1 || cal > 5) {
                document.getElementById("err").textContent = "Calificacion del 1 al 5.";
                return false;
            }
            return true;
        }
        function validarResp() {
            if (document.getElementById("texto").value.trim() === "") {
                document.getElementById("err_resp").textContent = "Escribe una respuesta.";
                return false;
            }
            return true;
        }
    </script>
<?php endif; ?>

<?php require __DIR__ . "/../partials/footer.php"; ?>
