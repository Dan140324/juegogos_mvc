<?php $titulo = "Ahorcado"; require __DIR__ . "/../partials/header.php"; ?>

<section class="juego">

   <h2>Ahorcado</h2>

<p>
    <strong>Jugador:</strong>
    <?= $_SESSION["usuario"] ?? "Invitado" ?>
</p>

<div class="marcador">
    Puntaje: <span id="puntaje">0</span>
</div>
    <div class="contenedor-ahorcado">

        <h3 id="categoria">Categoría</h3>

        <p id="pista">
            Presiona "Iniciar Juego".
        </p>

        <div style="display:flex;justify-content:center;margin:20px 0;">

<pre id="dibujo" style="font-size:22px;line-height:24px;font-weight:bold;">
 +---+
 |   |
 |
 |
 |
 |
=========
</pre>

        </div>

        <h2 id="palabra" style="letter-spacing:8px;text-align:center;">
            _ _ _ _
        </h2>

        <p style="text-align:center;">
            Intentos restantes:
            <strong id="intentos">6</strong>
        </p>

        <div
            id="teclado"
            style="display:flex;flex-wrap:wrap;gap:8px;justify-content:center;">
        </div>

        <br>

        <p style="text-align:center;">
            <button id="btn_inicio">
                Iniciar Juego
            </button>
        </p>

        <p
            id="mensaje"
            class="mensaje-ok"
            style="text-align:center;font-size:20px;">
        </p>

        <p
            id="aviso_puntaje"
            class="mensaje-ok"
            style="text-align:center;">
        </p>

        <?php if (!isset($_SESSION["id_usuario"])): ?>
            <p style="text-align:center;">
                <a href="index.php?url=auth/login">
                    Inicia sesión
                </a>
                para guardar tu puntaje.
            </p>
        <?php endif; ?>

    </div>

</section>

<script>
const HAY_LOGIN = <?= isset($_SESSION["id_usuario"]) ? "true" : "false" ?>;
const JUEGO_ID = 3;
</script>

<script src="js/guardar_puntaje.js"></script>
<script src="js/ahorcado.js"></script>

<?php require __DIR__ . "/../partials/footer.php"; ?>