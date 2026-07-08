<?php $titulo = "Juegogos - Inicio"; require __DIR__ . "/../partials/header.php"; ?>

<section>
    <h2>Bienvenido a Juegogos</h2>
    <?php if (isset($_SESSION["usuario"])): ?>
        <p>Hola, <strong><?= htmlspecialchars($_SESSION["usuario"]) ?></strong>. Tus puntajes se guardaran automaticamente.</p>
    <?php else: ?>
        <p>Elige un juego y diviertete. <a href="index.php?url=auth/login">Inicia sesion</a> para guardar tus puntajes.</p>
    <?php endif; ?>
</section>

<section>
    <h2>Nuestros juegos</h2>
    <div class="tarjetas">
        <div class="tarjeta">
            <h3>Snake</h3>
            <p>El clasico Snake: come manzanas y crece sin chocar.</p>
            <a href="index.php?url=home/snake" class="boton">Jugar</a>
        </div>
        <div class="tarjeta">
            <h3>Tres en Raya</h3>
            <p>Consigue tres en linea antes que tu rival.</p>
            <a href="index.php?url=home/tresenraya" class="boton">Jugar</a>
        </div>
    </div>
</section>

<?php require __DIR__ . "/../partials/footer.php"; ?>
