<?php
require_once __DIR__ . "/../models/Usuario.php";

class AuthController
{
    // ---- Helper reutilizable: corta la ejecucion si no hay sesion ----
    public static function requerirLogin()
    {
        if (!isset($_SESSION["id_usuario"])) {
            header("Location: index.php?url=auth/login");
            exit;
        }
    }

    public function loginForm()
    {
        if (isset($_SESSION["id_usuario"])) {
            header("Location: index.php?url=home/index");
            exit;
        }
        $msg = $_GET["msg"] ?? "";
        require __DIR__ . "/../views/auth/login.php";
    }

    public function validar()
    {
        $usuario = $_POST["usuario"] ?? "";
        $clave   = $_POST["clave"] ?? "";

        // Validacion backend: campos obligatorios
        if (trim($usuario) === "" || trim($clave) === "") {
            header("Location: index.php?url=auth/login&msg=" . urlencode("Complete todos los campos"));
            exit;
        }

        $fila = Usuario::buscarPorCredenciales($usuario, $clave);

        if ($fila) {
            $_SESSION["id_usuario"] = $fila["id"];
            $_SESSION["usuario"]    = $fila["usuario"];
            header("Location: index.php?url=home/index");
            exit;
        }

        header("Location: index.php?url=auth/login&msg=" . urlencode("Usuario o clave incorrectos"));
        exit;
    }

    public function registroForm()
    {
        $msg = "";
        require __DIR__ . "/../views/auth/registro.php";
    }

    public function registro()
    {
        $usuario = $_POST["usuario"] ?? "";
        $correo  = $_POST["correo"]  ?? "";
        $clave   = $_POST["clave"]   ?? "";
        $msg = "";

        // Validacion backend
        if (trim($usuario) === "" || trim($correo) === "" || trim($clave) === "") {
            $msg = "Complete todos los campos";
        } elseif (Usuario::existeUsuario($usuario)) {
            $msg = "Ese usuario ya existe, intente otro";
        } else {
            Usuario::crear($usuario, $correo, $clave);
            header("Location: index.php?url=auth/login&msg=" . urlencode("Registro exitoso, inicie sesion"));
            exit;
        }

        require __DIR__ . "/../views/auth/registro.php";
    }

    public function logout()
    {
        session_destroy();
        header("Location: index.php?url=auth/login");
        exit;
    }
}
