<?php
require_once __DIR__ . "/../models/Usuario.php";

class UsuarioController
{
    public function listar()
    {
        AuthController::requerirLogin();
        $usuarios = Usuario::obtenerTodos();
        require __DIR__ . "/../views/usuarios/listar.php";
    }

    public function crearForm()
    {
        AuthController::requerirLogin();
        require __DIR__ . "/../views/usuarios/crear.php";
    }

    public function crear()
    {
        AuthController::requerirLogin();
        $u = $_POST["usuario"] ?? "";
        $c = $_POST["correo"]  ?? "";
        $k = $_POST["clave"]   ?? "";

        // Validacion backend
        if (trim($u) === "" || trim($c) === "" || trim($k) === "") {
            header("Location: index.php?url=usuarios/crearForm");
            exit;
        }

        Usuario::crear($u, $c, $k);
        header("Location: index.php?url=usuarios/listar");
        exit;
    }

    public function editarForm()
    {
        AuthController::requerirLogin();
        $id = $_GET["id"] ?? 0;
        $usuario = Usuario::obtenerPorId($id);
        require __DIR__ . "/../views/usuarios/editar.php";
    }

    public function actualizar()
    {
        AuthController::requerirLogin();
        $id = $_POST["id"] ?? 0;
        $u  = $_POST["usuario"] ?? "";
        $c  = $_POST["correo"]  ?? "";

        if (trim($u) === "" || trim($c) === "") {
            header("Location: index.php?url=usuarios/editarForm&id=" . (int)$id);
            exit;
        }

        Usuario::actualizar($id, $u, $c);
        header("Location: index.php?url=usuarios/listar");
        exit;
    }

    public function eliminar()
    {
        AuthController::requerirLogin();
        $id = $_GET["id"] ?? 0;
        Usuario::eliminar($id);
        header("Location: index.php?url=usuarios/listar");
        exit;
    }
}
