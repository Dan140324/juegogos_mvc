<?php
// En local (XAMPP/Laragon) se usan los valores por defecto de abajo.
// Al desplegar, el hosting suele dar los datos por variables de entorno;
// si existen, se usan esas (asi no hay que tocar el codigo al subirlo).

class Conexion
{
    public static function conectar()
    {
        $host = getenv("DB_HOST") ?: "127.0.0.1";
        $bd   = getenv("DB_NAME") ?: "juegogos";
        $user = getenv("DB_USER") ?: "root";
        $pass = getenv("DB_PASS") ?: "";
        $port = getenv("DB_PORT") ?: 3307;

        $conn = new mysqli($host, $user, $pass, $bd, (int)$port);

        if ($conn->connect_error) {
            die("Error de conexion: " . $conn->connect_error);
        }

        $conn->set_charset("utf8mb4");
        return $conn;
    }
}
