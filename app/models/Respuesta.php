<?php
require_once __DIR__ . "/../../config/conexion.php";

// Entidad B (relacionada con resenas)
class Respuesta
{
    // Todas las respuestas de una resena concreta
    public static function obtenerPorResena($resena_id)
    {
        $conn = Conexion::conectar();
        $resena_id = (int)$resena_id;
        $sql = "SELECT rp.id, rp.texto, rp.fecha,
                       u.usuario AS nombre_usuario
                FROM respuestas rp
                JOIN usuarios u ON u.id = rp.usuario_id
                WHERE rp.resena_id = $resena_id
                ORDER BY rp.id";
        $res = $conn->query($sql);

        $respuestas = [];
        while ($fila = $res->fetch_assoc()) {
            $respuestas[] = $fila;
        }
        return $respuestas;
    }

    public static function crear($resena_id, $usuario_id, $texto)
    {
        $conn = Conexion::conectar();
        $resena_id  = (int)$resena_id;
        $usuario_id = (int)$usuario_id;
        $texto      = $conn->real_escape_string($texto);

        $sql = "INSERT INTO respuestas (resena_id, usuario_id, texto)
                VALUES ($resena_id, $usuario_id, '$texto')";
        return $conn->query($sql);
    }

    public static function eliminar($id)
    {
        $conn = Conexion::conectar();
        $id = (int)$id;
        $sql = "DELETE FROM respuestas WHERE id=$id";
        return $conn->query($sql);
    }
}
