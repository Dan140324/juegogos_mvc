<?php $titulo = "Tres en Raya"; require __DIR__ . "/../partials/header.php"; ?>

<section class="juego">
    <h2>Tres en Raya</h2>
    <div id="status">Turno de X</div>
    <div id="board">
        <div class="cell" data-index="0"></div>
        <div class="cell" data-index="1"></div>
        <div class="cell" data-index="2"></div>
        <div class="cell" data-index="3"></div>
        <div class="cell" data-index="4"></div>
        <div class="cell" data-index="5"></div>
        <div class="cell" data-index="6"></div>
        <div class="cell" data-index="7"></div>
        <div class="cell" data-index="8"></div>
    </div>
    <p style="text-align:center;"><button id="reset">Jugar de nuevo</button></p>
    <p id="aviso_puntaje" class="mensaje-ok" style="text-align:center;"></p>
    <?php if (!isset($_SESSION["id_usuario"])): ?>
        <p style="text-align:center;"><a href="index.php?url=auth/login">Inicia sesion</a> para guardar tus victorias.</p>
    <?php endif; ?>
</section>

<script>
    const HAY_LOGIN = <?= isset($_SESSION["id_usuario"]) ? "true" : "false" ?>;
    const JUEGO_ID = 2; // 2 = Tres en Raya (ver database.sql)
</script>
<script src="js/guardar_puntaje.js"></script>
<script src="js/tresenraya.js"></script>

<?php require __DIR__ . "/../partials/footer.php"; ?>
