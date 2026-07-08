# Juegogos — Aplicación web PHP + MySQL (MVC)

Proyecto DAW 6-7. Es la continuación del sitio de juegos del primer parcial
(Snake y Tres en Raya), ahora convertido en una aplicación web dinámica con
PHP, MySQL y el patrón **MVC**, con **login** y **CRUD completo**.

## Entidades (una pareja relacionada por integrante)

| Integrante | Entidades (CRUD) | Relación |
|---|---|---|
| 1 | `usuarios` → `puntajes` | Un usuario tiene muchos puntajes |
| 2 | `categorias` → `juegos` | Una categoría agrupa muchos juegos |
| 3 | `resenas` → `respuestas` | Una reseña tiene muchas respuestas |

Además, al terminar una partida de Snake o Tres en Raya, el puntaje del
usuario logueado se guarda automáticamente por **AJAX** (fetch + JSON).

## Estructura del proyecto

```
/public
    index.php          Router único (Front Controller)
    /css/estilos.css
    /js                snake.js, tresenraya.js, guardar_puntaje.js
/app
    /controllers       Un controlador por módulo
    /models            Un modelo por entidad (métodos estáticos)
    /views             Vistas por entidad + partials (header/footer)
/config
    conexion.php       Clase Conexion (mysqli)
/database
    database.sql       Las 6 tablas + datos de ejemplo
README.md
```

## Cómo ejecutarlo en local (XAMPP / Laragon)

1. Copia la carpeta del proyecto dentro de `htdocs` (XAMPP) o `www` (Laragon).
2. Abre **phpMyAdmin** e importa `database/database.sql`. Eso crea la base de
   datos `juegogos` con sus tablas y datos de ejemplo.
3. Revisa `config/conexion.php`. Por defecto usa:
   `host=localhost`, `bd=juegogos`, `usuario=root`, `clave=` (vacía).
4. Entra en el navegador a:
   `http://localhost/juegogos_mvc/public/index.php`

### Usuario de prueba

- Usuario: **demo**
- Clave: **1234**

(También existen `ana / ana123` y `luis / luis123`.)

## Rutas principales

Todo pasa por `public/index.php?url=modulo/accion`. Ejemplos:

- `home/index` — inicio con los juegos
- `home/snake`, `home/tresenraya` — los juegos
- `auth/login`, `auth/registroForm`, `auth/logout`
- `usuarios/listar`, `categorias/listar`, `juegos/listar`, `resenas/listar`, `puntajes/listar`

Los módulos CRUD requieren sesión iniciada.

## Validaciones

- **Frontend:** atributos HTML5 (`required`, `type="email"`, `min`/`max`) y
  funciones de JavaScript antes de enviar cada formulario.
- **Backend:** cada controlador verifica que los datos no lleguen vacíos o
  fuera de rango antes de tocar la base de datos.

## Despliegue

El requisito permite "Render u otra opción". Recomendaciones según dificultad:

- **Hosting gratuito con phpMyAdmin (lo más simple):** InfinityFree o
  000webhost. Sube los archivos por el administrador de archivos, crea la base
  de datos, importa `database.sql` desde phpMyAdmin y ajusta `conexion.php`
  con los datos que te da el panel. No requiere Docker.
- **Railway:** conecta el repositorio de GitHub, agrega un servicio MySQL con
  un clic y define las variables `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`,
  `DB_PORT` (el `conexion.php` ya las lee automáticamente).
- **Render:** solo corre PHP mediante Docker y su base administrada es
  PostgreSQL, así que hay que levantar MySQL aparte. Se incluye un `Dockerfile`
  por si eligen esta vía, pero las dos opciones anteriores son más sencillas.

## Nota sobre la clave

Igual que en los ejemplos de clase, las claves se guardan en texto plano para
mantenerlo simple. Como mejora futura se puede usar `password_hash()` al
registrar y `password_verify()` al validar, cambiando solo esas dos líneas.
