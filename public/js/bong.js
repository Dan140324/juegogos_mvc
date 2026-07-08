const pelota = document.getElementById("pelota");
const game = document.getElementById("game");

const score = document.getElementById("score");
const vidasLabel = document.getElementById("vidas");

const overlay = document.getElementById("overlay");
const texto = document.getElementById("texto");
const puntajeFinal = document.getElementById("puntajeFinal");

const btnReiniciar = document.getElementById("btnReiniciar");
const btnSalir = document.getElementById("btnSalir");

let puntos = 0;
let vidas = 3;
let velocidad = 3;

let pausado = false;
let saltando = false;
let juegoActivo = true;

function actualizarHUD() {
    score.innerText = "Puntaje: " + puntos;
    vidasLabel.innerText = "Vidas: " + vidas;
}

function jump() {
    if (saltando || pausado || !juegoActivo) return;
    saltando = true;

    let altura = 0;
    let velocidadVertical = 9;
    const gravedad = 0.45;

    function animar() {
        if (pausado || !juegoActivo) {
            requestAnimationFrame(animar);
            return;
        }
        altura += velocidadVertical;
        velocidadVertical -= gravedad;
        if (altura <= 0) {
            altura = 0;
            pelota.style.bottom = "0px";
            saltando = false;
            return;
        }
        pelota.style.bottom = altura + "px";
        requestAnimationFrame(animar);
    }
    requestAnimationFrame(animar);
}

document.addEventListener("keydown", function (e) {
    if (e.code === "Space") {
        e.preventDefault();
        jump();
    }
    if (e.code === "KeyP") {
        togglePause();
    }
});

// Soporte tactil para movil
game.addEventListener("touchstart", function (e) {
    e.preventDefault();
    jump();
});

function togglePause() {
    if (!juegoActivo) return;
    pausado = !pausado;
}

function gameOver() {
    juegoActivo = false;
    overlay.style.display = "block";
    texto.innerText = "¡Game Over!";
    puntajeFinal.innerText = "Puntaje final: " + puntos;

    // Guardar puntaje en la BD (igual que Snake y Tres en Raya)
    guardarPuntaje(JUEGO_ID, puntos);
}

function reiniciarJuego() {
    puntos = 0;
    vidas = 3;
    velocidad = 3;
    pausado = false;
    juegoActivo = true;
    pelota.style.bottom = "0px";
    actualizarHUD();
    overlay.style.display = "none";
    btnReiniciar.style.display = "inline-block";
    btnSalir.style.display = "inline-block";
    document.querySelectorAll(".moneda,.obstaculo").forEach(function (obj) { obj.remove(); });
    document.getElementById("aviso_puntaje").textContent = "";
}

function salirJuego() {
    texto.innerText = "Gracias por jugar";
    btnReiniciar.style.display = "none";
    btnSalir.style.display = "none";
}

// Crear moneda
function crearMoneda() {
    if (!juegoActivo) return;
    var moneda = document.createElement("div");
    moneda.className = "moneda";
    moneda.style.left = "600px";
    moneda.style.bottom = Math.random() * 120 + "px";
    game.appendChild(moneda);

    var mover = setInterval(function () {
        if (!juegoActivo) { moneda.remove(); clearInterval(mover); return; }
        if (pausado) return;
        var pos = parseInt(moneda.style.left);
        pos -= velocidad;
        moneda.style.left = pos + "px";

        var pelotaRect = pelota.getBoundingClientRect();
        var monedaRect = moneda.getBoundingClientRect();
        var colision =
            pelotaRect.left < monedaRect.right &&
            pelotaRect.right > monedaRect.left &&
            pelotaRect.top < monedaRect.bottom &&
            pelotaRect.bottom > monedaRect.top;

        if (colision) {
            puntos += 10;
            actualizarHUD();
            moneda.remove();
            clearInterval(mover);
            if (puntos % 20 === 0) velocidad++;
        }
        if (pos <= -30) { moneda.remove(); clearInterval(mover); }
    }, 20);
}

// Crear obstaculo
function crearObstaculo() {
    if (!juegoActivo) return;
    var obstaculo = document.createElement("div");
    obstaculo.className = "obstaculo";
    obstaculo.style.left = "600px";
    obstaculo.style.bottom = "0px";
    game.appendChild(obstaculo);

    var mover = setInterval(function () {
        if (!juegoActivo) { obstaculo.remove(); clearInterval(mover); return; }
        if (pausado) return;
        var pos = parseInt(obstaculo.style.left);
        pos -= velocidad;
        obstaculo.style.left = pos + "px";

        var pelotaRect = pelota.getBoundingClientRect();
        var obstaculoRect = obstaculo.getBoundingClientRect();
        var colision =
            pelotaRect.left < obstaculoRect.right &&
            pelotaRect.right > obstaculoRect.left &&
            pelotaRect.top < obstaculoRect.bottom &&
            pelotaRect.bottom > obstaculoRect.top;

        if (colision) {
            if (pelotaRect.bottom <= obstaculoRect.top + 8) {
                obstaculo.remove();
                clearInterval(mover);
            } else {
                vidas--;
                actualizarHUD();
                obstaculo.remove();
                clearInterval(mover);
                if (vidas <= 0) gameOver();
            }
        }
        if (pos <= -40) { obstaculo.remove(); clearInterval(mover); }
    }, 20);
}

// Generadores
setInterval(function () { if (!pausado && juegoActivo) crearMoneda(); }, 2000);
setInterval(function () { if (!pausado && juegoActivo) crearObstaculo(); }, 4000);

actualizarHUD();