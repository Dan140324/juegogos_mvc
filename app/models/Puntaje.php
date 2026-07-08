<?php
require_once __DIR__ . "/../../config/conexion.php";

// Entidad B (relacionada con usuarios y con juegos)
class Puntaje
{
    // Trae el puntaje junto al nombre del usuario y del juego (JOIN)
    public static function obtenerTodos()
    {
        $conn = Conexion::conectar();
        $sql = "SELECT p.id, p.puntaje, p.fecha,
                       u.usuario AS nombre_usuario,
                       j.nombre  AS nombre_juego
                FROM puntajes p
                JOIN usuarios u ON u.id = p.usuario_id
                JOIN juegos   j ON j.id = p.juego_id
                ORDER BY p.puntaje DESC";
        $res = $conn->query($sql);

        $puntajes = [];
        while ($fila = $res->fetch_assoc()) {
            $puntajes[] = $fila;
        }
        return $puntajes;
    }

    // Insertar puntaje (lo llama el AJAX de los juegos)
    public static function crear($usuario_id, $juego_id, $puntaje)
    {
        $conn = Conexion::conectar();
        $usuario_id = (int)$usuario_id;
        $juego_id   = (int)$juego_id;
        $puntaje    = (int)$puntaje;

        $sql = "INSERT INTO puntajes (usuario_id, juego_id, puntaje)
                VALUES ($usuario_id, $juego_id, $puntaje)";
        return $conn->query($sql);
    }

    public static function eliminar($id)
    {
        $conn = Conexion::conectar();
        $id = (int)$id;
        $sql = "DELETE FROM puntajes WHERE id=$id";
        return $conn->query($sql);
    }
}
