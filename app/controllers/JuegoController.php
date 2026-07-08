<?php
require_once __DIR__ . "/../models/Juego.php";
require_once __DIR__ . "/../models/Categoria.php";

class JuegoController
{
    public function listar()
    {
        AuthController::requerirLogin();
        $juegos = Juego::obtenerTodos();
        require __DIR__ . "/../views/juegos/listar.php";
    }

    public function crearForm()
    {
        AuthController::requerirLogin();
        $categorias = Categoria::obtenerTodos(); // para el <select>
        require __DIR__ . "/../views/juegos/crear.php";
    }

    public function crear()
    {
        AuthController::requerirLogin();
        $nombre = $_POST["nombre"] ?? "";
        $desc   = $_POST["descripcion"] ?? "";
        $catId  = $_POST["categoria_id"] ?? 0;

        if (trim($nombre) === "") {
            header("Location: index.php?url=juegos/crearForm");
            exit;
        }

        Juego::crear($nombre, $desc, $catId);
        header("Location: index.php?url=juegos/listar");
        exit;
    }

    public function editarForm()
    {
        AuthController::requerirLogin();
        $id = $_GET["id"] ?? 0;
        $juego = Juego::obtenerPorId($id);
        $categorias = Categoria::obtenerTodos();
        require __DIR__ . "/../views/juegos/editar.php";
    }

    public function actualizar()
    {
        AuthController::requerirLogin();
        $id     = $_POST["id"] ?? 0;
        $nombre = $_POST["nombre"] ?? "";
        $desc   = $_POST["descripcion"] ?? "";
        $catId  = $_POST["categoria_id"] ?? 0;

        if (trim($nombre) === "") {
            header("Location: index.php?url=juegos/editarForm&id=" . (int)$id);
            exit;
        }

        Juego::actualizar($id, $nombre, $desc, $catId);
        header("Location: index.php?url=juegos/listar");
        exit;
    }

    public function eliminar()
    {
        AuthController::requerirLogin();
        $id = $_GET["id"] ?? 0;
        Juego::eliminar($id);
        header("Location: index.php?url=juegos/listar");
        exit;
    }
}
