<?php
require_once __DIR__ . "/../models/Respuesta.php";

class RespuestaController
{
    // Crea una respuesta dentro de la vista "editar resena"
    public function crear()
    {
        AuthController::requerirLogin();
        $resena_id = $_POST["resena_id"] ?? 0;
        $texto     = $_POST["texto"] ?? "";

        if ((int)$resena_id <= 0 || trim($texto) === "") {
            header("Location: index.php?url=resenas/editarForm&id=" . (int)$resena_id);
            exit;
        }

        Respuesta::crear($resena_id, $_SESSION["id_usuario"], $texto);
        header("Location: index.php?url=resenas/editarForm&id=" . (int)$resena_id);
        exit;
    }

    public function eliminar()
    {
        AuthController::requerirLogin();
        $id        = $_GET["id"] ?? 0;
        $resena_id = $_GET["resena_id"] ?? 0;
        Respuesta::eliminar($id);
        header("Location: index.php?url=resenas/editarForm&id=" . (int)$resena_id);
        exit;
    }
}
