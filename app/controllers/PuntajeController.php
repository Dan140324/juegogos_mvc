<?php
require_once __DIR__ . "/../models/Puntaje.php";

class PuntajeController
{
    // Tabla de puntajes (ranking). Visible para usuarios logueados.
    public function listar()
    {
        AuthController::requerirLogin();
        $puntajes = Puntaje::obtenerTodos();
        require __DIR__ . "/../views/puntajes/listar.php";
    }

    // Endpoint AJAX: lo llaman Snake y Tres en Raya al terminar la partida.
    // Recibe juego_id y puntaje por POST; el usuario sale de la sesion.
    public function guardar()
    {
        header("Content-Type: application/json; charset=utf-8");

        // Solo guarda si hay sesion iniciada
        if (!isset($_SESSION["id_usuario"])) {
            echo json_encode(["ok" => false, "error" => "no_login"]);
            exit;
        }

        $juego_id = $_POST["juego_id"] ?? 0;
        $puntaje  = $_POST["puntaje"]  ?? 0;

        // Validacion backend
        if ((int)$juego_id <= 0) {
            echo json_encode(["ok" => false, "error" => "datos_invalidos"]);
            exit;
        }

        $ok = Puntaje::crear($_SESSION["id_usuario"], $juego_id, $puntaje);
        echo json_encode(["ok" => (bool)$ok]);
        exit;
    }

    public function eliminar()
    {
        AuthController::requerirLogin();
        $id = $_GET["id"] ?? 0;
        Puntaje::eliminar($id);
        header("Location: index.php?url=puntajes/listar");
        exit;
    }
}
