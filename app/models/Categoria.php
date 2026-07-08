<?php
require_once __DIR__ . "/../../config/conexion.php";

// Entidad A
class Categoria
{
    public static function obtenerTodos()
    {
        $conn = Conexion::conectar();
        $sql = "SELECT id, nombre, descripcion FROM categorias ORDER BY id";
        $res = $conn->query($sql);

        $categorias = [];
        while ($fila = $res->fetch_assoc()) {
            $categorias[] = $fila;
        }
        return $categorias;
    }

    public static function obtenerPorId($id)
    {
        $conn = Conexion::conectar();
        $id = (int)$id;
        $sql = "SELECT id, nombre, descripcion FROM categorias WHERE id=$id LIMIT 1";
        $res = $conn->query($sql);
        return $res->fetch_assoc();
    }

    public static function crear($nombre, $descripcion)
    {
        $conn = Conexion::conectar();
        $nombre      = $conn->real_escape_string($nombre);
        $descripcion = $conn->real_escape_string($descripcion);

        $sql = "INSERT INTO categorias (nombre, descripcion)
                VALUES ('$nombre', '$descripcion')";
        return $conn->query($sql);
    }

    public static function actualizar($id, $nombre, $descripcion)
    {
        $conn = Conexion::conectar();
        $id = (int)$id;
        $nombre      = $conn->real_escape_string($nombre);
        $descripcion = $conn->real_escape_string($descripcion);

        $sql = "UPDATE categorias SET nombre='$nombre', descripcion='$descripcion'
                WHERE id=$id";
        return $conn->query($sql);
    }

    public static function eliminar($id)
    {
        $conn = Conexion::conectar();
        $id = (int)$id;
        $sql = "DELETE FROM categorias WHERE id=$id";
        return $conn->query($sql);
    }
}
