<?php
require_once __DIR__ . "/../models/Categoria.php";

class CategoriaController
{
    public function listar()
    {
        AuthController::requerirLogin();
        $categorias = Categoria::obtenerTodos();
        require __DIR__ . "/../views/categorias/listar.php";
    }

    public function crearForm()
    {
        AuthController::requerirLogin();
        require __DIR__ . "/../views/categorias/crear.php";
    }

    public function crear()
    {
        AuthController::requerirLogin();
        $nombre = $_POST["nombre"] ?? "";
        $desc   = $_POST["descripcion"] ?? "";

        if (trim($nombre) === "") {
            header("Location: index.php?url=categorias/crearForm");
            exit;
        }

        Categoria::crear($nombre, $desc);
        header("Location: index.php?url=categorias/listar");
        exit;
    }

    public function editarForm()
    {
        AuthController::requerirLogin();
        $id = $_GET["id"] ?? 0;
        $categoria = Categoria::obtenerPorId($id);
        require __DIR__ . "/../views/categorias/editar.php";
    }

    public function actualizar()
    {
        AuthController::requerirLogin();
        $id     = $_POST["id"] ?? 0;
        $nombre = $_POST["nombre"] ?? "";
        $desc   = $_POST["descripcion"] ?? "";

        if (trim($nombre) === "") {
            header("Location: index.php?url=categorias/editarForm&id=" . (int)$id);
            exit;
        }

        Categoria::actualizar($id, $nombre, $desc);
        header("Location: index.php?url=categorias/listar");
        exit;
    }

    public function eliminar()
    {
        AuthController::requerirLogin();
        $id = $_GET["id"] ?? 0;
        Categoria::eliminar($id);
        header("Location: index.php?url=categorias/listar");
        exit;
    }
}
