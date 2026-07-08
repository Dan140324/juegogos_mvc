<?php
require_once __DIR__ . "/../../config/conexion.php";

// Entidad B (relacionada con categorias)
class Juego
{
    // Trae el juego junto al nombre de su categoria (JOIN)
    public static function obtenerTodos()
    {
        $conn = Conexion::conectar();
        $sql = "SELECT j.id, j.nombre, j.descripcion,
                       c.nombre AS nombre_categoria
                FROM juegos j
                LEFT JOIN categorias c ON c.id = j.categoria_id
                ORDER BY j.id";
        $res = $conn->query($sql);

        $juegos = [];
        while ($fila = $res->fetch_assoc()) {
            $juegos[] = $fila;
        }
        return $juegos;
    }

    public static function obtenerPorId($id)
    {
        $conn = Conexion::conectar();
        $id = (int)$id;
        $sql = "SELECT id, nombre, descripcion, categoria_id
                FROM juegos WHERE id=$id LIMIT 1";
        $res = $conn->query($sql);
        return $res->fetch_assoc();
    }

    public static function crear($nombre, $descripcion, $categoria_id)
    {
        $conn = Conexion::conectar();
        $nombre       = $conn->real_escape_string($nombre);
        $descripcion  = $conn->real_escape_string($descripcion);
        $categoria_id = (int)$categoria_id;

        $sql = "INSERT INTO juegos (nombre, descripcion, categoria_id)
                VALUES ('$nombre', '$descripcion', $categoria_id)";
        return $conn->query($sql);
    }

    public static function actualizar($id, $nombre, $descripcion, $categoria_id)
    {
        $conn = Conexion::conectar();
        $id = (int)$id;
        $nombre       = $conn->real_escape_string($nombre);
        $descripcion  = $conn->real_escape_string($descripcion);
        $categoria_id = (int)$categoria_id;

        $sql = "UPDATE juegos
                SET nombre='$nombre', descripcion='$descripcion', categoria_id=$categoria_id
                WHERE id=$id";
        return $conn->query($sql);
    }

    public static function eliminar($id)
    {
        $conn = Conexion::conectar();
        $id = (int)$id;
        $sql = "DELETE FROM juegos WHERE id=$id";
        return $conn->query($sql);
    }
}
