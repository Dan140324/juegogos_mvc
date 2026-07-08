let palabraActual = "";
let letrasAdivinadas = [];
let intentos = 6;
let juegoTerminado = false;

const dibujos = [
` +---+
 |   |
 |
 |
 |
 |
=========`,
` +---+
 |   |
 O
 |
 |
 |
=========`,
` +---+
 |   |
 O
 |
 |
 |
=========`,
` +---+
 |   |
 O
/|
 |
 |
=========`,
` +---+
 |   |
 O
/|\\
 |
 |
=========`,
` +---+
 |   |
 O
/|\\
/
 |
=========`,
` +---+
 |   |
 O
/|\\
/ \\
=========`
];

document
    .getElementById("btn_inicio")
    .addEventListener("click", iniciarJuego);

async function iniciarJuego() {

    const respuesta = await fetch("index.php?url=palabras/aleatoria");

    const aleatoria = await respuesta.json();

    palabraActual = aleatoria.palabra.toUpperCase();

    letrasAdivinadas = [];

    intentos = 6;

    juegoTerminado = false;

    document.getElementById("categoria").textContent =
        "Categoría: " + aleatoria.categoria;

    document.getElementById("pista").textContent =
        "Pista: " + aleatoria.pista;

    document.getElementById("intentos").textContent =
        intentos;

    document.getElementById("mensaje").textContent = "";

    document.getElementById("dibujo").textContent =
        dibujos[0];

    mostrarPalabra();

    crearTeclado();

}

function mostrarPalabra() {

    let texto = "";

    for (const letra of palabraActual) {

        if (letrasAdivinadas.includes(letra)) {

            texto += letra + " ";

        } else {

            texto += "_ ";

        }

    }

    document.getElementById("palabra").textContent = texto;

    verificarVictoria();

}

function crearTeclado() {

    const teclado = document.getElementById("teclado");

    teclado.innerHTML = "";

    const letras = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZ";

    for (const letra of letras) {

        const boton = document.createElement("button");

        boton.textContent = letra;

        boton.style.width = "40px";
        boton.style.height = "40px";
        boton.style.margin = "3px";

        boton.onclick = () => jugar(letra, boton);

        teclado.appendChild(boton);

    }

}

function jugar(letra, boton) {

    if (juegoTerminado) return;

    boton.disabled = true;

    if (palabraActual.includes(letra)) {

        if (!letrasAdivinadas.includes(letra)) {

            letrasAdivinadas.push(letra);

        }

        mostrarPalabra();

    } else {

        intentos--;

        document.getElementById("intentos").textContent =
            intentos;

        document.getElementById("dibujo").textContent =
            dibujos[6 - intentos];

        verificarDerrota();

    }

}

function verificarVictoria() {

    for (const letra of palabraActual) {

        if (!letrasAdivinadas.includes(letra)) {

            return;

        }

    }

    juegoTerminado = true;

    document.getElementById("mensaje").textContent =
        "🎉 ¡Ganaste!";

    if (HAY_LOGIN) {

    document.getElementById("puntaje").textContent = intentos;

    guardarPuntaje(JUEGO_ID, intentos);

}

}

function verificarDerrota() {

    if (intentos > 0) return;

    juegoTerminado = true;

    document.getElementById("mensaje").textContent =
        "❌ Perdiste. La palabra era: " + palabraActual;

}