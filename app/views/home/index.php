<?php $titulo = "Juegogos - Inicio"; require __DIR__ . "/../partials/header.php"; ?>

<section>
    <h2>Bienvenido a Juegogos</h2>

    <?php if (isset($_SESSION["usuario"])): ?>
        <p>
            Hola,
            <strong><?= htmlspecialchars($_SESSION["usuario"]) ?></strong>.
            Tus puntajes se guardarán automáticamente.
        </p>
    <?php else: ?>
        <p>
            Elige un juego y diviértete.
            <a href="index.php?url=auth/login">Inicia sesión</a>
            para guardar tus puntajes.
        </p>
    <?php endif; ?>

</section>

<section>

    <h2>Nuestros juegos</h2>

    <div class="tarjetas">

        <div class="tarjeta">
            <h3>Snake</h3>
            <p>El clásico Snake: come manzanas y crece sin chocar.</p>
            <a href="index.php?url=home/snake" class="boton">
                Jugar
            </a>
        </div>

        <div class="tarjeta">
            <h3>Tres en Raya</h3>
            <p>Consigue tres en línea antes que tu rival.</p>
            <a href="index.php?url=home/tresenraya" class="boton">
                Jugar
            </a>
        </div>

        <!-- NUEVO JUEGO -->
        <div class="tarjeta">
            <h3>Ahorcado</h3>
            <p>Adivina la palabra antes de quedarte sin intentos.</p>
            <a href="index.php?url=home/ahorcado" class="boton">
                Jugar
            </a>
        </div>

    </div>

</section>

<?php require __DIR__ . "/../partials/footer.php"; ?>