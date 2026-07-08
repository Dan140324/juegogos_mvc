<?php
require_once __DIR__ . "/../models/Resena.php";
require_once __DIR__ . "/../models/Respuesta.php";
require_once __DIR__ . "/../models/Juego.php";

class ResenaController
{
    public function listar()
    {
        AuthController::requerirLogin();
        $resenas = Resena::obtenerTodos();
        require __DIR__ . "/../views/resenas/listar.php";
    }

    public function crearForm()
    {
        AuthController::requerirLogin();
        $juegos = Juego::obtenerTodos(); // para elegir sobre que juego opinar
        require __DIR__ . "/../views/resenas/crear.php";
    }

    public function crear()
    {
        AuthController::requerirLogin();
        $juego_id     = $_POST["juego_id"] ?? 0;
        $calificacion = $_POST["calificacion"] ?? 0;
        $comentario   = $_POST["comentario"] ?? "";

        // Validacion backend: juego valido y calificacion 1..5
        if ((int)$juego_id <= 0 || (int)$calificacion < 1 || (int)$calificacion > 5) {
            header("Location: index.php?url=resenas/crearForm");
            exit;
        }

        Resena::crear($_SESSION["id_usuario"], $juego_id, $calificacion, $comentario);
        header("Location: index.php?url=resenas/listar");
        exit;
    }

    public function editarForm()
    {
        AuthController::requerirLogin();
        $id = $_GET["id"] ?? 0;
        $resena = Resena::obtenerPorId($id);
        // Traemos tambien sus respuestas para mostrarlas debajo
        $respuestas = Respuesta::obtenerPorResena($id);
        require __DIR__ . "/../views/resenas/editar.php";
    }

    public function actualizar()
    {
        AuthController::requerirLogin();
        $id           = $_POST["id"] ?? 0;
        $calificacion = $_POST["calificacion"] ?? 0;
        $comentario   = $_POST["comentario"] ?? "";

        if ((int)$calificacion < 1 || (int)$calificacion > 5) {
            header("Location: index.php?url=resenas/editarForm&id=" . (int)$id);
            exit;
        }

        Resena::actualizar($id, $calificacion, $comentario);
        header("Location: index.php?url=resenas/listar");
        exit;
    }

    public function eliminar()
    {
        AuthController::requerirLogin();
        $id = $_GET["id"] ?? 0;
        Resena::eliminar($id);
        header("Location: index.php?url=resenas/listar");
        exit;
    }
}
