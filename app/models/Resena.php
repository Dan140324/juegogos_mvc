<?php
require_once __DIR__ . "/../../config/conexion.php";

// Entidad A (relacionada con usuarios y con juegos)
class Resena
{
    public static function obtenerTodos()
    {
        $conn = Conexion::conectar();
        $sql = "SELECT r.id, r.calificacion, r.comentario, r.fecha,
                       u.usuario AS nombre_usuario,
                       j.nombre  AS nombre_juego
                FROM resenas r
                JOIN usuarios u ON u.id = r.usuario_id
                JOIN juegos   j ON j.id = r.juego_id
                ORDER BY r.id DESC";
        $res = $conn->query($sql);

        $resenas = [];
        while ($fila = $res->fetch_assoc()) {
            $resenas[] = $fila;
        }
        return $resenas;
    }

    public static function obtenerPorId($id)
    {
        $conn = Conexion::conectar();
        $id = (int)$id;
        $sql = "SELECT id, usuario_id, juego_id, calificacion, comentario
                FROM resenas WHERE id=$id LIMIT 1";
        $res = $conn->query($sql);
        return $res->fetch_assoc();
    }

    public static function crear($usuario_id, $juego_id, $calificacion, $comentario)
    {
        $conn = Conexion::conectar();
        $usuario_id   = (int)$usuario_id;
        $juego_id     = (int)$juego_id;
        $calificacion = (int)$calificacion;
        $comentario   = $conn->real_escape_string($comentario);

        $sql = "INSERT INTO resenas (usuario_id, juego_id, calificacion, comentario)
                VALUES ($usuario_id, $juego_id, $calificacion, '$comentario')";
        return $conn->query($sql);
    }

    public static function actualizar($id, $calificacion, $comentario)
    {
        $conn = Conexion::conectar();
        $id = (int)$id;
        $calificacion = (int)$calificacion;
        $comentario   = $conn->real_escape_string($comentario);

        $sql = "UPDATE resenas SET calificacion=$calificacion, comentario='$comentario'
                WHERE id=$id";
        return $conn->query($sql);
    }

    public static function eliminar($id)
    {
        $conn = Conexion::conectar();
        $id = (int)$id;
        $sql = "DELETE FROM resenas WHERE id=$id";
        return $conn->query($sql);
    }
}
