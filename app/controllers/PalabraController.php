<?php
require_once __DIR__ . "/../models/Palabra.php";

class PalabraController
{
    public function listar()
    {
        AuthController::requerirLogin();

        $palabras = Palabra::obtenerTodos();

        require __DIR__ . "/../views/palabras/listar.php";
    }

    public function crearForm()
    {
        AuthController::requerirLogin();

        require __DIR__ . "/../views/palabras/crear.php";
    }

    public function crear()
    {
        AuthController::requerirLogin();

        $palabra = $_POST["palabra"] ?? "";
        $pista = $_POST["pista"] ?? "";
        $categoria = $_POST["categoria"] ?? "";

        if (
            trim($palabra) === "" ||
            trim($pista) === "" ||
            trim($categoria) === ""
        ) {
            header("Location: index.php?url=palabras/crearForm");
            exit;
        }

        Palabra::crear($palabra, $pista, $categoria);

        header("Location: index.php?url=palabras/listar");
        exit;
    }

    public function editarForm()
    {
        AuthController::requerirLogin();

        $id = $_GET["id"] ?? 0;

        $palabra = Palabra::obtenerPorId($id);

        require __DIR__ . "/../views/palabras/editar.php";
    }

    public function actualizar()
    {
        AuthController::requerirLogin();

        $id = $_POST["id"] ?? 0;
        $palabra = $_POST["palabra"] ?? "";
        $pista = $_POST["pista"] ?? "";
        $categoria = $_POST["categoria"] ?? "";

        if (
            trim($palabra) === "" ||
            trim($pista) === "" ||
            trim($categoria) === ""
        ) {
            header("Location: index.php?url=palabras/editarForm&id=" . (int)$id);
            exit;
        }

        Palabra::actualizar($id, $palabra, $pista, $categoria);

        header("Location: index.php?url=palabras/listar");
        exit;
    }

    public function eliminar()
    {
        AuthController::requerirLogin();

        $id = $_GET["id"] ?? 0;

        Palabra::eliminar($id);

        header("Location: index.php?url=palabras/listar");
        exit;
    }

    // DEVUELVE UNA PALABRA ALEATORIA EN FORMATO JSON
    public function obtenerAleatoria()
    {
        $palabra = Palabra::obtenerAleatoria();

        header("Content-Type: application/json");

        echo json_encode($palabra);
    }
}