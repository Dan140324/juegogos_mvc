<?php
// =====================================================================
//  Punto de entrada unico (Front Controller).
//  Toda la app entra por aqui usando ?url=modulo/accion, igual que el
//  ejemplo mvc-crud de clase, solo que con mas modulos.
// =====================================================================

session_start();

require_once __DIR__ . "/../app/controllers/HomeController.php";
require_once __DIR__ . "/../app/controllers/AuthController.php";
require_once __DIR__ . "/../app/controllers/UsuarioController.php";
require_once __DIR__ . "/../app/controllers/CategoriaController.php";
require_once __DIR__ . "/../app/controllers/JuegoController.php";
require_once __DIR__ . "/../app/controllers/PuntajeController.php";
require_once __DIR__ . "/../app/controllers/ResenaController.php";
require_once __DIR__ . "/../app/controllers/RespuestaController.php";

$url = $_GET["url"] ?? "home/index";

switch ($url) {

    // ----- Inicio y juegos -----
    case "home/index":       (new HomeController())->index();       break;
    case "home/snake":       (new HomeController())->snake();       break;
    case "home/tresenraya":  (new HomeController())->tresEnRaya();  break;

    // ----- Autenticacion -----
    case "auth/login":       (new AuthController())->loginForm();    break;
    case "auth/validar":     (new AuthController())->validar();      break;
    case "auth/registroForm":(new AuthController())->registroForm(); break;
    case "auth/registro":    (new AuthController())->registro();     break;
    case "auth/logout":      (new AuthController())->logout();       break;

    // ----- Integrante 1: usuarios -----
    case "usuarios/listar":     (new UsuarioController())->listar();     break;
    case "usuarios/crearForm":  (new UsuarioController())->crearForm();  break;
    case "usuarios/crear":      (new UsuarioController())->crear();      break;
    case "usuarios/editarForm": (new UsuarioController())->editarForm(); break;
    case "usuarios/actualizar": (new UsuarioController())->actualizar(); break;
    case "usuarios/eliminar":   (new UsuarioController())->eliminar();   break;

    // ----- Integrante 1: puntajes -----
    case "puntajes/listar":   (new PuntajeController())->listar();   break;
    case "puntajes/guardar":  (new PuntajeController())->guardar();  break; // AJAX desde los juegos
    case "puntajes/eliminar": (new PuntajeController())->eliminar(); break;

    // ----- Integrante 2: categorias -----
    case "categorias/listar":     (new CategoriaController())->listar();     break;
    case "categorias/crearForm":  (new CategoriaController())->crearForm();  break;
    case "categorias/crear":      (new CategoriaController())->crear();      break;
    case "categorias/editarForm": (new CategoriaController())->editarForm(); break;
    case "categorias/actualizar": (new CategoriaController())->actualizar(); break;
    case "categorias/eliminar":   (new CategoriaController())->eliminar();   break;

    // ----- Integrante 2: juegos -----
    case "juegos/listar":     (new JuegoController())->listar();     break;
    case "juegos/crearForm":  (new JuegoController())->crearForm();  break;
    case "juegos/crear":      (new JuegoController())->crear();      break;
    case "juegos/editarForm": (new JuegoController())->editarForm(); break;
    case "juegos/actualizar": (new JuegoController())->actualizar(); break;
    case "juegos/eliminar":   (new JuegoController())->eliminar();   break;

    // ----- Integrante 3: resenas -----
    case "resenas/listar":     (new ResenaController())->listar();     break;
    case "resenas/crearForm":  (new ResenaController())->crearForm();  break;
    case "resenas/crear":      (new ResenaController())->crear();      break;
    case "resenas/editarForm": (new ResenaController())->editarForm(); break;
    case "resenas/actualizar": (new ResenaController())->actualizar(); break;
    case "resenas/eliminar":   (new ResenaController())->eliminar();   break;

    // ----- Integrante 3: respuestas -----
    case "respuestas/crear":    (new RespuestaController())->crear();    break;
    case "respuestas/eliminar": (new RespuestaController())->eliminar(); break;

    default:
        http_response_code(404);
        echo "404 - Ruta no encontrada";
}
