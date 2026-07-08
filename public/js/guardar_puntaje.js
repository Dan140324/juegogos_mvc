// Funcion compartida por los juegos. Envia el puntaje al backend por AJAX
// Solo intenta guardar si el usuario tiene sesion iniciada (variable HAY_LOGIN).
async function guardarPuntaje(juegoId, puntaje) {
    if (!HAY_LOGIN) return;

    const aviso = document.getElementById("aviso_puntaje");

    try {
        const datos = new URLSearchParams();
        datos.append("juego_id", juegoId);
        datos.append("puntaje", puntaje);

        const res = await fetch("index.php?url=puntajes/guardar", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: datos
        });

        const data = await res.json();

        if (aviso) {
            aviso.textContent = data.ok
                ? "Puntaje guardado: " + puntaje
                : "No se pudo guardar el puntaje";
        }
    } catch (err) {
        if (aviso) aviso.textContent = "Error al guardar: " + err.message;
    }
}
