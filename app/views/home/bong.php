<?php $titulo = "Bong"; require __DIR__ . "/../partials/header.php"; ?>

<section class="juego">
    <h2>Bong</h2>
    <p>Presiona <strong>Espacio</strong> para saltar. Recoge monedas y esquiva obstaculos.</p>

    <div id="game">
        <div id="hud">
            <span id="score">Puntaje: 0</span>
            <span id="vidas">Vidas: 3</span>
        </div>
        <div id="pelota"></div>
        <div id="overlay">
            <div id="cuadro">
                <p id="texto">¡Game Over!</p>
                <p id="puntajeFinal">Puntaje final: 0</p>
                <button id="btnReiniciar" onclick="reiniciarJuego()">Volver a jugar</button>
                <button id="btnSalir" onclick="salirJuego()">Salir</button>
            </div>
        </div>
    </div>

    <p style="text-align:center;margin-top:8px;">
        <button onclick="togglePause()">Pausar / Continuar</button>
    </p>
    <p id="aviso_puntaje" class="mensaje-ok" style="text-align:center;"></p>
    <?php if (!isset($_SESSION["id_usuario"])): ?>
        <p style="text-align:center;"><a href="index.php?url=auth/login">Inicia sesion</a> para guardar tu puntaje.</p>
    <?php endif; ?>
</section>

<script>
    const HAY_LOGIN = <?= isset($_SESSION["id_usuario"]) ? "true" : "false" ?>;
    const JUEGO_ID = 3; // 3 = Bong (ver database.sql)
</script>
<script src="js/guardar_puntaje.js"></script>
<script src="js/bong.js"></script>

<?php require __DIR__ . "/../partials/footer.php"; ?>