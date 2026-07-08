<?php
class HomeController
{
    // Pagina de inicio con las tarjetas de los juegos
    public function index()
    {
        require __DIR__ . "/../views/home/index.php";
    }

    public function snake()
    {
        require __DIR__ . "/../views/home/snake.php";
    }

    public function tresEnRaya()
    {
        require __DIR__ . "/../views/home/tresenraya.php";
    }
}
