<?php $titulo = "Snake"; require __DIR__ . "/../partials/header.php"; ?>

<section class="juego">
    <h2>Snake</h2>
    <div class="marcador">Puntaje: <span id="puntaje">0</span></div>
    <canvas id="tablero" width="400" height="400"></canvas>
    <p style="text-align:center;">
        <button id="btn_inicio">Iniciar Juego</button>
    </p>
    <p id="aviso_puntaje" class="mensaje-ok" style="text-align:center;"></p>
    <?php if (!isset($_SESSION["id_usuario"])): ?>
        <p style="text-align:center;"><a href="index.php?url=auth/login">Inicia sesion</a> para guardar tu puntaje.</p>
    <?php endif; ?>
</section>

<script>
    // El backend sabe si hay sesion; se lo pasamos a JS con una variable.
    const HAY_LOGIN = <?= isset($_SESSION["id_usuario"]) ? "true" : "false" ?>;
    const JUEGO_ID = 1; // 1 = Snake (ver database.sql)
</script>
<script src="js/guardar_puntaje.js"></script>
<script src="js/snake.js"></script>

<?php require __DIR__ . "/../partials/footer.php"; ?>
