<?php
require_once __DIR__ . "/../../config/conexion.php";

class Palabra
{
    public static function obtenerTodos()
    {
        $conn = Conexion::conectar();

        $sql = "SELECT * FROM palabras ORDER BY categoria, palabra";

        $res = $conn->query($sql);

        $palabras = [];

        while ($fila = $res->fetch_assoc()) {
            $palabras[] = $fila;
        }

        return $palabras;
    }

    public static function obtenerPorId($id)
    {
        $conn = Conexion::conectar();

        $id = (int)$id;

        $sql = "SELECT * FROM palabras WHERE id=$id LIMIT 1";

        $res = $conn->query($sql);

        return $res->fetch_assoc();
    }

    public static function crear($palabra, $pista, $categoria)
    {
        $conn = Conexion::conectar();

        $palabra = strtoupper($conn->real_escape_string($palabra));
        $pista = $conn->real_escape_string($pista);
        $categoria = $conn->real_escape_string($categoria);

        $sql = "INSERT INTO palabras
                (palabra, pista, categoria)
                VALUES
                ('$palabra','$pista','$categoria')";

        return $conn->query($sql);
    }

    public static function actualizar($id, $palabra, $pista, $categoria)
    {
        $conn = Conexion::conectar();

        $id = (int)$id;

        $palabra = strtoupper($conn->real_escape_string($palabra));
        $pista = $conn->real_escape_string($pista);
        $categoria = $conn->real_escape_string($categoria);

        $sql = "UPDATE palabras
                SET
                    palabra='$palabra',
                    pista='$pista',
                    categoria='$categoria'
                WHERE id=$id";

        return $conn->query($sql);
    }

    public static function eliminar($id)
    {
        $conn = Conexion::conectar();

        $id = (int)$id;

        $sql = "DELETE FROM palabras WHERE id=$id";

        return $conn->query($sql);
    }

    public static function obtenerAleatoria()
    {
        $conn = Conexion::conectar();

        $sql = "SELECT * FROM palabras
                ORDER BY RAND()
                LIMIT 1";

        $res = $conn->query($sql);

        return $res->fetch_assoc();
    }
}